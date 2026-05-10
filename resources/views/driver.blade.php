<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BiyaheMMSU - Driver Dashboard</title>

    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', Arial, sans-serif; margin:0; background:#f5f5f5; }
        .nav { background:#0f172a; color:white; padding:15px; display:flex; justify-content:space-between; align-items: center; }
        .container { max-width:500px; margin:40px auto; background:white; padding:20px; border-radius:12px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
        button { width:100%; padding:12px; margin-top:10px; border:none; border-radius:8px; font-weight: bold; cursor: pointer; transition: opacity 0.2s; }
        button:hover { opacity: 0.9; }
        .start { background:#16a34a; color:white; }
        .stop { background:#dc2626; color:white; }
        .logout-btn { background: white; color: #dc2626; padding: 6px 12px; font-size: 14px; border: 1px solid #dc2626; width: auto; margin: 0; }
    </style>
</head>

<body>

<div id="app">
    <div class="nav">
        <div class="flex items-center gap-4">
            <span class="font-bold tracking-wider">BIYAHE MMSU</span>
            <span :class="running ? 'text-green-400' : 'text-gray-400'" class="text-xs">● @{{ status }}</span>
        </div>
        
        <form action="{{ route('logout') }}" method="POST" @submit="handleLogout">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="text-center mb-6">
            <p class="text-gray-500 text-xs uppercase font-semibold">Active Driver</p>
            <h3 class="text-xl font-bold text-gray-800">@{{ driverName }}</h3>
            <p class="text-blue-600 font-bold text-sm mt-1">Assigned Jeep: #@{{ jeepDisplay }}</p>
        </div>

        <button class="start" @click="startGPS" v-if="!running">
            Start GPS Broadcast
        </button>

        <button class="stop" @click="stopGPS" v-if="running">
            Stop GPS Broadcast
        </button>
    </div>
</div>

<script>
// Firebase Configuration
const firebaseConfig = {
    databaseURL: "https://biyahemmsu-default-rtdb.asia-southeast1.firebasedatabase.app"
};

firebase.initializeApp(firebaseConfig);
const db = firebase.database();

// Get data from Laravel Auth - Ensure 'jeep_number' exists in your Users table
const driverId = "{{ auth()->user()->id }}";
const driverName = "{{ auth()->user()->name }}";
const jeepNumber = "{{ auth()->user()->jeep_number ?? '1' }}"; 

const ref = db.ref("shuttle/locations/" + driverId);

const { createApp } = Vue;

createApp({
    data() {
        return {
            running: false,
            watchId: null,
            status: "OFFLINE",
            driverName: driverName,
            jeepDisplay: jeepNumber // Stores the number for the UI
        };
    },

    methods: {
        handleLogout(e) {
            this.stopGPS();
        },

        startGPS() {
            this.running = true;
            this.status = "ONLINE";

            // Cleanup Firebase if the driver closes the tab unexpectedly
            ref.onDisconnect().remove();

            this.watchId = navigator.geolocation.watchPosition((pos) => {
                ref.set({
                    driver_id: driverId,
                    driver_name: driverName,
                    jeep_number: this.jeepDisplay, // Uses dynamic number (1-10)
                    status: "online",
                    lat: pos.coords.latitude,
                    lng: pos.coords.longitude,
                    timestamp: Date.now()
                });

            }, (err) => {
                console.error(err);
                alert("GPS error: Please enable location services.");
                this.stopGPS();
            }, {
                enableHighAccuracy: true,
                maximumAge: 0
            });
        },

        stopGPS() {
            this.running = false;
            this.status = "OFFLINE";

            if (this.watchId) {
                navigator.geolocation.clearWatch(this.watchId);
                this.watchId = null;
            }

            // Remove the driver from the live map immediately
            ref.remove();
        }
    }
}).mount("#app");
</script>

</body>
</html>