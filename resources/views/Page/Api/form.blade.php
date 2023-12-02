@extends('template.layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Api Telegram</h3>
                    <p class="text-subtitle text-muted">Daftar Data Api</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/">Teknisi</a></li>
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
                        <h4 class="mt-3">Tambah Data Api</h4>
                        <form action="{{ route('telegram.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="api_token" class="form-label">Api Token</label>
                                        <input type="text" class="form-control" id="api_token" name="api_token" placeholder="Api Token">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_chat" class="form-label">Id Chat</label>
                                        <input type="text" class="form-control" id="id_chat" name="id_chat" placeholder="Id Chat">
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
