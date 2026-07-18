<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Menampilkan semua daftar berita di halaman Admin
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    // Menampilkan form untuk menambah berita baru
    public function create()
    {
        return view('admin.posts.create');
    }

    // Menyimpan berita baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'publisher' => 'required',
            'tanggal_kejadian' => 'required|date',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload gambar
        $imagePath = $request->file('gambar')->store('post_images', 'public');

        // Simpan data ke database
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'publisher' => $request->publisher,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'gambar' => '/storage/' . $imagePath,
            'published' => true
        ]);

        return redirect()->route('posts.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    // Menampilkan form untuk edit berita
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // Menyimpan perubahan berita ke database
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'publisher' => 'required',
            'tanggal_kejadian' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah admin mengupload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            $oldImagePath = str_replace('/storage/', '', $post->gambar);
            Storage::disk('public')->delete($oldImagePath);

            // Upload gambar baru
            $imagePath = $request->file('gambar')->store('post_images', 'public');
            $post->gambar = '/storage/' . $imagePath;
        }

        // Update data lainnya
        $post->title = $request->title;
        $post->content = $request->content;
        $post->publisher = $request->publisher;
        $post->tanggal_kejadian = $request->tanggal_kejadian;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // Menghapus berita
    public function destroy(Post $post)
    {
        // Hapus file gambar dari storage
        $oldImagePath = str_replace('/storage/', '', $post->gambar);
        Storage::disk('public')->delete($oldImagePath);

        // Hapus data dari database
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Berita berhasil dihapus!');
    }
}