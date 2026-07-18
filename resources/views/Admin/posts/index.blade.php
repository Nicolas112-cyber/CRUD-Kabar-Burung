@extends('master')
@section('title', 'Admin - Daftar Berita')
@section('body')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Berita</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Tambah Berita Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul Berita</th>
                        <th>Publisher</th>
                        <th>Tanggal Kejadian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $index => $post)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ asset($post->gambar) }}" alt="Gambar Berita" style="width: 100px; height: 60px; object-fit: cover;" class="rounded">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->publisher }}</td>
                        <td>{{ \Carbon\Carbon::parse($post->tanggal_kejadian)->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada berita. Silakan tambah berita baru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop