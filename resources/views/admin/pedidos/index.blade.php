<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pedidos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($pedidos->isEmpty())
                        <p class="text-gray-500">No hay pedidos registrados.</p>
                    @else
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Cliente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Telefono</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ $pedido->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">{{ $pedido->fecha_pedido->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ $pedido->nombre_cliente }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">{{ $pedido->email_cliente }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">{{ $pedido->tlf_cliente }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 border-b">{{ number_format($pedido->precio_pedido, 2) }} &euro;</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm border-b">
                                            @php
                                                $estadoColors = [
                                                    'iniciado' => 'bg-yellow-100 text-yellow-800',
                                                    'en proceso' => 'bg-blue-100 text-blue-800',
                                                    'reparto' => 'bg-indigo-100 text-indigo-800',
                                                    'finalizado' => 'bg-green-100 text-green-800',
                                                ];
                                                $color = $estadoColors[$pedido->estado] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                                {{ ucfirst($pedido->estado) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm border-b">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.pedidos.show', $pedido) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-gray-600 text-white text-xs font-semibold rounded hover:bg-gray-500 transition">
                                                    Ver
                                                </a>
                                                <a href="{{ route('admin.pedidos.edit', $pedido) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-indigo-600 text-white text-xs font-semibold rounded hover:bg-indigo-500 transition">
                                                    Estado
                                                </a>
                                                <form action="{{ route('admin.pedidos.destroy', $pedido) }}" method="POST"
                                                      data-confirm="Seguro que quieres eliminar este pedido?">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-500 transition">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
