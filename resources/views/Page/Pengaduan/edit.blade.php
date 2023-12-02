@extends('template.layout')

@section('style')
    <!-- Include any additional styles if needed -->
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Status</h3>
                    <p class="text-subtitle text-muted">Edit Status</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pengaduan_admin.index') }}">Pengaduan</a></li>
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
                    <form action="{{ route('pengaduan_admin.update', $pengaduan->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="solusi" class="form-label" style="font-weight: bold; font-size:20px;">{{ $pengaduan->deskripsi_title }}</label>
                            <textarea class="form-control" id="solusi" name="solusi" rows="5" value="" readonly>{{ $pengaduan->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="solusi" class="form-label">Solusi</label>
                            <input type="text" class="form-control" id="solusi" name="solusi" value="{{ $pengaduan->solusi }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                {{-- <option value="Terkirim" {{ $pengaduan->status === 'Terkirim' ? 'selected' : '' }}>Terkirim</option> --}}
                                <option value="Proses" {{ $pengaduan->status === 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ $pengaduan->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <!-- Add more options as needed -->
                            </select>
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
