@extends('template.layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Instansi</h3>
                    <p class="text-subtitle text-muted">Daftar Data Instansi</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/">Instansi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
            
                <div class="card-body">
                    <div class="container">
                        <h4 class="mt-3">Tambah Data Instansi</h4>
                        <form action="{{ route('instansi.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_instansi" class="form-label">Nama Instansi</label>
                                        <select class="form-select" id="nama_instansi" name="nama_instansi">
                                            <option selected disabled>Pilih Nama Instansi</option>
                                            @foreach($interfaces as $interface)
                                                <option value="{{ $interface['name'] }}">{{ $interface['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="admin_jaringan" class="form-label">Admin Jaringan</label>
                                        <input type="text" class="form-control" id="admin_jaringan" name="admin_jaringan" placeholder="Admin Jaringan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon">
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mac_address" class="form-label">MAC Address</label>
                                        <input type="text" class="form-control" id="mac_address" name="mac_address" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="latitude" class="form-label">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="longitude" class="form-label">Longitude</label>
                                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon (Gambar)</label>
                                        <input type="file" class="form-control" id="icon" name="icon" accept="image/*" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Batal</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>

        </section>
    </div>
 




@endsection
@section('script')

<script>
    // Dapatkan elemen select
    var selectInterface = document.getElementById("nama_instansi");
    var inputMacAddress = document.getElementById("mac_address");
    
    // Tambahkan event listener untuk perubahan pada select interface
    selectInterface.addEventListener("change", function() {
        // Dapatkan nilai yang dipilih
        var selectedInterface = selectInterface.value;
        
        // Cari interface yang sesuai dengan nama yang dipilih
        var selectedInterfaceData = {!! json_encode($interfaces) !!}.find(function(interface) {
            return interface.name === selectedInterface;
        });
        
        // Set nilai mac address sesuai dengan interface yang dipilih
        inputMacAddress.value = selectedInterfaceData.mac_address;
    });
</script>
@endsection