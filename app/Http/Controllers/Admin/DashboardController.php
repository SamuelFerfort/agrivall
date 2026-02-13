<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\PostBlog;
use App\Models\Producto;
use App\Models\SemanaCasilla;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();
        $totalPedidos = Pedido::count();
        $totalPosts = PostBlog::count();
        $totalSemanas = SemanaCasilla::count();

        return view('admin.dashboard', compact(
            'totalProductos',
            'totalPedidos',
            'totalPosts',
            'totalSemanas'
        ));
    }
}
