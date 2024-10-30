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
                    <span class="text-on-surface">Kantor Dummy</span>
                </p>
                <p>
                    <span class="font-medium text-on-surface-variant">Shift:</span> 
                    <span class="text-on-surface">Shift Dummy</span>
                </p>
            </div>
        </div>

        <!-- Map Card with Button -->
        <div class="bg-surface p-6 rounded-lg shadow-md transition-transform duration-300 hover:shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-primary">Presensi</h2>
            <div id="map" class="mb-4 h-64 rounded-lg border border-outline"></div>
            <button type="button" class="bg-primary hover:bg-primary-dark text-on-primary font-bold py-2 px-4 rounded-lg w-full" wire:click="presensi">Tag Location</button>
        </div>
    </div>

    <!-- Leaflet Map Script -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-6.2088, 106.8456], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        L.marker([-6.2088, 106.8456]).addTo(map)
            .bindPopup('Kantor Dummy')
            .openPopup();
    </script>
</div>
