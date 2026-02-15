<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SemanaCasilla;
use Illuminate\Http\Request;

class SemanaCasillaController extends Controller
{
    public function index()
    {
        $semanas = SemanaCasilla::orderBy('anyo', 'desc')
            ->orderBy('numero_sem', 'desc')
            ->get();
        return view('admin.semanas.index', compact('semanas'));
    }

    public function create()
    {
        return view('admin.semanas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anyo' => 'required|integer|min:2000|max:2100',
            'numero_sem' => 'required|integer|min:1|max:53',
            'descriptor' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|string|max:255',
        ]);

        SemanaCasilla::create($validated);

        return redirect()->route('admin.semanas.index')
            ->with('success', 'Semana creada correctamente.');
    }

    public function edit(SemanaCasilla $semana)
    {
        return view('admin.semanas.edit', compact('semana'));
    }

    public function update(Request $request, SemanaCasilla $semana)
    {
        $validated = $request->validate([
            'anyo' => 'required|integer|min:2000|max:2100',
            'numero_sem' => 'required|integer|min:1|max:53',
            'descriptor' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|string|max:255',
        ]);

        $semana->update($validated);

        return redirect()->route('admin.semanas.index')
            ->with('success', 'Semana actualizada correctamente.');
    }

    public function destroy(SemanaCasilla $semana)
    {
        $semana->delete();

        return redirect()->route('admin.semanas.index')
            ->with('success', 'Semana eliminada correctamente.');
    }
}
