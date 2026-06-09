<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostBlog;
use App\Models\TipoPost;
use Illuminate\Http\Request;

class PostBlogController extends Controller
{
    public function index()
    {
        $posts = PostBlog::with('tipoPost')->orderBy('fecha_public', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $tiposPost = TipoPost::all();
        return view('admin.posts.create', compact('tiposPost'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'noticia' => 'required|string',
            'tipo_post_id' => 'required|exists:tipo_posts,id',
            'imagen' => 'nullable|image|max:2048',
        ]);

        // La fecha se asigna automaticamente: es la fecha de creacion de la noticia.
        $validated['fecha_public'] = now();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/posts'), $filename);
            $validated['imagen'] = 'posts/' . $filename;
        }

        PostBlog::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post creado correctamente.');
    }

    public function edit(PostBlog $post)
    {
        $tiposPost = TipoPost::all();
        return view('admin.posts.edit', compact('post', 'tiposPost'));
    }

    public function update(Request $request, PostBlog $post)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'noticia' => 'required|string',
            'fecha_public' => 'required|date',
            'tipo_post_id' => 'required|exists:tipo_posts,id',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($post->imagen && file_exists(public_path('images/' . $post->imagen))) {
                unlink(public_path('images/' . $post->imagen));
            }
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/posts'), $filename);
            $validated['imagen'] = 'posts/' . $filename;
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post actualizado correctamente.');
    }

    public function destroy(PostBlog $post)
    {
        if ($post->imagen && file_exists(public_path('images/' . $post->imagen))) {
            unlink(public_path('images/' . $post->imagen));
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post eliminado correctamente.');
    }
}
