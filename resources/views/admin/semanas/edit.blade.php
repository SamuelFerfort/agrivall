<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Semana: {{ $semana->anyo }} - Semana {{ $semana->numero_sem }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('admin.semanas.update', $semana) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="anyo" value="Anyo" />
                            <x-text-input id="anyo" name="anyo" type="number" min="2000" max="2100"
                                          class="mt-1 block w-full" :value="old('anyo', $semana->anyo)" required />
                            <x-input-error :messages="$errors->get('anyo')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="numero_sem" value="Numero de Semana" />
                            <x-text-input id="numero_sem" name="numero_sem" type="number" min="1" max="53"
                                          class="mt-1 block w-full" :value="old('numero_sem', $semana->numero_sem)" required />
                            <x-input-error :messages="$errors->get('numero_sem')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="descriptor" value="Descriptor" />
                            <x-text-input id="descriptor" name="descriptor" type="text" class="mt-1 block w-full"
                                          :value="old('descriptor', $semana->descriptor)" required />
                            <x-input-error :messages="$errors->get('descriptor')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="precio" value="Precio" />
                            <x-text-input id="precio" name="precio" type="number" step="0.01" min="0"
                                          class="mt-1 block w-full" :value="old('precio', $semana->precio)" required />
                            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="estado" value="Estado" />
                            <select id="estado" name="estado" required
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Seleccionar estado --</option>
                                <option value="disponible" {{ old('estado', $semana->estado) === 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="pre-reserva" {{ old('estado', $semana->estado) === 'pre-reserva' ? 'selected' : '' }}>Pre-reserva</option>
                                <option value="reservado" {{ old('estado', $semana->estado) === 'reservado' ? 'selected' : '' }}>Reservado</option>
                                <option value="no disponible" {{ old('estado', $semana->estado) === 'no disponible' ? 'selected' : '' }}>No disponible</option>
                            </select>
                            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Actualizar Semana</x-primary-button>
                            <a href="{{ route('admin.semanas.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
