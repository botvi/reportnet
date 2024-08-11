@extends('template.layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pengaduan</h3>
                    <p class="text-subtitle text-muted">Daftar Pengaduan Instansi</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengaduan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Instansi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Aduan</th>
                                <th scope="col">Solusi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $index => $pengaduan)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $pengaduan->user->instansi->nama_instansi }}</td>
                                    <td>
                                        @if ($pengaduan->gambar)
                                            <button type="button" class="btn btn-info btn-sm"
                                                onclick="showImage('{{ asset($pengaduan->gambar) }}')">Cek
                                                Gambar</button>
                                        @else
                                            Tidak Ada Gambar
                                        @endif
                                    </td>
                                    <td>{{ $pengaduan->deskripsi_title }}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="showDescription('{{ $pengaduan->deskripsi }}')">Lihat Aduan
                                        </button>

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="showSolusi('{{ $pengaduan->solusi }}')">Lihat Solusi
                                        </button>
                                    <td>
                                        @php
                                            $badgeColor = '';
                                            $statusText = '';

                                            switch ($pengaduan->status) {
                                                case 'Terkirim':
                                                    $badgeColor = 'badge-danger';
                                                    $statusText = 'Belum di proses';
                                                    break;
                                                case 'Proses':
                                                    $badgeColor = 'badge-warning';
                                                    $statusText = 'Proses';
                                                    break;
                                                case 'Selesai':
                                                    $badgeColor = 'badge-success';
                                                    $statusText = 'Selesai';
                                                    break;
                                                default:
                                                    $badgeColor = 'badge-secondary';
                                                    $statusText = 'Status tidak valid';
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeColor }}">{{ $statusText }}</span>
                                    </td>

                                   
                                    <td>
                                        @if ($pengaduan->status != 'Selesai')
                                            <a href="{{ route('pengaduan_admin.edit', $pengaduan->id) }}"
                                                class="btn btn-success btn-sm ml-1 w-[50px]">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
@section('script')
    <script>
        function showImage(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageAlt: 'Gambar'
            });
        }

        function showDescription(deskripsi) {
            Swal.fire({
                title: 'Pengaduan',
                text: deskripsi,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }

        function showSolusi(solusi) {
            Swal.fire({
                title: 'Solusi',
                text: solusi,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }
    </script>
@endsection
