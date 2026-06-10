<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Producto;
use App\Models\Pedido;
use App\Mail\PedidoConfirmado;
use App\Mail\PedidoNotificacionAdmin;

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
        $cantidad = (int) $request->input('cantidad', 1);

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

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Producto agregado al carrito.',
                'count' => $this->cartCount(),
            ]);
        }

        return back()->with('success', 'Producto agregado al carrito.');
    }

    private function cartCount(): int
    {
        return count(session()->get('cart', []));
    }

    private function cartTotal(): float
    {
        $total = 0;
        foreach (session()->get('cart', []) as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return $total;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] = (int) $request->input('cantidad');
            session()->put('cart', $cart);
        }

        if ($request->expectsJson()) {
            $subtotal = isset($cart[$id]) ? $cart[$id]['precio'] * $cart[$id]['cantidad'] : 0;

            return response()->json([
                'subtotal' => $subtotal,
                'total' => $this->cartTotal(),
                'count' => $this->cartCount(),
            ]);
        }

        return back()->with('success', 'Carrito actualizado.');
    }

    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'total' => $this->cartTotal(),
                'count' => $this->cartCount(),
                'empty' => empty($cart),
            ]);
        }

        return back()->with('success', 'Producto eliminado del carrito.');
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
            'tlf_cliente' => ['required', 'string', 'max:20', 'regex:/^(\+34\s?)?[6-9](\s?\d){8}$/'],
            'email_cliente' => 'required|email|max:255',
            'direccion_envio' => 'required|string|max:500',
            'metodo_pago' => 'required|in:transferencia,bizum',
        ], [
            'tlf_cliente.regex' => 'Introduce un numero de telefono valido (9 digitos).',
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
            'estado' => 'iniciado',
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

        // Email de confirmacion al cliente y aviso al admin.
        try {
            $pedido->load('productos');
            Mail::to($pedido->email_cliente)->send(new PedidoConfirmado($pedido));
            Mail::to(config('mail.admin_address'))->send(new PedidoNotificacionAdmin($pedido));
        } catch (\Throwable $e) {
            Log::warning('No se pudo enviar el correo del pedido #'.$pedido->id.': '.$e->getMessage());
        }

        return redirect()->route('home')->with('success', 'Pedido realizado correctamente. Te hemos enviado un correo de confirmacion. Gracias por tu compra.');
    }
}
