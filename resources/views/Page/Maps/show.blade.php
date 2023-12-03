@extends('template.layout')
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        .rounded-icon {
            border-radius: 50%;
        }

        .location-label {
            background: white;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="page-heading">
        <!-- ... (sesuaikan dengan kode sebelumnya) ... -->
        <section class="section">
            <div class="card">
                <div id="map" style="height: 500px;"></div>

                <script>
                    var map = L.map('map').setView([{{ $instansi->first()->latitude }}, {{ $instansi->first()->longitude }}], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    @foreach ($instansi as $instansi)
                        var latitude = {{ $instansi->latitude }};
                        var longitude = {{ $instansi->longitude }};

                        // Marker dengan ikon kustom
                        var customIcon = L.divIcon({
                            className: 'rounded-icon',
                            // html: '<img src="{{ asset('storage/' . $instansi->icon) }}" class="rounded-icon" style="width: 32px; height: 32px;">',
                            html: '<img src="{{ asset('storage/icons/loc.png') }}" class="rounded-icon" style="width: 32px; height: 32px;">',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32],
                            popupAnchor: [0, -32]
                        });

                        var marker = L.marker([latitude, longitude], {
                            icon: customIcon
                        }).addTo(map);

                        // Tambahkan label dengan nama lokasi
                        marker.bindTooltip("{{ $instansi->nama_instansi }}", {
                            permanent: true,
                            className: "location-label",
                            offset: [0, 0]
                        });

                        // Tambahkan event click pada marker
                        marker.on('click', function (e) {
                            // Tampilkan informasi detail instansi
                            var detailInfo = '<b>{{ $instansi->nama_instansi }}</b><br>' +
                                             'Admin Jaringan: {{ $instansi->admin_jaringan }}<br>' +
                                             'Telepon: {{ $instansi->telepon }}<br>' +
                                             'IP WAN: {{ $instansi->ip_wan }}<br>'+
                                             '<center><img src="{{ asset('storage/' . $instansi->icon) }}" class="rounded" style="width: 128px; height: 128px;"></center><br>';

                            // Popup untuk menampilkan informasi detail
                            L.popup()
                                .setLatLng(e.latlng)
                                .setContent(detailInfo)
                                .openOn(map);
                        });
                    @endforeach
                </script>

            </div>
        </section>
    </div>
@endsection
