<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // 1. INDEX: Menampilkan daftar post (Bonus: Search & Pagination)
    public function index(Request $request)
    {
        $posts = Post::latest()
            ->filter(request(['search']))
            ->paginate(5)
            ->withQueryString();

        return view('posts.index', compact('posts'));
    }

    // 2. CREATE: Menampilkan form tambah post
    public function create()
    {
        return view('posts.create');
    }

    // 3. STORE: Menyimpan data post baru (Validation + Image Upload)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'   => 'required|max:255',
            'author'  => 'required|max:100',
            'status'  => 'required|in:DRAFT,PUBLISHED,ARCHIVED',
            'image'   => 'nullable|image|file|max:2048', // Max 2MB
            'content' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }

        $validatedData['slug'] = Str::slug($request->title) . '-' . time();

        Post::create($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Post baru berhasil dipublikasikan ke sistem!');
    }

    // 4. SHOW: Menampilkan detail 1 post (Route Model Binding)
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 5. EDIT: Menampilkan form edit post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // 6. UPDATE: Memperbarui data post
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title'   => 'required|max:255',
            'author'  => 'required|max:100',
            'status'  => 'required|in:DRAFT,PUBLISHED,ARCHIVED',
            'image'   => 'nullable|image|file|max:2048',
            'content' => 'required',
        ]);

        if ($request->file('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }

        $validatedData['slug'] = Str::slug($request->title) . '-' . time();

        $post->update($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Data post berhasil diperbarui!');
    }

    // 7. DESTROY: Menghapus post (Soft Delete)
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete(); // Soft delete terpicu otomatis dari Trait Model

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dihapus (Soft Delete)!');
    }
}