@extends('website.layout')
@section('content')
@section('style')
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
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@endsection
    <section class="pb-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin"
                                                class="rounded-circle p-1 bg-primary" width="110">
                                            <div class="mt-3">
                                                @isset($user->instansi)

                                                <h4> {{ $user->instansi->nama_instansi }}</h4>
                                                <p class="text-secondary mb-1">@ {{ $user->username }}</p>
                                                <p class="text-muted font-size-sm">{{ $user->instansi->admin_jaringan }}</p>
                                                {{-- <button class="btn btn-primary">Follow</button>
                                                <button class="btn btn-outline-primary">Message</button> --}}
                                                @endisset
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <ul class="list-group list-group-flush">
                                            <div id="map" style="height: 400px;"></div>

                                            <script>
                                                // Ambil data nama_instansi, latitude, dan longitude dari instansi pengguna yang login
                                                var namaInstansi = "{{ $user->instansi->nama_instansi ?? 'Instansi Tidak Ditemukan' }}";
                                                var latitude = {{ $user->instansi->latitude ?? 0 }};
                                                var longitude = {{ $user->instansi->longitude ?? 0 }};
                                                
                                                // Ambil URL untuk ikon dari direktori public/storage/icons
                                                var iconUrl = "{{ asset('storage/' . $user->instansi->icon) }}"; // Sesuaikan dengan nama ikon yang sesuai
                                        
                                                // Inisialisasi peta Leaflet
                                                var map = L.map('map').setView([latitude, longitude], 13);
                                        
                                                // Tambahkan tile layer (misalnya, OpenStreetMap)
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    attribution: '© OpenStreetMap contributors'
                                                }).addTo(map);
                                        
                                                // Tambahkan marker pada lokasi instansi dengan ikon kustom
                                                var customIcon = L.icon({
                                                    iconUrl: iconUrl,
                                                    iconSize: [32, 32], // Sesuaikan ukuran ikon
                                                    iconAnchor: [16, 32], // Sesuaikan anchor ikon
                                                    popupAnchor: [0, -32] // Sesuaikan anchor popup
                                                });
                                        
                                                L.marker([latitude, longitude], {icon: customIcon}).addTo(map)
                                                    .bindPopup(namaInstansi);
                                            </script>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('update.account') }}">
                                            @csrf

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Username</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" id="username"
                                                        name="username" value="{{ $user->username }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="password" class="form-control" id="current_password"
                                                        name="current_password" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">New Password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="new_password"
                                                            name="new_password">
                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="showPasswordToggle">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Pesan Kesalahan -->
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('new_password');
            const showPasswordToggle = document.getElementById('showPasswordToggle');

            showPasswordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        });
    </script>
@endsection