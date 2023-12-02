@extends('template.layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Api Telegram</h3>
                    <p class="text-subtitle text-muted">Tambah Data Api</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Api</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a type="button" href="/api/form"class="btn icon icon-left btn-primary float-right"><i
                            class="bi bi-plus-circle"></i>
                        TAMBAH DATA
                    </a>

                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Api Token</th>
                                <th scope="col">Id Chat</th>
                                <th scope="col">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($telegram as $index => $telegram)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $telegram->api_token }}</td>
                                    <td>{{ $telegram->id_chat }}</td>
                                    

                                    <td>
                                        <a class="btn btn-danger btn-sm ml-1 w-[50px] data-destroy"
                                            data-id="{{ $telegram->id }}"><i class="bi bi-trash"></i></a>
                                        <a href="{{ route('telegram.edit', $telegram->id) }}"
                                            class="btn btn-success btn-sm ml-1 w-[50px]"><i class="bi bi-pencil-square"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-center" scope="col">API HANYA BISA SATU , JANGAN LEBIH !</th>
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
            const url = "/api/destroy/" + id;
            destroy(url); // Corrected function name
        });
    </script>
@endsection
