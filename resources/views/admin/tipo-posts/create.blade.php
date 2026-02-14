<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Tipo de Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('admin.tipo-posts.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="tipo" value="Tipo" />
                            <x-text-input id="tipo" name="tipo" type="text" class="mt-1 block w-full"
                                          :value="old('tipo')" required />
                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Crear Tipo</x-primary-button>
                            <a href="{{ route('admin.tipo-posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
