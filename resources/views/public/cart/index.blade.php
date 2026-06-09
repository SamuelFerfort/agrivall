<x-public-layout>
    <x-slot name="title">Carrito</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-stone-800 mb-8">Tu carrito de compra</h1>

        @if(count($cart) > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-stone-100">
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-stone-50 border-b border-stone-200">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-stone-600">Producto</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-stone-600">Formato</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-stone-600">Cantidad</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-stone-600">Precio</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-stone-600">Subtotal</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-stone-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cart as $id => $item)
                                @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
                                <tr class="border-b border-stone-100 hover:bg-stone-50 transition" data-cart-row="{{ $id }}">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('productos.show', $id) }}" class="font-medium text-stone-800 hover:text-olive-700">
                                            {{ $item['nombre'] }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-stone-500 text-sm">
                                        {{ $item['formato'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center">
                                            <input type="number" value="{{ $item['cantidad'] }}" min="1" max="99"
                                                data-cart-qty data-update-url="{{ route('cart.update', $id) }}" data-id="{{ $id }}"
                                                class="w-16 text-center border border-stone-300 rounded-lg py-1 focus:ring-olive-500 focus:border-olive-500 text-sm">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right text-stone-600">
                                        {{ number_format($item['precio'], 2, ',', '.') }} &euro;
                                    </td>
                                    <td class="px-6 py-4 text-right font-semibold text-stone-800" data-subtotal="{{ $id }}">
                                        {{ number_format($subtotal, 2, ',', '.') }} &euro;
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button type="button" data-cart-remove data-remove-url="{{ route('cart.remove', $id) }}" data-id="{{ $id }}"
                                            class="text-red-500 hover:text-red-700 transition" title="Eliminar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="md:hidden divide-y divide-stone-100">
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
                        <div class="p-4" data-cart-row="{{ $id }}">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <a href="{{ route('productos.show', $id) }}" class="font-medium text-stone-800 hover:text-olive-700">
                                        {{ $item['nombre'] }}
                                    </a>
                                    <p class="text-sm text-stone-500">{{ $item['formato'] }}</p>
                                </div>
                                <button type="button" data-cart-remove data-remove-url="{{ route('cart.remove', $id) }}" data-id="{{ $id }}"
                                    class="text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <input type="number" value="{{ $item['cantidad'] }}" min="1" max="99"
                                        data-cart-qty data-update-url="{{ route('cart.update', $id) }}" data-id="{{ $id }}"
                                        class="w-16 text-center border border-stone-300 rounded-lg py-1 text-sm">
                                    <span class="text-sm text-stone-500">x {{ number_format($item['precio'], 2, ',', '.') }} &euro;</span>
                                </div>
                                <span class="font-semibold text-stone-800" data-subtotal="{{ $id }}">{{ number_format($subtotal, 2, ',', '.') }} &euro;</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                @php
                    $total = 0;
                    foreach($cart as $item) {
                        $total += $item['precio'] * $item['cantidad'];
                    }
                @endphp
                <div class="bg-stone-50 px-6 py-5 border-t border-stone-200">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-semibold text-stone-700">Total</span>
                        <span class="text-2xl font-bold text-olive-700" data-cart-total>{{ number_format($total, 2, ',', '.') }} &euro;</span>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="{{ route('productos.index') }}" class="text-olive-700 hover:text-olive-800 font-medium">
                    &larr; Seguir comprando
                </a>
                <a href="{{ route('cart.checkout') }}" class="inline-block bg-olive-700 hover:bg-olive-800 text-white font-semibold py-3 px-10 rounded-lg transition duration-200 text-lg">
                    Proceder al pago
                </a>
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-xl shadow-md border border-stone-100">
                <svg class="w-20 h-20 text-stone-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                </svg>
                <h2 class="text-2xl font-semibold text-stone-500 mb-3">Tu carrito esta vacio</h2>
                <p class="text-stone-400 mb-8">Anade productos para empezar tu pedido.</p>
                <a href="{{ route('productos.index') }}" class="inline-block bg-olive-700 hover:bg-olive-800 text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                    Ver productos
                </a>
            </div>
        @endif
    </div>
</x-public-layout>
