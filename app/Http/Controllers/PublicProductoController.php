<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class PublicProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return view('public.productos.index', compact('productos'));
    }

    public function show(Producto $producto)
    {
        return view('public.productos.show', compact('producto'));
    }
}
