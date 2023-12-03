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
                <div id="map" style="height: 600px;"></div>

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
                            html: '<img src="{{ asset('dist/assets/icons/loc.png') }}" class="rounded-icon" style="width: 32px; height: 32px;">',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32],
                            popupAnchor: [0, -32]
                        });

                        var marker = L.marker([latitude, longitude], {
                            icon: customIcon
                        }).addTo(map);

                        // Tambahkan label dengan nama lokasi
                        marker.bindTooltip(
                            '<b>{{ $instansi->nama_instansi }}</b>&nbsp; <img src="{{ asset('dist/assets/icons/up.png') }}" class="rounded-icon" style="width: 16px; height: 16px;">', {
                                permanent: true,
                                className: "location-label",
                                offset: [0, 0]
                            });

                        // Tambahkan event click pada marker
                        marker.on('click', function(e) {
                            // Tampilkan informasi detail instansi
                            var detailInfo = '<b>{{ $instansi->nama_instansi }}</b>' +
                                '<table style="width:100%">' +
                                '    <tr>' +
                                '        <td>Admin Jaringan</td>' +
                                '        <td>:</td>' +
                                '        <td>{{ $instansi->admin_jaringan }}</td>' +
                                '    </tr>' +
                                '    <tr>' +
                                '        <td>Telepon</td>' +
                                '        <td>:</td>' +
                                '        <td>{{ $instansi->telepon }}</td>' +
                                '    </tr>' +
                                '    <tr>' +
                                '        <td>IP WAN</td>' +
                                '        <td>:</td>' +
                                '        <td>{{ $instansi->ip_wan }}</td>' +
                                '    </tr>' +
                                '</table>' +
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
