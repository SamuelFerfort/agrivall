<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' - ' : '' }}AGRIVALL</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-stone-50 text-stone-800">
        <nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-sm border-b border-stone-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-olive-700">AGRIVALL</a>

                        <div class="hidden sm:flex sm:ml-10 sm:space-x-8">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition {{ request()->routeIs('home') ? 'text-olive-700 border-b-2 border-olive-600' : 'text-stone-500 hover:text-stone-700' }}">
                                Inicio
                            </a>
                            <a href="{{ route('productos.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition {{ request()->routeIs('productos.*') ? 'text-olive-700 border-b-2 border-olive-600' : 'text-stone-500 hover:text-stone-700' }}">
                                Productos
                            </a>
                            <a href="{{ route('casa-rural.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition {{ request()->routeIs('casa-rural.*') ? 'text-olive-700 border-b-2 border-olive-600' : 'text-stone-500 hover:text-stone-700' }}">
                                Casa Rural
                            </a>
                            <a href="{{ route('blog.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition {{ request()->routeIs('blog.*') ? 'text-olive-700 border-b-2 border-olive-600' : 'text-stone-500 hover:text-stone-700' }}">
                                Blog
                            </a>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:space-x-4">
                        <a href="{{ route('cart.index') }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-stone-500 hover:text-stone-700 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            <span class="js-cart-count absolute -top-1 -right-1 bg-earth-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center {{ (session('cart') && count(session('cart')) > 0) ? '' : 'hidden' }}">{{ count(session('cart', [])) }}</span>
                        </a>

                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-olive-700 hover:text-olive-800 transition">Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-stone-500 hover:text-stone-700 transition">Iniciar Sesion</a>
                        @endauth
                    </div>

                    <div class="flex items-center sm:hidden">
                        <a href="{{ route('cart.index') }}" class="relative mr-4 text-stone-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            <span class="js-cart-count absolute -top-1 -right-1 bg-earth-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center {{ (session('cart') && count(session('cart')) > 0) ? '' : 'hidden' }}">{{ count(session('cart', [])) }}</span>
                        </a>
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-stone-400 hover:text-stone-500 hover:bg-stone-100">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-stone-100">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-stone-600 hover:bg-stone-50">Inicio</a>
                    <a href="{{ route('productos.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-stone-600 hover:bg-stone-50">Productos</a>
                    <a href="{{ route('casa-rural.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-stone-600 hover:bg-stone-50">Casa Rural</a>
                    <a href="{{ route('blog.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-stone-600 hover:bg-stone-50">Blog</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-olive-700 hover:bg-stone-50">Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-stone-600 hover:bg-stone-50">Iniciar Sesion</a>
                    @endauth
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>

        <footer class="bg-stone-800 text-stone-300 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4">AGRIVALL</h3>
                        <p class="text-stone-400 text-sm leading-relaxed">Productos artesanales del campo valenciano. Aceite de oliva, miel, almendras y mucho mas, directos del productor a tu mesa.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4">Enlaces</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('productos.index') }}" class="text-stone-400 hover:text-white transition">Productos</a></li>
                            <li><a href="{{ route('casa-rural.index') }}" class="text-stone-400 hover:text-white transition">Casa Rural</a></li>
                            <li><a href="{{ route('blog.index') }}" class="text-stone-400 hover:text-white transition">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4">Contacto</h3>
                        <ul class="space-y-2 text-sm text-stone-400">
                            <li>Camino de la Finca s/n</li>
                            <li>46001 Valencia</li>
                            <li>info@agrivall.com</li>
                            <li>+34 612 345 678</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-stone-700 mt-8 pt-8 text-center text-sm text-stone-500">
                    &copy; {{ date('Y') }} AGRIVALL. Todos los derechos reservados.
                </div>
            </div>
        </footer>

        @include('partials.sweetalert')
        <script>
            @if(session('success'))
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: @json(session('success')), showConfirmButton: false, timer: 3500, timerProgressBar: true });
            @endif
            @if(session('error'))
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: @json(session('error')), showConfirmButton: false, timer: 4500, timerProgressBar: true });
            @endif
        </script>

        <script>
        (function () {
            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrf = tokenMeta ? tokenMeta.getAttribute('content') : '';
            const fmt = (n) => new Intl.NumberFormat('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(n) + ' €';

            function toast(message, icon) {
                if (window.Swal) {
                    Swal.fire({ toast: true, position: 'top-end', icon: icon || 'success', title: message, showConfirmButton: false, timer: 2500, timerProgressBar: true });
                }
            }

            function setCartCount(count) {
                document.querySelectorAll('.js-cart-count').forEach((el) => {
                    el.textContent = count;
                    el.classList.toggle('hidden', !count || count <= 0);
                });
            }

            async function cartRequest(url, method, payload) {
                const opts = {
                    method: method,
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                };
                if (payload) {
                    opts.headers['Content-Type'] = 'application/json';
                    opts.body = JSON.stringify(payload);
                }
                const res = await fetch(url, opts);
                if (!res.ok) throw new Error('cart request failed');
                return res.json();
            }

            // Anadir al carrito (catalogo y detalle) sin recargar
            document.querySelectorAll('form[data-cart-add]').forEach((form) => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const btn = form.querySelector('button[type="submit"]');
                    if (btn) btn.disabled = true;
                    try {
                        const qtyEl = form.querySelector('[name="cantidad"]');
                        const data = await cartRequest(form.action, 'POST', { cantidad: parseInt(qtyEl ? qtyEl.value : 1) || 1 });
                        setCartCount(data.count);
                        toast(data.message || 'Producto anadido al carrito');
                    } catch (err) {
                        form.submit();
                    } finally {
                        if (btn) btn.disabled = false;
                    }
                });
            });

            // Cambiar cantidad en el carrito sin recargar
            document.querySelectorAll('input[data-cart-qty]').forEach((input) => {
                input.addEventListener('change', async () => {
                    let val = parseInt(input.value) || 1;
                    if (val < 1) val = 1;
                    input.value = val;
                    try {
                        const data = await cartRequest(input.dataset.updateUrl, 'PATCH', { cantidad: val });
                        document.querySelectorAll('[data-subtotal="' + input.dataset.id + '"]').forEach((el) => { el.textContent = fmt(data.subtotal); });
                        document.querySelectorAll('[data-cart-total]').forEach((el) => { el.textContent = fmt(data.total); });
                        setCartCount(data.count);
                    } catch (err) {
                        window.location.reload();
                    }
                });
            });

            // Eliminar del carrito sin recargar
            document.querySelectorAll('[data-cart-remove]').forEach((btn) => {
                btn.addEventListener('click', async () => {
                    try {
                        const data = await cartRequest(btn.dataset.removeUrl, 'DELETE', null);
                        document.querySelectorAll('[data-cart-row="' + btn.dataset.id + '"]').forEach((row) => row.remove());
                        document.querySelectorAll('[data-cart-total]').forEach((el) => { el.textContent = fmt(data.total); });
                        setCartCount(data.count);
                        if (data.empty) window.location.reload();
                    } catch (err) {
                        window.location.reload();
                    }
                });
            });
        })();
        </script>
    </body>
</html>
