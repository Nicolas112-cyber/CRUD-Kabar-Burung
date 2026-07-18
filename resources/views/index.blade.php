@extends('master')

@section('title', 'Kabar Burung - Night Mode')

@section('body')
<!-- CSS Tambahan untuk Efek Glossy & Night Mode -->
<style>
    body {
        background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); /* Efek malam glossy */
        color: #ffffff;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.05) !important; /* Semi-transparan glossy */
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
    }
    .card-title, .text-muted {
        color: #ffffff !important;
    }
    .display-4 { color: #ffffff !important; }
</style>

<div class="container mt-4 mb-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">KABAR BURUNG NEWS</h1>
            <p class="lead" style="color: #cccccc;">Portal Berita Terpercaya, Aktual, dan Tajam di Malam Hari</p>
            <hr style="border-color: #555;">
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($posts as $post)
        <div class="col">
            <div class="card h-100 shadow-lg">
                <img src="{{ $post->gambar }}" class="card-img-top" alt="Berita" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2" style="font-size: 0.85rem; opacity: 0.7;">
                        <span>{{ $post->publisher }}</span>
                        <span>{{ \Carbon\Carbon::parse($post->tanggal_kejadian)->format('d M Y') }}</span>
                    </div>
                    <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                    <p class="card-text" style="opacity: 0.8;">{{ Str::limit($post->content, 100) }}</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-end pb-3">
                    <!-- Tombol Putih Glossy -->
                    <a href="#" class="btn btn-sm btn-light px-3 rounded-pill fw-bold">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop