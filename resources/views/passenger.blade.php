<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BiyaheMMSU | Live Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>

    <style>
        body { margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; background: #0b1220; overflow: hidden; }
        
        .top-nav {
            background-color: #0f172a; 
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 2000;
            border-bottom: 1px solid #1e293b;
        }
        .nav-logo { color: #38bdf8; font-weight: 700; font-size: 18px; display: flex; align-items: center; gap: 8px; }

        #map { height: calc(100vh - 60px); margin-top: 60px; width: 100%; z-index: 1; }

        .overlay-container {
            position: absolute;
            top: 80px; 
            left: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 1000;
        }

        .info-card {
            background: rgba(233, 236, 239, 0.95); 
            backdrop-filter: blur(8px);
            padding: 10px 18px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            min-width: 190px;
            border-left: 6px solid #16a34a;
        }

        .card-title { color: #1e293b; font-weight: 800; font-size: 16px; margin: 0; }
        .card-sub { font-weight: 700; font-size: 10px; margin-top: 2px; text-transform: uppercase; }

        .drivers-panel {
            background: #111827;
            padding: 18px;
            border-radius: 16px;
            width: 260px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.6);
            border: 1px solid #1e293b;
        }

        .panel-header {
            color: #38bdf8;
            font-weight: 800;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .driver-item {
            background: #1f2937;
            padding: 12px;
            border-radius: 12px;
            border-left: 4px solid #16a34a;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .driver-item:hover {
            background: #374151;
            transform: scale(1.02);
        }

        .driver-name { color: #f8fafc; font-weight: 700; font-size: 14px; margin-bottom: 2px; }
        .driver-jeep { color: #94a3b8; font-size: 11px; font-weight: 600; }
        
        /* New Speed Styling */
        .driver-speed { color: #16a34a; font-size: 11px; font-weight: 800; }

        .shuttle-label {
            background: #1e293b;
            color: #38bdf8;
            padding: 4px 12px;
            border-radius: 20px;
            border: 2px solid #16a34a;
            font-weight: 800;
            font-size: 11px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            white-space: nowrap;
        }

        .leaflet-popup-content-wrapper {
            background: #111827 !important;
            color: white !important;
            border-radius: 10px !important;
            border: 1px solid #374151;
        }
        .leaflet-popup-tip { background: #111827 !important; }
    </style>
</head>
<body>

    <div class="top-nav">
        <div class="nav-logo">
            <span>🚌</span> BiyaheMMSU
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-white/10 hover:bg-white/20 text-white px-4 py-1.5 rounded-lg text-sm font-bold transition-all">
                Logout
            </button>
        </form>
    </div>

    <div id="map"></div>

    <div class="overlay-container">
        <div class="info-card">
            <div class="card-title">BiyaheMMSU</div>
            <div class="card-sub text-green-600">Live Tracker</div>
        </div>

        <div class="drivers-panel">
            <div class="panel-header">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                Active Drivers
            </div>
            <div id="drivers-list"></div>
            
            <div class="mt-4 space-y-2">
                <button onclick="focusOnStudent()" class="flex items-center justify-center gap-2 w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-[11px] font-bold uppercase tracking-wider rounded-lg transition-all shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    My Location
                </button>

                <button onclick="resetMapView()" class="w-full py-2 text-[10px] text-gray-400 font-bold uppercase tracking-widest border border-gray-700 rounded-lg hover:bg-gray-800 transition-all">
                    Reset View
                </button>
            </div>
        </div>
    </div>

    <script>
        const firebaseConfig = { databaseURL: "https://biyahemmsu-default-rtdb.asia-southeast1.firebasedatabase.app" };
        firebase.initializeApp(firebaseConfig);
        const db = firebase.database();

        const defaultView = [18.1754, 120.5390];
        const map = L.map('map', { zoomControl: false }).setView(defaultView, 15);
        
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}').addTo(map);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png').addTo(map);

        let shuttleMarkers = {};
        let activeShuttlesData = {}; 
        let userLatLng = null;

        map.locate({setView: false, watch: true, enableHighAccuracy: true});
        
        map.on('locationfound', (e) => {
            userLatLng = e.latlng;
            
            if (!shuttleMarkers['student']) {
                shuttleMarkers['student'] = L.circleMarker(e.latlng, { 
                    radius: 9, 
                    color: '#ffffff', 
                    fillColor: '#3b82f6', 
                    fillOpacity: 1,
                    weight: 3,
                    interactive: true 
                }).addTo(map);

                shuttleMarkers['student'].on('click', () => zoomToLocation(e.latlng));
                shuttleMarkers['student'].bindTooltip("You", { permanent: false, direction: 'top' });
            } else {
                shuttleMarkers['student'].setLatLng(e.latlng);
            }
        });

        function focusOnStudent() {
            if (userLatLng) {
                zoomToLocation(userLatLng);
            } else {
                alert("Detecting location... please wait.");
            }
        }

        const shuttleRef = db.ref("shuttle/locations");
        shuttleRef.on("child_added", updateShuttle);
        shuttleRef.on("child_changed", updateShuttle);
        shuttleRef.on("child_removed", (snap) => {
            if (shuttleMarkers[snap.key]) { 
                map.removeLayer(shuttleMarkers[snap.key]); 
                delete shuttleMarkers[snap.key]; 
            }
            delete activeShuttlesData[snap.key];
            renderDriversList();
        });

        function updateShuttle(snap) {
            const data = snap.val();
            const key = snap.key;

            if (!data || data.status !== "online") {
                if (shuttleMarkers[key]) { map.removeLayer(shuttleMarkers[key]); delete shuttleMarkers[key]; }
                delete activeShuttlesData[key];
                renderDriversList();
                return;
            }

            activeShuttlesData[key] = data;
            renderDriversList();

            const pos = [parseFloat(data.lat), parseFloat(data.lng)];
            const jeepLabel = `JEEP #${data.jeep_number || key}`;
            
            // Speed logic added to popupContent
            const popupContent = `
                <div style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12px; padding: 5px;">
                    <div style="color:#38bdf8; font-weight:bold; border-bottom:1px solid #374151; margin-bottom:5px;">${jeepLabel}</div>
                    <b>Driver:</b> ${data.driver_name || 'Active'}<br>
                    <b>Speed:</b> <span style="color:#16a34a; font-weight:bold;">${data.speed || '0'} km/h</span>
                </div>
            `;

            if (shuttleMarkers[key]) {
                shuttleMarkers[key].setLatLng(pos);
                // Update the popup content dynamically
                shuttleMarkers[key].setPopupContent(popupContent);
            } else {
                const shuttleIcon = L.divIcon({
                    html: `<div class="shuttle-label">🚌 ${jeepLabel}</div>`,
                    className: 'custom-icon', iconSize: [115, 30], iconAnchor: [57, 15]
                });
                shuttleMarkers[key] = L.marker(pos, { icon: shuttleIcon })
                    .addTo(map)
                    .bindPopup(popupContent, { closeButton: false, offset: L.point(0, -10) });
                
                shuttleMarkers[key].on('click', () => zoomToShuttle(key));
            }
        }

        function zoomToLocation(latlng) {
            map.flyTo(latlng, 18, {
                animate: true,
                duration: 1.5
            });
        }

        function zoomToShuttle(key) {
            const data = activeShuttlesData[key];
            if (data) {
                const pos = [parseFloat(data.lat), parseFloat(data.lng)];
                zoomToLocation(pos);
                
                setTimeout(() => {
                    if (shuttleMarkers[key]) shuttleMarkers[key].openPopup();
                }, 1600);
            }
        }

        function resetMapView() {
            map.flyTo(defaultView, 15);
        }

        function renderDriversList() {
            const listContainer = document.getElementById('drivers-list');
            listContainer.innerHTML = '';
            
            const keys = Object.keys(activeShuttlesData);
            if (keys.length === 0) {
                listContainer.innerHTML = '<div class="text-gray-500 text-xs py-2 text-center">No drivers online</div>';
                return;
            }

            keys.forEach(key => {
                const shuttle = activeShuttlesData[key];
                const item = document.createElement('div');
                item.className = 'driver-item';
                item.onclick = () => zoomToShuttle(key);
                
                // Added Speed to the sidebar list items
                item.innerHTML = `
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="driver-name">${shuttle.driver_name || 'Active Driver'}</div>
                            <div class="driver-jeep">Jeep #${shuttle.jeep_number || key}</div>
                        </div>
                        <div class="driver-speed">${shuttle.speed || '0'} km/h</div>
                    </div>
                `;
                listContainer.appendChild(item);
            });
        }
    </script>
</body>
</html>