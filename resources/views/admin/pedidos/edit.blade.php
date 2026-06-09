<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Estado - Pedido #{{ $pedido->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-6 p-4 bg-gray-50 rounded-md">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Informacion del pedido</h3>
                        <p class="text-sm text-gray-600"><strong>Cliente:</strong> {{ $pedido->nombre_cliente }}</p>
                        <p class="text-sm text-gray-600"><strong>Fecha:</strong> {{ $pedido->fecha_pedido->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-600"><strong>Total:</strong> {{ number_format($pedido->precio_pedido, 2) }} &euro;</p>
                    </div>

                    <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <x-input-label for="estado" value="Estado del Pedido" />
                            <select id="estado" name="estado" required
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="iniciado" {{ old('estado', $pedido->estado) === 'iniciado' ? 'selected' : '' }}>Iniciado</option>
                                <option value="en proceso" {{ old('estado', $pedido->estado) === 'en proceso' ? 'selected' : '' }}>En proceso</option>
                                <option value="reparto" {{ old('estado', $pedido->estado) === 'reparto' ? 'selected' : '' }}>Reparto</option>
                                <option value="finalizado" {{ old('estado', $pedido->estado) === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Actualizar Estado</x-primary-button>
                            <a href="{{ route('admin.pedidos.show', $pedido) }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
