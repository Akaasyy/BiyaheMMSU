<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MMSU Shuttle Tracker</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>

<style>
#map { height: 100vh; width: 100%; }

.shuttle-label {
    background: white;
    padding: 4px 10px;
    border-radius: 6px;
    border: 2px solid #3b82f6;
    font-weight: 800;
    font-size: 14px;
    color: #1e40af;
    white-space: nowrap;
}

.user-dot {
    width: 18px;
    height: 18px;
    background: #4285F4;
    border: 3px solid white;
    border-radius: 50%;
}
</style>
</head>

<body>

<div id="map"></div>

<script>
const firebaseConfig = {
    databaseURL: "https://biyahemmsu-default-rtdb.asia-southeast1.firebasedatabase.app"
};

firebase.initializeApp(firebaseConfig);
const database = firebase.database();

let map;
let markers = {};
let userMarker = null;
let AdvancedMarkerElement;

const CENTER = { lat: 18.1754, lng: 120.5390 };

async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement: Marker } = await google.maps.importLibrary("marker");

    AdvancedMarkerElement = Marker;

    map = new Map(document.getElementById("map"), {
        center: CENTER,
        zoom: 16,
        disableDefaultUI: true,
        gestureHandling: "greedy"
    });

    listenDrivers();
}

function listenDrivers() {
    database.ref("shuttle/locations").on("value", (snap) => {
        const data = snap.val() || {};

        const hasDrivers = Object.keys(data).length > 0;
        if (!hasDrivers) {
            clearMarkers();
            return;
        }

        Object.keys(data).forEach(id => {
            const d = data[id];

            // 🔥 SAFETY CHECKS (VERY IMPORTANT)
            if (!d) return;
            if (d.status !== "online") return;
            if (d.lat == null || d.lng == null) return;

            const lat = parseFloat(d.lat);
            const lng = parseFloat(d.lng);

            if (isNaN(lat) || isNaN(lng)) return;

            const pos = { lat, lng };

            if (markers[id]) {
                markers[id].position = pos;
            } else {
                const el = document.createElement("div");
                el.innerHTML = `
                    <div style="text-align:center;">
                        <div class="shuttle-label">Jeep ${d.jeep_number || "N/A"}</div>
                        <div style="font-size:32px;">🚌</div>
                    </div>
                `;

                markers[id] = new AdvancedMarkerElement({
                    position: pos,
                    map: map,
                    content: el,
                    title: d.driver_name || "Shuttle"
                });
            }
        });

        // REMOVE OFFLINE DRIVERS
        Object.keys(markers).forEach(id => {
            if (!data[id]) {
                markers[id].map = null;
                delete markers[id];
            }
        });
    });
}

function clearMarkers() {
    Object.keys(markers).forEach(id => {
        markers[id].map = null;
    });
    markers = {};
}

initMap();
</script>

<script async
src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
</script>

</body>
</html>