<x-public-layout>
    <x-slot name="title">Blog</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-stone-800 mb-4">Blog de AGRIVALL</h1>
            <p class="text-lg text-stone-600 max-w-2xl mx-auto">Noticias, recetas, consejos y todo sobre la vida rural en el campo valenciano.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-stone-100 flex flex-col">
                    @if($post->imagen)
                        <img src="{{ asset('images/' . $post->imagen) }}" alt="{{ $post->titulo }}" class="w-full h-52 object-cover">
                    @else
                        <div class="w-full h-52 bg-gradient-to-br from-earth-100 to-earth-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-earth-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    @endif

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-3">
                            @if($post->tipoPost)
                                <span class="inline-block bg-olive-100 text-olive-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $post->tipoPost->tipo }}
                                </span>
                            @endif
                            <span class="text-xs text-stone-400">
                                {{ $post->fecha_public->format('d M Y') }}
                            </span>
                        </div>

                        <h2 class="text-xl font-semibold text-stone-800 mb-3">{{ $post->titulo }}</h2>

                        <p class="text-stone-600 text-sm mb-4 flex-grow line-clamp-4">
                            {{ Str::limit(strip_tags($post->noticia), 180) }}
                        </p>

                        <a href="{{ route('blog.show', $post) }}" class="inline-flex items-center text-olive-700 hover:text-olive-800 font-medium text-sm mt-auto">
                            Leer mas
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-16">
                    <svg class="w-16 h-16 text-stone-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-stone-500 mb-2">No hay publicaciones todavia</h3>
                    <p class="text-stone-400">Vuelve a visitarnos proximamente para leer nuestros articulos.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-public-layout>
