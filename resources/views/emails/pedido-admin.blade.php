<x-mail::message>
# Nuevo pedido recibido (#{{ $pedido->id }})

Se ha registrado un nuevo pedido en la web.

- **Cliente:** {{ $pedido->nombre_cliente }}
- **Email:** {{ $pedido->email_cliente }}
- **Telefono:** {{ $pedido->tlf_cliente }}
- **Direccion de envio:** {{ $pedido->direccion_envio }}
- **Metodo de pago:** {{ ucfirst($pedido->metodo_pago) }}
- **Fecha:** {{ $pedido->fecha_pedido->format('d/m/Y') }}

<x-mail::table>
| Producto | Formato | Cant. | P. unitario | Subtotal |
|:---------|:--------|:-----:|------------:|---------:|
@foreach ($pedido->productos as $producto)
| {{ $producto->nombre }} | {{ $producto->pivot->formato }} | {{ $producto->pivot->cantidad }} | {{ number_format($producto->pivot->precio_unitario, 2, ',', '.') }} € | {{ number_format($producto->pivot->cantidad * $producto->pivot->precio_unitario, 2, ',', '.') }} € |
@endforeach
</x-mail::table>

**Total: {{ number_format($pedido->precio_pedido, 2, ',', '.') }} €**

<x-mail::button :url="route('admin.pedidos.show', $pedido)">
Ver pedido en el panel
</x-mail::button>
</x-mail::message>
