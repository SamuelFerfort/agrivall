<x-public-layout>
    <x-slot name="title">{{ $post->titulo }}</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-stone-500">
                <li><a href="{{ route('home') }}" class="hover:text-olive-700">Inicio</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('blog.index') }}" class="hover:text-olive-700">Blog</a></li>
                <li><span>/</span></li>
                <li class="text-stone-800 font-medium">{{ Str::limit($post->titulo, 40) }}</li>
            </ol>
        </nav>

        <article class="bg-white rounded-xl shadow-md overflow-hidden border border-stone-100">
            @if($post->imagen)
                <img src="{{ asset('images/' . $post->imagen) }}" alt="{{ $post->titulo }}" class="w-full h-[300px] md:h-[400px] object-cover">
            @endif

            <div class="p-8 md:p-12">
                <div class="flex items-center gap-4 mb-6">
                    @if($post->tipoPost)
                        <span class="inline-block bg-olive-100 text-olive-800 text-sm font-medium px-3 py-1 rounded">
                            {{ $post->tipoPost->tipo }}
                        </span>
                    @endif
                    <span class="text-sm text-stone-400">
                        Publicado el {{ $post->fecha_public->format('d \d\e F \d\e Y') }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-stone-800 mb-8">{{ $post->titulo }}</h1>

                <div class="prose prose-lg max-w-none text-stone-700 leading-relaxed">
                    {!! nl2br(e($post->noticia)) !!}
                </div>
            </div>
        </article>

        <div class="mt-8">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center text-olive-700 hover:text-olive-800 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al blog
            </a>
        </div>
    </div>
</x-public-layout>
