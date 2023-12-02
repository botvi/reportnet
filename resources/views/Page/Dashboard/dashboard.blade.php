@extends('template.layout')

@section('content')
    <div class="page-heading">
        <h3>Aktifitas</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
            </div>
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="bi bi-exclamation-square-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pengaduan Baru</h6>
                                    @if ($terkirimCount > 0)
                                        <h6 class="font-extrabold mb-0">{{ $terkirimCount }}</h6>
                                        @else
                                        <h6 class="font-extrabold mb-0">0</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="bi bi-hand-thumbs-up-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pengaduan Di Proses</h6>
                                    @if ($prosesCount > 0)
                                        <h6 class="font-extrabold mb-0">{{ $prosesCount }}</h6>
                                        @else
                                        <h6 class="font-extrabold mb-0">0</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="bi bi-check-square-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pengaduan Selesai</h6>
                                    @if ($selesaiCount > 0)
                                        <h6 class="font-extrabold mb-0">{{ $selesaiCount }}</h6>
                                    @else
                                    <h6 class="font-extrabold mb-0">0</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
