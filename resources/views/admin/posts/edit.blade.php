<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Post: {{ Str::limit($post->titulo, 40) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="titulo" value="Titulo" />
                            <x-text-input id="titulo" name="titulo" type="text" class="mt-1 block w-full"
                                          :value="old('titulo', $post->titulo)" required />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tipo_post_id" value="Tipo de Post" />
                            <select id="tipo_post_id" name="tipo_post_id" required
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Seleccionar tipo --</option>
                                @foreach ($tiposPost as $tipo)
                                    <option value="{{ $tipo->id }}" {{ old('tipo_post_id', $post->tipo_post_id) == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->tipo }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tipo_post_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="fecha_public" value="Fecha de Publicacion" />
                            <x-text-input id="fecha_public" name="fecha_public" type="date" class="mt-1 block w-full"
                                          :value="old('fecha_public', $post->fecha_public->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('fecha_public')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="noticia" value="Noticia" />
                            <textarea id="noticia" name="noticia" rows="6" required
                                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('noticia', $post->noticia) }}</textarea>
                            <x-input-error :messages="$errors->get('noticia')" class="mt-2" />
                        </div>

                        @if ($post->imagen)
                            <div class="mb-4">
                                <x-input-label value="Imagen actual" />
                                <img src="{{ asset('images/' . $post->imagen) }}" alt="{{ $post->titulo }}"
                                     class="mt-2 h-32 w-32 object-cover rounded">
                            </div>
                        @endif

                        <div class="mb-6">
                            <x-input-label for="imagen" value="Nueva imagen (dejar vacio para mantener la actual)" />
                            <input id="imagen" name="imagen" type="file" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                            <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Actualizar Post</x-primary-button>
                            <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
