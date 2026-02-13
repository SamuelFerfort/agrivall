<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Producto: {{ $producto->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('admin.productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="nombre" value="Nombre" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full"
                                          :value="old('nombre', $producto->nombre)" required />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="variedad" value="Variedad" />
                            <x-text-input id="variedad" name="variedad" type="text" class="mt-1 block w-full"
                                          :value="old('variedad', $producto->variedad)" />
                            <x-input-error :messages="$errors->get('variedad')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="formato" value="Formato" />
                            <x-text-input id="formato" name="formato" type="text" class="mt-1 block w-full"
                                          :value="old('formato', $producto->formato)" required />
                            <x-input-error :messages="$errors->get('formato')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="precio" value="Precio" />
                            <x-text-input id="precio" name="precio" type="number" step="0.01" min="0"
                                          class="mt-1 block w-full" :value="old('precio', $producto->precio)" required />
                            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                        </div>

                        @if ($producto->imagen)
                            <div class="mb-4">
                                <x-input-label value="Imagen actual" />
                                <img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                                     class="mt-2 h-32 w-32 object-cover rounded">
                            </div>
                        @endif

                        <div class="mb-4">
                            <x-input-label for="imagen" value="Nueva imagen (dejar vacio para mantener la actual)" />
                            <input id="imagen" name="imagen" type="file" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                            <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="disponible" value="1"
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                       {{ old('disponible', $producto->disponible) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Disponible</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Actualizar Producto</x-primary-button>
                            <a href="{{ route('admin.productos.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
