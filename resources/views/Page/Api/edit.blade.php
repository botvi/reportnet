@extends('template.layout')

@section('style')
    <!-- Include any additional styles if needed -->
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Api</h3>
                    <p class="text-subtitle text-muted">Edit Data Api</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('teknisi.index') }}">Api</a></li>
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
                    <form action="{{ route('telegram.update', $telegram->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="api_token" class="form-label">Api Token</label>
                            <input type="text" class="form-control" id="api_token" name="api_token" value="{{ $telegram->api_token }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_chat" class="form-label">Id Chat</label>
                            <input type="text" class="form-control" id="id_chat" name="id_chat" value="{{ $telegram->id_chat }}" required>
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
