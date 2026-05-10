<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BiyaheMMSU | Driver Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #0f172a; color: #f8fafc; }
        
        .speedometer-ring {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        .pulse-online {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<div id="app" v-cloak>
    <nav class="bg-slate-900 border-b border-slate-800 px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="text-xl">🚌</span>
            <span class="font-extrabold tracking-tight text-sky-400">BIYAHE MMSU</span>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700">
                <span :class="running ? 'bg-green-500 pulse-online' : 'bg-slate-500'" class="w-2.5 h-2.5 rounded-full"></span>
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-300">@{{ status }}</span>
            </div>
            
            <form action="{{ route('logout') }}" method="POST" @submit="handleLogout">
                @csrf
                <button type="submit" class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-all border border-red-500/20">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center p-6 space-y-8">
        
        <div class="text-center">
            <h1 class="text-2xl font-extrabold text-white">@{{ driverName }}</h1>
            <p class="text-slate-400 text-sm font-semibold">Jeep #{{ auth()->user()->jeep_number }} • ID: {{ auth()->user()->id }}</p>
        </div>

        <div class="relative flex items-center justify-center">
            <svg class="w-64 h-64">
                <circle class="text-slate-800" stroke-width="12" stroke="currentColor" fill="transparent" r="110" cx="128" cy="128" />
                <circle :class="running ? 'text-green-500' : 'text-slate-700'" 
                        stroke-width="12" 
                        stroke-dasharray="691" 
                        :stroke-dashoffset="691 - (691 * (currentSpeed / 60))" 
                        stroke-linecap="round" 
                        stroke="currentColor" 
                        fill="transparent" 
                        r="110" cx="128" cy="128" 
                        class="speedometer-ring" />
            </svg>
            
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-6xl font-black text-white leading-none">@{{ currentSpeed }}</span>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-2">km/h</span>
            </div>
        </div>

        <div class="w-full max-w-xs space-y-4">
            <div v-if="running" class="bg-slate-900 border border-slate-800 p-4 rounded-2xl flex items-center justify-between">
                <div class="text-xs text-slate-400 font-bold uppercase tracking-tight">Broadcast Active</div>
                <div class="flex gap-1">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-bounce"></span>
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
                </div>
            </div>

            <button v-if="!running" @click="startGPS" class="w-full py-5 bg-green-600 hover:bg-green-500 text-white font-black text-lg rounded-2xl shadow-lg shadow-green-900/20 transition-all active:scale-95 flex items-center justify-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                START BROADCAST
            </button>

            <button v-if="running" @click="stopGPS" class="w-full py-5 bg-red-600 hover:bg-red-500 text-white font-black text-lg rounded-2xl shadow-lg shadow-red-900/20 transition-all active:scale-95 flex items-center justify-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
                STOP BROADCAST
            </button>
        </div>
    </main>

    <footer class="p-6 text-center text-slate-600 text-[10px] font-bold uppercase tracking-widest">
        &copy; 2026 MMSU Information Technology Student Project
    </footer>
</div>

<script>
// --- CORE LOGIC (UNTOUCHED) ---
const firebaseConfig = { databaseURL: "https://biyahemmsu-default-rtdb.asia-southeast1.firebasedatabase.app" };
firebase.initializeApp(firebaseConfig);
const db = firebase.database();

const driverId = "{{ auth()->user()->id }}";
const driverName = "{{ auth()->user()->name }}";
const jeepNumber = "{{ auth()->user()->jeep_number }}"; 
const ref = db.ref("shuttle/locations/" + driverId);

const { createApp } = Vue;

createApp({
    data() {
        return {
            running: false,
            watchId: null,
            status: "OFFLINE",
            driverName: driverName,
            currentSpeed: 0,
            lastPos: null,
            lastTime: null
        };
    },
    methods: {
        handleLogout() { this.stopGPS(); },
        calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371000;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon/2) * Math.sin(dLon/2);
            return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        },
        startGPS() {
            this.running = true;
            this.status = "ONLINE";
            ref.onDisconnect().remove();
            this.watchId = navigator.geolocation.watchPosition((pos) => {
                const now = Date.now();
                let speedKmH = 0;
                if (this.lastPos && this.lastTime) {
                    const distance = this.calculateDistance(this.lastPos.coords.latitude, this.lastPos.coords.longitude, pos.coords.latitude, pos.coords.longitude);
                    const timeDiff = (now - this.lastTime) / 1000;
                    if (timeDiff > 0) speedKmH = Math.round((distance / timeDiff) * 3.6);
                }
                if (pos.coords.speed && (pos.coords.speed * 3.6) > speedKmH) speedKmH = Math.round(pos.coords.speed * 3.6);
                this.currentSpeed = speedKmH;
                this.lastPos = pos;
                this.lastTime = now;
                ref.set({ driver_id: driverId, driver_name: driverName, jeep_number: jeepNumber, status: "online", lat: pos.coords.latitude, lng: pos.coords.longitude, speed: this.currentSpeed, timestamp: now });
            }, (err) => { alert("GPS error: " + err.message); this.stopGPS(); }, { enableHighAccuracy: true, maximumAge: 0, timeout: 5000 });
        },
        stopGPS() {
            this.running = false;
            this.status = "OFFLINE";
            this.currentSpeed = 0;
            this.lastPos = null;
            this.lastTime = null;
            if (this.watchId) { navigator.geolocation.clearWatch(this.watchId); this.watchId = null; }
            ref.remove();
        }
    }
}).mount("#app");
</script>
</body>
</html>