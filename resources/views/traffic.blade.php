<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Traffic Mikrotik</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Warna hijau untuk card body jika rx (download) */
        .card-green .card-body {
            background-color: #d4edda; /* Ganti dengan warna hijau yang Anda inginkan */
        }
        
        /* Warna merah untuk card body jika tx (upload) */
        .card-red .card-body {
            background-color: #f8d7da; /* Ganti dengan warna merah yang Anda inginkan */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                @foreach ($trafficData as $data)
                <!-- Tentukan kelas card berdasarkan nilai rx dan tx -->
                <div class="card mb-3 @if ($data['rx'] > 0) card-green @else card-red @endif">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data['interface'] }}
                            {{-- <a href="{{ $data['url'] }}" class="btn btn-primary">Lihat Detail</a> --}}
                        </h5>
                        <p class="card-text">Download: {{ round($data['rx'] / 1000, 2) }} Kbps</p>
                        <p class="card-text">Upload: {{ round($data['tx'] / 1000, 2) }} Kbps</p>
                        <!-- Badge untuk menunjukkan status koneksi -->
                        <div class="text-center mb-2">
                            @if ($data['rx'] > 0)
                                <span class="badge badge-success">Koneksi Normal</span>
                            @else
                                <span class="badge badge-danger">Koneksi Buruk</span>
                            @endif
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
