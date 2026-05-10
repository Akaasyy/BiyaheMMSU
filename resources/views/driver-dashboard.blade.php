<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Driver Dashboard</title>

<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<style>
body { font-family: Arial; margin:0; background:#f5f5f5; }
.nav { background:#0f172a; color:white; padding:15px; display:flex; justify-content:space-between; align-items: center; }
.container { max-width:500px; margin:40px auto; background:white; padding:20px; border-radius:12px; }
button { width:100%; padding:12px; margin-top:10px; border:none; border-radius:8px; cursor: pointer; }
.start { background:#16a34a; color:white; }
.stop { background:#dc2626; color:white; }

/* Logout Button Styling */
.logout-btn {
    background: #dc2626;
    color: white;
    width: auto;
    padding: 8px 15px;
    margin-top: 0;
    font-size: 13px;
    font-weight: bold;
}
</style>
</head>

<body>

<div id="app">
    <div class="nav">
        <div>BIYAHE MMSU</div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <div>@{{ status }}</div>
            <form action="{{ route('logout') }}" method="POST" @submit="handleLogout">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h3>Driver: @{{ driverName }}</h3>
        <p style="font-size: 12px; color: #666;">Driver ID: {{ auth()->user()->id }}</p>
        
        <button class="start" @click="startGPS" v-if="!running">
            Start GPS Broadcast
        </button>

        <button class="stop" @click="stopGPS" v-if="running">
            Stop GPS Broadcast
        </button>
    </div>
</div>

<script>
const firebaseConfig = {
    databaseURL: "https://biyahemmsu-default-rtdb.asia-southeast1.firebasedatabase.app"
};

firebase.initializeApp(firebaseConfig);
const db = firebase.database();

const driverId = "{{ auth()->user()->id }}";
const driverName = "{{ auth()->user()->name }}";

const ref = db.ref("shuttle/locations/" + driverId);

const { createApp } = Vue;

createApp({
    data() {
        return {
            running: false,
            watchId: null,
            status: "OFFLINE",
            driverName: driverName
        };
    },

    methods: {
        // Stops GPS and clears Firebase before the redirect occurs
        handleLogout() {
            this.stopGPS();
        },

        startGPS() {
            this.running = true;
            this.status = "ONLINE";

            ref.onDisconnect().remove();

            this.watchId = navigator.geolocation.watchPosition((pos) => {

                ref.set({
                    driver_id: driverId,
                    driver_name: driverName,
                    // Dynamic Jeep Number based on Database ID (1, 2, 3...)
                    jeep_number: driverId, 
                    status: "online",
                    lat: pos.coords.latitude,
                    lng: pos.coords.longitude,
                    timestamp: Date.now()
                });

            }, (err) => {
                alert("GPS error");
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

            ref.remove();
        }
    }
}).mount("#app");
</script>

</body>
</html>