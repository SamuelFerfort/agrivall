<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::orderBy('fecha_pedido', 'desc')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('productos');
        return view('admin.pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        return view('admin.pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'estado' => 'required|string|max:255',
        ]);

        $pedido->update($validated);

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Estado del pedido actualizado correctamente.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->productos()->detach();
        $pedido->delete();

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Pedido eliminado correctamente.');
    }
}
