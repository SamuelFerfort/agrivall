<x-public-layout>
    <x-slot name="title">Inicio</x-slot>

    <section class="relative">
        <div class="w-full h-[500px] md:h-[600px] overflow-hidden">
            <img src="{{ asset('images/fachada.jpg') }}" alt="AGRIVALL - Casa Rural Valenciana" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-stone-900/70 to-stone-900/20"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl">
                        <p class="text-earth-300 text-sm uppercase tracking-[0.2em] mb-3 font-medium">Agroturismo valenciano</p>
                        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 tracking-tight">AGRIVALL</h1>
                        <p class="text-lg md:text-xl text-stone-300 mb-8 leading-relaxed">Descubre nuestros productos artesanales, disfruta de nuestra casa rural y conecta con la naturaleza en la Comunitat Valenciana.</p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('productos.index') }}" class="inline-block bg-olive-600 hover:bg-olive-700 text-white font-medium py-3 px-8 rounded-lg transition">
                                Ver Productos
                            </a>
                            <a href="{{ route('casa-rural.index') }}" class="inline-block bg-white/10 hover:bg-white/20 text-white font-medium py-3 px-8 rounded-lg backdrop-blur-sm border border-white/20 transition">
                                Casa Rural
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p class="text-earth-500 text-sm uppercase tracking-[0.15em] mb-2 font-medium">Del campo a tu mesa</p>
                <h2 class="text-3xl md:text-4xl font-bold text-stone-800 mb-4">Nuestros Productos</h2>
                <p class="text-stone-500 max-w-2xl mx-auto">Aceite de oliva virgen extra, miel de azahar, almendras y mas. Elaborados con tradicion y cuidado en el campo valenciano.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($productos as $producto)
                    <div class="group bg-white rounded-xl overflow-hidden border border-stone-200 hover:border-olive-300 hover:shadow-md transition-all duration-300">
                        @if($producto->imagen)
                            <img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-olive-50 to-earth-50 flex items-center justify-center">
                                <svg class="w-14 h-14 text-olive-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-semibold text-stone-800 mb-1">{{ $producto->nombre }}</h3>
                            @if($producto->variedad)
                                <p class="text-sm text-stone-400 mb-1">{{ $producto->variedad }}</p>
                            @endif
                            <p class="text-sm text-stone-400 mb-3">{{ $producto->formato }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-olive-700">{{ number_format($producto->precio, 2, ',', '.') }} &euro;</span>
                                <a href="{{ route('productos.show', $producto) }}" class="text-sm text-earth-600 hover:text-earth-700 font-medium transition">Ver &rarr;</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 text-stone-400">
                        <p>Proximamente dispondremos de productos.</p>
                    </div>
                @endforelse
            </div>

            @if($productos->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('productos.index') }}" class="inline-block bg-olive-600 hover:bg-olive-700 text-white font-medium py-3 px-8 rounded-lg transition">
                        Ver todos los productos
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section class="py-20 bg-stone-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-earth-500 text-sm uppercase tracking-[0.15em] mb-2 font-medium">Turismo rural</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-stone-800 mb-6">Nuestra Casa Rural</h2>
                    <p class="text-stone-600 mb-4 leading-relaxed">
                        Disfruta de una estancia inolvidable en nuestra casa rural, ubicada en un entorno privilegiado del campo valenciano. Rodeada de olivos, almendros y naturaleza en estado puro.
                    </p>
                    <p class="text-stone-500 mb-8 leading-relaxed">
                        Arquitectura tradicional valenciana con todas las comodidades modernas. El lugar perfecto para desconectar y disfrutar de la tranquilidad del campo.
                    </p>
                    <ul class="space-y-3 text-stone-600 mb-8">
                        <li class="flex items-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-olive-500 mr-3 flex-shrink-0"></span>
                            Entorno natural privilegiado
                        </li>
                        <li class="flex items-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-olive-500 mr-3 flex-shrink-0"></span>
                            Actividades de agroturismo
                        </li>
                        <li class="flex items-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-olive-500 mr-3 flex-shrink-0"></span>
                            Degustacion de productos locales
                        </li>
                        <li class="flex items-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-olive-500 mr-3 flex-shrink-0"></span>
                            Rutas senderistas cercanas
                        </li>
                    </ul>
                    <a href="{{ route('casa-rural.index') }}" class="inline-block bg-earth-600 hover:bg-earth-700 text-white font-medium py-3 px-8 rounded-lg transition">
                        Ver disponibilidad
                    </a>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/fachada.jpg') }}" alt="Casa Rural AGRIVALL" class="rounded-2xl shadow-lg w-full h-[400px] object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p class="text-earth-500 text-sm uppercase tracking-[0.15em] mb-2 font-medium">Novedades</p>
                <h2 class="text-3xl md:text-4xl font-bold text-stone-800 mb-4">Nuestro Blog</h2>
                <p class="text-stone-500 max-w-2xl mx-auto">Noticias, recetas y consejos del mundo rural valenciano.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <article class="group bg-white rounded-xl overflow-hidden border border-stone-200 hover:border-olive-300 hover:shadow-md transition-all duration-300">
                        @if($post->imagen)
                            <img src="{{ asset('images/' . $post->imagen) }}" alt="{{ $post->titulo }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-earth-50 to-olive-50 flex items-center justify-center">
                                <svg class="w-14 h-14 text-earth-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-5">
                            <div class="flex items-center gap-3 mb-3">
                                @if($post->tipoPost)
                                    <span class="inline-block bg-olive-100 text-olive-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        {{ $post->tipoPost->tipo }}
                                    </span>
                                @endif
                                <span class="text-xs text-stone-400">{{ $post->fecha_public->format('d/m/Y') }}</span>
                            </div>
                            <h3 class="font-semibold text-stone-800 mb-2">{{ $post->titulo }}</h3>
                            <p class="text-stone-500 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($post->noticia), 120) }}</p>
                            <a href="{{ route('blog.show', $post) }}" class="text-sm text-earth-600 hover:text-earth-700 font-medium transition">Leer mas &rarr;</a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-8 text-stone-400">
                        <p>Proximamente publicaremos articulos en nuestro blog.</p>
                    </div>
                @endforelse
            </div>

            @if($posts->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('blog.index') }}" class="inline-block border-2 border-olive-600 text-olive-700 hover:bg-olive-600 hover:text-white font-medium py-3 px-8 rounded-lg transition">
                        Ver todas las publicaciones
                    </a>
                </div>
            @endif
        </div>
    </section>
</x-public-layout>
