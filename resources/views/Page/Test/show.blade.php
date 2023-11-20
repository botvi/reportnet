@extends('template.layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>DataTable</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn icon icon-left btn-primary float-right" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="bi bi-plus-circle"></i>
                        TAMBAH DATA
                    </button>

                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Latitude</th>
                                <th scope="col">Longitude</th>
                                <th scope="col">Icon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lokasis as $lokasi)
                                <tr>
                                    <th scope="row">{{ $lokasi->id }}</th>
                                    <td>{{ $lokasi->name }}</td>
                                    <td>{{ $lokasi->latitude }}</td>
                                    <td>{{ $lokasi->longitude }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $lokasi->icon_path) }}" alt="{{ $lokasi->name }}" width="50">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <section id="multiple-column-form">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Multiple Column</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form action="{{ route('lokasi.store') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="name">Nama</label>
                                                            <input type="text" id="name" class="form-control"
                                                                placeholder="Name" name="name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="latitude">Latitude</label>
                                                            <input type="text" id="latitude" class="form-control"
                                                                placeholder="Latitude" name="latitude">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="longitude">Longitude</label>
                                                            <input type="text" id="longitude" class="form-control"
                                                                placeholder="Longitude" name="longitude">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="icon" class="form-label">Icon Path
                                                                (Image)</label>
                                                            <input type="file" class="form-control" id="icon"
                                                                name="icon_path" accept="image/*" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="polygon_color">Warna Lokasi</label>
                                                            <input type="color" id="polygon_color" class="form-control" name="polygon_color" value="#ff0000">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit"
                                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                                        <button type="reset"
                                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
