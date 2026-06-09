<x-public-layout>
    <x-slot name="title">Finalizar compra</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-stone-800 mb-8">Finalizar compra</h1>

        <form action="{{ route('cart.processCheckout') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-6 md:p-8 border border-stone-100">
                        <h2 class="text-xl font-semibold text-stone-800 mb-6">Datos del pedido</h2>

                        <div class="mb-5">
                            <label for="nombre_cliente" class="block text-sm font-medium text-stone-700 mb-1">Nombre completo *</label>
                            <input type="text" name="nombre_cliente" id="nombre_cliente" value="{{ old('nombre_cliente') }}" required
                                class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:ring-olive-500 focus:border-olive-500 transition"
                                placeholder="Tu nombre completo">
                            @error('nombre_cliente')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="tlf_cliente" class="block text-sm font-medium text-stone-700 mb-1">Telefono *</label>
                            <input type="tel" name="tlf_cliente" id="tlf_cliente" value="{{ old('tlf_cliente') }}" required
                                class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:ring-olive-500 focus:border-olive-500 transition"
                                placeholder="612 345 678">
                            @error('tlf_cliente')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="email_cliente" class="block text-sm font-medium text-stone-700 mb-1">Email *</label>
                            <input type="email" name="email_cliente" id="email_cliente" value="{{ old('email_cliente') }}" required
                                class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:ring-olive-500 focus:border-olive-500 transition"
                                placeholder="tu@email.com">
                            @error('email_cliente')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="direccion_envio" class="block text-sm font-medium text-stone-700 mb-1">Direccion de envio *</label>
                            <textarea name="direccion_envio" id="direccion_envio" rows="3" required
                                class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:ring-olive-500 focus:border-olive-500 transition"
                                placeholder="Calle, numero, piso, codigo postal, ciudad...">{{ old('direccion_envio') }}</textarea>
                            @error('direccion_envio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="metodo_pago" class="block text-sm font-medium text-stone-700 mb-1">Metodo de pago *</label>
                            <select name="metodo_pago" id="metodo_pago" required
                                class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:ring-olive-500 focus:border-olive-500 transition bg-white">
                                <option value="" disabled {{ old('metodo_pago') ? '' : 'selected' }}>Selecciona un metodo de pago</option>
                                <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia bancaria</option>
                                <option value="bizum" {{ old('metodo_pago') == 'bizum' ? 'selected' : '' }}>Bizum</option>
                            </select>
                            @error('metodo_pago')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-stone-500">No se realiza ningun cobro online. Al confirmar el pedido recibiras por correo los datos para pagar por transferencia o Bizum.</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 border border-stone-100 sticky top-8">
                        <h2 class="text-xl font-semibold text-stone-800 mb-4">Resumen del pedido</h2>

                        <div class="divide-y divide-stone-100">
                            @php $total = 0; @endphp
                            @foreach($cart as $id => $item)
                                @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
                                <div class="py-3">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1 pr-4">
                                            <p class="font-medium text-stone-800 text-sm">{{ $item['nombre'] }}</p>
                                            <p class="text-xs text-stone-500">{{ $item['formato'] }} x {{ $item['cantidad'] }}</p>
                                        </div>
                                        <span class="text-sm font-medium text-stone-700 whitespace-nowrap">{{ number_format($subtotal, 2, ',', '.') }} &euro;</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-stone-200 mt-2 pt-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-stone-500">Subtotal</span>
                                <span class="text-sm text-stone-700">{{ number_format($total, 2, ',', '.') }} &euro;</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-stone-500">Envio</span>
                                <span class="text-sm text-stone-500">Por determinar</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-stone-200">
                                <span class="text-lg font-semibold text-stone-800">Total</span>
                                <span class="text-xl font-bold text-olive-700">{{ number_format($total, 2, ',', '.') }} &euro;</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-6 bg-olive-700 hover:bg-olive-800 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 text-lg">
                            Confirmar pedido
                        </button>

                        <a href="{{ route('cart.index') }}" class="block text-center mt-4 text-sm text-olive-700 hover:text-olive-800 font-medium">
                            &larr; Volver al carrito
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-public-layout>
