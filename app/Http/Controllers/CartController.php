<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('public.cart.index', compact('cart'));
    }

    public function add(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        $id = $producto->id;
        $cantidad = $request->input('cantidad', 1);

        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] += $cantidad;
        } else {
            $cart[$id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'formato' => $producto->formato,
                'cantidad' => $cantidad,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] = $request->input('cantidad');
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Carrito actualizado.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito esta vacio.');
        }

        return view('public.cart.checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'tlf_cliente' => 'required|string|max:20',
            'email_cliente' => 'required|email|max:255',
            'direccion_envio' => 'required|string|max:500',
            'metodo_pago' => 'required|in:tarjeta,transferencia,contra reembolso',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito esta vacio.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        $pedido = Pedido::create([
            'fecha_pedido' => now(),
            'nombre_cliente' => $request->nombre_cliente,
            'tlf_cliente' => $request->tlf_cliente,
            'email_cliente' => $request->email_cliente,
            'direccion_envio' => $request->direccion_envio,
            'metodo_pago' => $request->metodo_pago,
            'estado' => 'pendiente',
            'precio_pedido' => $total,
        ]);

        foreach ($cart as $productoId => $item) {
            $pedido->productos()->attach($productoId, [
                'cantidad' => $item['cantidad'],
                'formato' => $item['formato'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Pedido realizado correctamente. Gracias por tu compra.');
    }
}
