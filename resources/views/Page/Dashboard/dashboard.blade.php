<style>
    .rounded-icon {
        border-radius: 50%;
    }
</style>

<!-- resources/views/template/layout.blade.php -->

@extends('template.layout')

@section('content')
    <div class="page-heading">
        <h3>Profile Statistics</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div id="map" style="height: 500px;"></div>

                <script src="{{ asset('js/app.js') }}"></script>
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                <script>
                    var map = L.map('map').setView([{{ $lokasis->first()->latitude }}, {{ $lokasis->first()->longitude }}], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    @foreach($lokasis as $lokasi)
                        var latitude = {{ $lokasi->latitude }};
                        var longitude = {{ $lokasi->longitude }};

                        // Marker dengan ikon kustom
                        var customIcon = L.divIcon({
                            className: 'rounded-icon',
                            html: '<img src="{{ asset("storage/" . $lokasi->icon_path) }}" class="rounded-icon" style="width: 32px; height: 32px;">',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32],
                            popupAnchor: [0, -32]
                        });

                        var marker = L.marker([latitude, longitude], {icon: customIcon}).addTo(map);

                        // Tambahkan label dengan nama lokasi
                        marker.bindTooltip("{{ $lokasi->name }}", {permanent: true, className: "location-label", offset: [0, 0]});

                        // GeoJSON poligon dengan warna dari atribut lokasi
                        var polygon = {
                            "type": "Feature",
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [
                                    [
                                        [longitude - 0.001, latitude - 0.001],
                                        [longitude + 0.001, latitude - 0.001],
                                        [longitude + 0.001, latitude + 0.001],
                                        [longitude - 0.001, latitude + 0.001],
                                        [longitude - 0.001, latitude - 0.001]
                                    ]
                                ]
                            },
                            "properties": {
                                "color": '{{ $lokasi->polygon_color }}' // Ganti dengan atribut warna dari lokasi
                            }
                        };

                        // Tambahkan GeoJSON poligon ke peta
                        L.geoJSON(polygon, {
                            style: function (feature) {
                                return {
                                    fillColor: feature.properties.color,
                                    weight: 2,
                                    opacity: 1,
                                    color: 'white',
                                    fillOpacity: 0.7
                                };
                            }
                        }).addTo(map);
                    @endforeach
                </script>
            </div>
        </section>
    </div>
@endsection
