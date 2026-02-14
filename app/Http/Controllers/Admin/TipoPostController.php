<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoPost;
use Illuminate\Http\Request;

class TipoPostController extends Controller
{
    public function index()
    {
        $tiposPost = TipoPost::withCount('posts')->orderBy('created_at', 'desc')->get();
        return view('admin.tipo-posts.index', compact('tiposPost'));
    }

    public function create()
    {
        return view('admin.tipo-posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        TipoPost::create($validated);

        return redirect()->route('admin.tipo-posts.index')
            ->with('success', 'Tipo de post creado correctamente.');
    }

    public function edit(TipoPost $tipoPost)
    {
        return view('admin.tipo-posts.edit', compact('tipoPost'));
    }

    public function update(Request $request, TipoPost $tipoPost)
    {
        $validated = $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        $tipoPost->update($validated);

        return redirect()->route('admin.tipo-posts.index')
            ->with('success', 'Tipo de post actualizado correctamente.');
    }

    public function destroy(TipoPost $tipoPost)
    {
        $tipoPost->delete();

        return redirect()->route('admin.tipo-posts.index')
            ->with('success', 'Tipo de post eliminado correctamente.');
    }
}
