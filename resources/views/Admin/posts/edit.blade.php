@extends('master')
@section('title', 'Admin - Edit Berita')
@section('body')
<div class="container mt-5 mb-5">
    <h2>Edit Berita</h2>
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Penulis / Publisher</label>
                    <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $post->publisher) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kejadian</label>
                    <input type="date" name="tanggal_kejadian" class="form-control" value="{{ old('tanggal_kejadian', $post->tanggal_kejadian) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Sampul (Biarkan kosong jika tidak ingin mengubah)</label>
                    <div class="mb-2">
                        <img src="{{ asset($post->gambar) }}" alt="Current Image" style="height: 100px; border-radius: 8px;">
                    </div>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Berita</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Berita</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@stop