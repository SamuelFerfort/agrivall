<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pedido #{{ $pedido->id }}
            </h2>
            <a href="{{ route('admin.pedidos.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                Volver a Pedidos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Datos del Pedido</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Fecha del pedido:</span>
                            <p class="text-gray-900">{{ $pedido->fecha_pedido->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Estado:</span>
                            <p>
                                @php
                                    $estadoColors = [
                                        'pendiente' => 'bg-yellow-100 text-yellow-800',
                                        'procesando' => 'bg-blue-100 text-blue-800',
                                        'enviado' => 'bg-indigo-100 text-indigo-800',
                                        'entregado' => 'bg-green-100 text-green-800',
                                        'cancelado' => 'bg-red-100 text-red-800',
                                    ];
                                    $color = $estadoColors[$pedido->estado] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                    {{ ucfirst($pedido->estado) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Metodo de pago:</span>
                            <p class="text-gray-900">{{ ucfirst($pedido->metodo_pago) }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Total del pedido:</span>
                            <p class="text-gray-900 font-bold text-lg">{{ number_format($pedido->precio_pedido, 2) }} &euro;</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Datos del Cliente</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Nombre:</span>
                            <p class="text-gray-900">{{ $pedido->nombre_cliente }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Email:</span>
                            <p class="text-gray-900">{{ $pedido->email_cliente }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Telefono:</span>
                            <p class="text-gray-900">{{ $pedido->tlf_cliente }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Direccion de envio:</span>
                            <p class="text-gray-900">{{ $pedido->direccion_envio }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Lineas del Pedido</h3>

                    @if ($pedido->productos->isEmpty())
                        <p class="text-gray-500">Este pedido no tiene lineas de producto.</p>
                    @else
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Producto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Formato</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Cantidad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Precio Unitario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pedido->productos as $producto)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ $producto->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">{{ $producto->pivot->formato }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ $producto->pivot->cantidad }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ number_format($producto->pivot->precio_unitario, 2) }} &euro;</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 border-b">
                                            {{ number_format($producto->pivot->cantidad * $producto->pivot->precio_unitario, 2) }} &euro;
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-right text-sm font-bold text-gray-900 border-t">Total:</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 border-t">{{ number_format($pedido->precio_pedido, 2) }} &euro;</td>
                                </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <a href="{{ route('admin.pedidos.edit', $pedido) }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 transition">
                    Cambiar Estado
                </a>
                <a href="{{ route('admin.pedidos.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
