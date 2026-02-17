<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\PostBlog;

class HomeController extends Controller
{
    public function index()
    {
        $productos = Producto::where('disponible', true)->take(4)->get();
        $posts = PostBlog::with('tipoPost')->orderBy('fecha_public', 'desc')->take(3)->get();

        return view('home', compact('productos', 'posts'));
    }
}
