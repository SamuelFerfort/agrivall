<x-mail::message>
# Gracias por tu pedido, {{ $pedido->nombre_cliente }}

Hemos recibido tu pedido **#{{ $pedido->id }}** correctamente. Estos son los detalles:

<x-mail::table>
| Producto | Formato | Cant. | P. unitario | Subtotal |
|:---------|:--------|:-----:|------------:|---------:|
@foreach ($pedido->productos as $producto)
| {{ $producto->nombre }} | {{ $producto->pivot->formato }} | {{ $producto->pivot->cantidad }} | {{ number_format($producto->pivot->precio_unitario, 2, ',', '.') }} € | {{ number_format($producto->pivot->cantidad * $producto->pivot->precio_unitario, 2, ',', '.') }} € |
@endforeach
</x-mail::table>

**Total del pedido: {{ number_format($pedido->precio_pedido, 2, ',', '.') }} €**

## Datos para el pago

@if ($pedido->metodo_pago === 'transferencia')
Has elegido **transferencia bancaria**. Por favor, realiza el ingreso a:

- **IBAN:** ES12 3456 7890 1234 5678 9012
- **Titular:** AGRIVALL
- **Concepto:** Pedido #{{ $pedido->id }}
@elseif ($pedido->metodo_pago === 'bizum')
Has elegido **Bizum**. Envia el importe al numero **612 345 678** indicando en el concepto "Pedido #{{ $pedido->id }}".
@else
Metodo de pago seleccionado: **{{ ucfirst($pedido->metodo_pago) }}**.
@endif

En cuanto confirmemos el pago, prepararemos tu envio a:

{{ $pedido->direccion_envio }}

Gracias por confiar en productos del campo valenciano.

Saludos,<br>
El equipo de {{ config('app.name') }}
</x-mail::message>
