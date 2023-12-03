@extends('website.layout')
@section('content')
    <section class="pb-6">
        <div class="container">
            <div class="main-body">
                <div class="row align-items-center">
                    <h2 class="mb-4">Pengaduan</h2>

                    <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi_title" class="form-label">Judul</label>
                            <textarea class="form-control" id="deskripsi_title" name="deskripsi_title" rows="3" required></textarea>
                        </div>
                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Pengaduan</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>

                <!-- end of .container-->
                <div class="container">
                    <div class="container mt-2">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduan as $index => $pengaduan)
                                        @if ($pengaduan->user->id === Auth::id())
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $pengaduan->user->instansi->nama_instansi }}</td>
                                                <td>
                                                    @if ($pengaduan->gambar)
                                                        <button type="button" class="btn btn-info btn-sm"
                                                            onclick="showImage('{{ asset('storage/' . $pengaduan->gambar) }}')">Cek
                                                            Gambar</button>
                                                    @else
                                                        Tidak Ada Gambar
                                                    @endif
                                                </td>
                                                <td>{{ $pengaduan->deskripsi_title }}</td>

                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        onclick="showDescription('{{ $pengaduan->deskripsi }}')">Lihat
                                                        Aduan</button>

                                                    @if ($pengaduan->status !== 'Proses' && $pengaduan->status !== 'Selesai')
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            onclick="showEditForm('{{ $pengaduan->id }}', '{{ $pengaduan->deskripsi }}')">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    @endif
                                                </td>


                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        onclick="showSolusi('{{ $pengaduan->solusi }}')">Lihat
                                                        Solusi
                                                    </button>
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeColor = '';
                                                        switch ($pengaduan->status) {
                                                            case 'Terkirim':
                                                                $badgeColor = 'badge-primary';
                                                                break;
                                                            case 'Proses':
                                                                $badgeColor = 'badge-warning';
                                                                break;
                                                            case 'Selesai':
                                                                $badgeColor = 'badge-success';
                                                                break;
                                                            default:
                                                                $badgeColor = 'badge-secondary';
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badgeColor }}">{{ $pengaduan->status }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- end of .container-->
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

    {{-- FORM EDIT DESKRIPSI --}}
    <script>
        function showEditForm(pengaduanId, currentDeskripsi) {
            $('#editForm').attr('action', '/pengaduan/update/' + pengaduanId);
            $('#deskripsiInput').val(currentDeskripsi);
            $('#editModal').modal('show');
        }

        function handleFormSuccess() {
            location.reload();
        }
    </script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
            });
        @endif
    </script>
@endsection

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Deskripsi</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
            </div>

            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="deskripsiInput">Pengaduan</label>
                        <textarea class="form-control" id="deskripsiInput" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/pengaduan" type="button" class="btn btn-secondary">Batal</a>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- FORM EDIT DESKRIPSI --}}
