<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Semanas Casilla
            </h2>
            <a href="{{ route('admin.semanas.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                Nueva Semana
            </a>
        </div>
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
                    @if ($semanas->isEmpty())
                        <p class="text-gray-500">No hay semanas registradas.</p>
                    @else
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Anyo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Semana</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Descriptor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Precio</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($semanas as $semana)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ $semana->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ $semana->anyo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ $semana->numero_sem }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $semana->descriptor }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b">{{ number_format($semana->precio, 2) }} &euro;</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm border-b">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                {{ $semana->estado === 'disponible' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($semana->estado) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm border-b">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.semanas.edit', $semana) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-indigo-600 text-white text-xs font-semibold rounded hover:bg-indigo-500 transition">
                                                    Editar
                                                </a>
                                                <form action="{{ route('admin.semanas.destroy', $semana) }}" method="POST"
                                                      onsubmit="return confirm('Seguro que quieres eliminar esta semana?')">
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
