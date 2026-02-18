<x-public-layout>
    <x-slot name="title">{{ $producto->nombre }}</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-stone-500">
                <li><a href="{{ route('home') }}" class="hover:text-olive-700">Inicio</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('productos.index') }}" class="hover:text-olive-700">Productos</a></li>
                <li><span>/</span></li>
                <li class="text-stone-800 font-medium">{{ $producto->nombre }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                @if($producto->imagen)
                    <img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-[400px] lg:h-[500px] object-cover rounded-xl shadow-lg">
                @else
                    <div class="w-full h-[400px] lg:h-[500px] bg-gradient-to-br from-olive-100 to-olive-200 flex items-center justify-center rounded-xl shadow-lg">
                        <svg class="w-24 h-24 text-olive-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                @endif
            </div>

            <div>
                <div class="mb-4">
                    @if($producto->disponible)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-olive-100 text-olive-800">
                            Disponible
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            Agotado
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-stone-800 mb-2">{{ $producto->nombre }}</h1>

                @if($producto->variedad)
                    <p class="text-lg text-stone-500 mb-2">Variedad: {{ $producto->variedad }}</p>
                @endif

                <p class="text-stone-500 mb-6">Formato: {{ $producto->formato }}</p>

                <div class="mb-8">
                    <span class="text-4xl font-bold text-olive-700">{{ number_format($producto->precio, 2, ',', '.') }} &euro;</span>
                    <span class="text-sm text-stone-400 ml-2">IVA incluido</span>
                </div>

                <div class="border-t border-stone-200 pt-6 mb-8">
                    <h3 class="text-lg font-semibold text-stone-800 mb-3">Descripcion del producto</h3>
                    <p class="text-stone-600 leading-relaxed">
                        Producto artesanal de AGRIVALL, elaborado con esmero en el campo valenciano. {{ $producto->nombre }}
                        @if($producto->variedad)
                            de la variedad {{ $producto->variedad }}
                        @endif
                        en formato {{ $producto->formato }}. Calidad garantizada directa del productor.
                    </p>
                </div>

                @if($producto->disponible)
                    <form action="{{ route('cart.add', $producto) }}" method="POST" class="bg-stone-50 rounded-xl p-6 border border-stone-200">
                        @csrf
                        <div class="mb-4">
                            <label for="cantidad" class="block text-sm font-medium text-stone-700 mb-2">Cantidad</label>
                            <div class="flex items-center">
                                <button type="button" onclick="decrementQty()" class="bg-stone-200 hover:bg-stone-300 text-stone-700 font-bold py-2 px-4 rounded-l-lg transition">
                                    -
                                </button>
                                <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="99"
                                    class="w-20 text-center border-t border-b border-stone-300 py-2 focus:outline-none focus:ring-0 focus:border-stone-300">
                                <button type="button" onclick="incrementQty()" class="bg-stone-200 hover:bg-stone-300 text-stone-700 font-bold py-2 px-4 rounded-r-lg transition">
                                    +
                                </button>
                            </div>
                            @error('cantidad')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-olive-700 hover:bg-olive-800 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 text-lg">
                            Anadir al carrito
                        </button>
                    </form>
                @else
                    <div class="bg-stone-50 rounded-xl p-6 border border-stone-200 text-center">
                        <p class="text-stone-500 text-lg">Este producto no esta disponible actualmente.</p>
                        <p class="text-stone-400 text-sm mt-2">Vuelve a visitarnos proximamente.</p>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('productos.index') }}" class="text-olive-700 hover:text-olive-800 font-medium text-sm">
                        &larr; Volver a productos
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function incrementQty() {
            const input = document.getElementById('cantidad');
            const max = parseInt(input.max) || 99;
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        }
        function decrementQty() {
            const input = document.getElementById('cantidad');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
</x-public-layout>
