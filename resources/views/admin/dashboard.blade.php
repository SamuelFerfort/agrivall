<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Administracion - AGRIVALL
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('admin.productos.index') }}" class="block">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Productos</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalProductos }}</div>
                    </div>
                </a>

                <a href="{{ route('admin.pedidos.index') }}" class="block">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Pedidos</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalPedidos }}</div>
                    </div>
                </a>

                <a href="{{ route('admin.posts.index') }}" class="block">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Posts del Blog</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalPosts }}</div>
                    </div>
                </a>

                <a href="{{ route('admin.semanas.index') }}" class="block">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Semanas Casilla</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalSemanas }}</div>
                    </div>
                </a>
            </div>

            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Acciones rapidas</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.productos.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                        Nuevo Producto
                    </a>
                    <a href="{{ route('admin.posts.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                        Nuevo Post
                    </a>
                    <a href="{{ route('admin.semanas.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                        Nueva Semana
                    </a>
                    <a href="{{ route('admin.tipo-posts.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                        Tipos de Post
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
