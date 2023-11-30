@extends('template.layout')

@section('style')
    <!-- Include any additional styles if needed -->
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Instansi</h3>
                    <p class="text-subtitle text-muted">Edit Data Instansi</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('instansi.index') }}">Instansi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <!-- Your edit form goes here -->
                    <form action="{{ route('instansi.update', $instansi->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_instansi" class="form-label">Nama Instansi</label>
                            <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="{{ $instansi->nama_instansi }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="admin_jaringan" class="form-label">Admin Jaringan</label>
                            <input type="text" class="form-control" id="admin_jaringan" name="admin_jaringan" value="{{ $instansi->admin_jaringan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $instansi->telepon }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="ip_wan" class="form-label">IP WAN</label>
                            <input type="text" class="form-control" id="ip_wan" name="ip_wan" value="{{ $instansi->ip_wan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $instansi->latitude }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $instansi->longitude }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="file" class="form-control" id="icon" name="icon">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <!-- Include any additional scripts if needed -->
@endsection
