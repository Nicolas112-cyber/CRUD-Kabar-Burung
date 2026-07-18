@extends('master')
@section('title', 'Admin - Tambah Berita')
@section('body')
<div class="container mt-5 mb-5">
    <h2>Tambah Berita Baru</h2>
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Penulis / Publisher</label>
                    <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kejadian</label>
                    <input type="date" name="tanggal_kejadian" class="form-control" value="{{ old('tanggal_kejadian') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Sampul</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Berita</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Berita</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@stop