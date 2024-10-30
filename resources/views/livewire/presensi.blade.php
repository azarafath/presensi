<div class="container mx-auto p-4">
    <!-- Main Grid for Desktop and Mobile Responsiveness -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Main Card -->
        <div class="bg-surface p-6 rounded-lg shadow-md transition-transform duration-300 hover:shadow-lg">
            <!-- Header -->
            <h2 class="text-2xl font-semibold mb-4 text-primary">Informasi Kehadiran</h2>
            <!-- Information Card -->
            <div class="bg-surface-variant p-5 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                <p class="mb-2">
                    <span class="font-medium text-on-surface-variant">Nama Pegawai:</span> 
                    <span class="text-on-surface">{{ Auth::user()->name }}</span>
                </p>
                <p class="mb-2">
                    <span class="font-medium text-on-surface-variant">Kantor:</span> 
                    <span class="text-on-surface">{{$schedule->office->name}}</span>
                </p>
                <p>
                    <span class="font-medium text-on-surface-variant">Shift:</span> 
                    <span class="text-on-surface">{{$schedule->shift->name}} ({{$schedule->shift->start_time}} - {{$schedule->shift->end_time}})</span>
                </p>
            </div>
        </div>

        <!-- Map Card with Button -->
        <div class="bg-surface p-6 rounded-lg shadow-md transition-transform duration-300 hover:shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-primary">Presensi</h2>
            <div id="map" class="mb-4 h-64 rounded-lg border border-outline"></div>
            <!-- Tombol Tag Location -->
            <button type="button" onclick="tagLocation()" 
            class="bg-blue-500 text-white p-3 rounded-lg shadow-sm hover:bg-blue-600 transition duration-300">
            Tag Location
            </button>

            <!-- Tombol Submit Presensi -->
            <button type="button" onclick="submitPresensi()" 
            class="bg-green-500 text-white p-3 rounded-lg shadow-sm hover:bg-green-600 transition duration-300">
            Submit Presensi
            </button>

        </div>
    </div>

    <!-- Leaflet Map Script -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([{{ $schedule->office->latitude }}, {{ $schedule->office->longitude }}], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        // Marker
        L.marker([{{ $schedule->office->latitude }}, {{ $schedule->office->longitude }}]).addTo(map)
            .bindPopup("{{$schedule->office->name}}")
            .openPopup();

        const office = L.latLng({{ $schedule->office->latitude }}, {{ $schedule->office->longitude }});
        const radius = {{ $schedule->office->radius }};

        L.circle(office, {
            color: 'green',
            fillColor: '#00ff00',
            fillOpacity: 0.5,
            radius: radius
        }).addTo(map);

        let marker;
        // Function Tag Location
        function tagLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    if (marker) {
                        map.removeLayer(marker);
                    }
                    marker = L.marker([lat, lng]).addTo(map);
                    map.setView([lat, lng], 16);

                    if (isWithinRadius(lat, lng, office, radius)) {
                        alert('Anda berada di dalam radius kantor');
                    } else {
                        alert('Anda tidak berada di dalam radius kantor');
                    }
                });
            }else {
                alert('Tidak dapat mendeteksi lokasi');
            }
        }

        // Function Calculate Radius
        function isWithinRadius(lat, lng, center, radius) {
            
            let distance = map.distance([lat, lng], center);

            return distance <= radius;
        }
    </script>
</div>
