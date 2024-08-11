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
    {{-- <div class="page-heading">
        <!-- ... (sesuaikan dengan kode sebelumnya) ... -->
        <section class="section">
            <div class="card">
                

            </div>
        </section>

    </div> --}}
    <div class="row">
        <div class="col-md-8">
            <div class="page-heading">
                <section class="section">
                    <div class="card">
                        @if($instansi->isNotEmpty())
                            <div id="map" style="height: 600px; width:100%;"></div>
                            <script>
                                var map = L.map('map').setView([{{ $instansi->first()->latitude }}, {{ $instansi->first()->longitude }}], 13);
    
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                }).addTo(map);
    
                                @foreach ($instansi as $instansi)
                                    var latitude = {{ $instansi->latitude }};
                                    var longitude = {{ $instansi->longitude }};
    
                                    var customIcon = L.divIcon({
                                        className: 'rounded-icon',
                                        html: '<img src="{{ asset('dist/assets/icons/loc.png') }}" class="rounded-icon" style="width: 32px; height: 32px;">',
                                        iconSize: [32, 32],
                                        iconAnchor: [16, 32],
                                        popupAnchor: [0, -32]
                                    });
    
                                    var marker = L.marker([latitude, longitude], {
                                        icon: customIcon
                                    }).addTo(map);
    
                                    marker.bindTooltip('<b>{{ $instansi->nama_instansi }}</b>', {
                                        permanent: true,
                                        className: "location-label",
                                        offset: [0, 0]
                                    });
    
                                    marker.on('click', function(e) {
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
                                            '        <td>MAC ADDRESS</td>' +
                                            '        <td>:</td>' +
                                            '        <td>{{ $instansi->mac_address }}</td>' +
                                            '    </tr>' +
                                            '</table>' +
                                            '<center><img src="{{ asset($instansi->icon) }}" class="rounded" style="width: 128px; height: 128px;"></center><br>';
    
                                        L.popup()
                                            .setLatLng(e.latlng)
                                            .setContent(detailInfo)
                                            .openOn(map);
                                    });
                                @endforeach
                            </script>
                        @else
                            <div class="alert alert-warning" role="alert">
                                Belum ada instansi yang tersedia.
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="page-heading">
                <section class="section">
                    <div class="card">
                        <div id="testMikrotikContent" style="height: 600px; overflow-y: auto;">
                            <!-- Konten di sini -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    
  

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Function to load Blade content into specified element by ID
    function loadBladeContent() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("testMikrotikContent").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "{{ route('testmikrotik') }}", true); // Change 'testmikrotik' to your route name
        xhttp.send();
    }

    // Call the function initially to load the content
    loadBladeContent();

    // Refresh the content every second
    setInterval(loadBladeContent, 1000);
</script>
    
@endsection