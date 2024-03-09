@extends('template.layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Mikrotik</h3>
                    <p class="text-subtitle text-muted">Tambah Data Mikrotik</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mikrotik</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a type="button" href="/mikrotik/form"class="btn icon icon-left btn-primary float-right"><i
                            class="bi bi-plus-circle"></i>
                        TAMBAH DATA
                    </a>

                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">IP</th>
                                <th scope="col">USERNAME</th>
                                <th scope="col">PASSWORD</th>
                                <th scope="col">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($mikrotik as $index => $mikrotik)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $mikrotik->ip }}</td>
                                    <td>{{ $mikrotik->username }}</td> 
                                    <td>{{ $mikrotik->password }}</td> 
                                    

                                    <td>
                                        <a class="btn btn-danger btn-sm ml-1 w-[50px] data-destroy"
                                            data-id="{{ $mikrotik->id }}"><i class="bi bi-trash"></i></a>
                                        <a href="{{ route('mikrotik.edit', $mikrotik->id) }}"
                                            class="btn btn-success btn-sm ml-1 w-[50px]"><i class="bi bi-pencil-square"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-center" scope="col">MIKROTIK HANYA BISA SATU , JANGAN LEBIH !</th>
                            </tfoot>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).on("click", ".data-destroy", function() {
            const id = $(this).data("id");
            const url = "/mikrotik/destroy/" + id;
            destroy(url); // Corrected function name
        });
    </script>
@endsection
