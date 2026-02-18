<x-public-layout>
    <x-slot name="title">Productos</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-stone-800 mb-4">Nuestros Productos</h1>
            <p class="text-lg text-stone-600 max-w-2xl mx-auto">Productos artesanales del campo valenciano, elaborados con tradicion y cuidado. Aceite de oliva, miel, almendras y mas.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($productos as $producto)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-stone-100 flex flex-col">
                    @if($producto->imagen)
                        <img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-52 object-cover">
                    @else
                        <div class="w-full h-52 bg-gradient-to-br from-olive-100 to-olive-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-olive-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    @endif

                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-stone-800">{{ $producto->nombre }}</h3>
                            @if($producto->disponible)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-olive-100 text-olive-800 whitespace-nowrap ml-2">
                                    Disponible
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 whitespace-nowrap ml-2">
                                    Agotado
                                </span>
                            @endif
                        </div>

                        @if($producto->variedad)
                            <p class="text-sm text-stone-500 mb-1">{{ $producto->variedad }}</p>
                        @endif
                        <p class="text-sm text-stone-500 mb-4">{{ $producto->formato }}</p>

                        <div class="mt-auto">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-olive-700">{{ number_format($producto->precio, 2, ',', '.') }} &euro;</span>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('productos.show', $producto) }}" class="flex-1 text-center bg-stone-100 hover:bg-stone-200 text-stone-700 font-medium py-2 px-4 rounded-lg transition duration-200 text-sm">
                                    Ver detalle
                                </a>
                                @if($producto->disponible)
                                    <form action="{{ route('cart.add', $producto) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="cantidad" value="1">
                                        <button type="submit" class="w-full bg-olive-700 hover:bg-olive-800 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-sm">
                                            Anadir al carrito
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="flex-1 bg-stone-300 text-stone-500 font-medium py-2 px-4 rounded-lg text-sm cursor-not-allowed">
                                        No disponible
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <svg class="w-16 h-16 text-stone-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <h3 class="text-xl font-semibold text-stone-500 mb-2">No hay productos disponibles</h3>
                    <p class="text-stone-400">Vuelve a visitarnos proximamente.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-public-layout>
