<x-public-layout>
    <x-slot name="title">Casa Rural</x-slot>

    <section class="relative">
        <div class="w-full h-[400px] overflow-hidden">
            <img src="{{ asset('images/fachada.jpg') }}" alt="Casa Rural AGRIVALL" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/20"></div>
            <div class="absolute inset-0 flex items-end">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pb-12">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">Nuestra Casa Rural</h1>
                    <p class="text-xl text-stone-200 max-w-2xl">Un rincon de tranquilidad en el campo valenciano</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-stone-800 mb-6">Un alojamiento con encanto</h2>
                    <p class="text-stone-600 leading-relaxed mb-4">
                        Nuestra casa rural, situada en un entorno privilegiado del campo valenciano, ofrece una experiencia unica de agroturismo. Rodeada de olivos centenarios, almendros y campos de cultivo, es el lugar perfecto para desconectar de la rutina y disfrutar de la naturaleza.
                    </p>
                    <p class="text-stone-600 leading-relaxed mb-4">
                        La casa ha sido restaurada respetando la arquitectura tradicional valenciana, combinando el encanto rustico con todas las comodidades modernas. Disfruta de amplios espacios, vistas espectaculares y la paz del campo.
                    </p>
                    <p class="text-stone-600 leading-relaxed mb-6">
                        Durante tu estancia podras participar en actividades de agroturismo: recoleccion de aceitunas, catas de aceite, paseos por la finca y mucho mas.
                    </p>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-olive-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-olive-700">4</div>
                            <div class="text-sm text-stone-600">Habitaciones</div>
                        </div>
                        <div class="bg-olive-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-olive-700">8</div>
                            <div class="text-sm text-stone-600">Personas max.</div>
                        </div>
                        <div class="bg-olive-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-olive-700">2</div>
                            <div class="text-sm text-stone-600">Banos</div>
                        </div>
                        <div class="bg-olive-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-olive-700">200m&sup2;</div>
                            <div class="text-sm text-stone-600">Superficie</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <img src="{{ asset('images/103092004.jpg') }}" alt="Interior casa rural" class="rounded-lg shadow-md object-cover h-48 w-full">
                    <img src="{{ asset('images/103092086.jpg') }}" alt="Interior casa rural" class="rounded-lg shadow-md object-cover h-48 w-full">
                    <img src="{{ asset('images/198915550.jpg') }}" alt="Exterior casa rural" class="rounded-lg shadow-md object-cover h-48 w-full">
                    <img src="{{ asset('images/367231749.jpg') }}" alt="Alrededores" class="rounded-lg shadow-md object-cover h-48 w-full">
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-stone-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-stone-800 mb-10 text-center">Servicios y comodidades</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-stone-100 text-center">
                    <svg class="w-10 h-10 text-olive-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <h3 class="font-semibold text-stone-800 mb-1">Cocina completa</h3>
                    <p class="text-sm text-stone-500">Equipada con todo lo necesario</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-stone-100 text-center">
                    <svg class="w-10 h-10 text-olive-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                    </svg>
                    <h3 class="font-semibold text-stone-800 mb-1">WiFi gratis</h3>
                    <p class="text-sm text-stone-500">Conexion a internet en toda la casa</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-stone-100 text-center">
                    <svg class="w-10 h-10 text-olive-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <h3 class="font-semibold text-stone-800 mb-1">Piscina</h3>
                    <p class="text-sm text-stone-500">Piscina privada en temporada</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-stone-100 text-center">
                    <svg class="w-10 h-10 text-olive-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3 class="font-semibold text-stone-800 mb-1">Aparcamiento</h3>
                    <p class="text-sm text-stone-500">Parking gratuito en la finca</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-stone-800 mb-4">Disponibilidad semanal</h2>
                <p class="text-stone-600">Consulta las semanas disponibles y sus precios. Las reservas son semanales.</p>
                <div class="flex items-center justify-center gap-6 mt-4">
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-4 h-4 rounded bg-olive-500"></span>
                        <span class="text-sm text-stone-600">Disponible</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-4 h-4 rounded bg-red-500"></span>
                        <span class="text-sm text-stone-600">Reservada</span>
                    </div>
                </div>
            </div>

            @if($semanas->count() > 0)
                @php
                    $semanasPorAnyo = $semanas->groupBy('anyo');
                @endphp

                @foreach($semanasPorAnyo as $anyo => $semanasAnyo)
                    <div class="mb-10">
                        <h3 class="text-2xl font-bold text-stone-700 mb-4">{{ $anyo }}</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse bg-white rounded-xl shadow-sm border border-stone-200">
                                <thead>
                                    <tr class="bg-stone-50">
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-stone-600 border-b">Semana</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-stone-600 border-b">Descripcion</th>
                                        <th class="px-4 py-3 text-right text-sm font-semibold text-stone-600 border-b">Precio</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-stone-600 border-b">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($semanasAnyo as $semana)
                                        <tr class="hover:bg-stone-50 transition {{ $semana->estado === 'disponible' ? '' : 'opacity-75' }}">
                                            <td class="px-4 py-3 border-b border-stone-100">
                                                <span class="font-medium text-stone-800">Semana {{ $semana->numero_sem }}</span>
                                            </td>
                                            <td class="px-4 py-3 border-b border-stone-100 text-stone-600">
                                                {{ $semana->descriptor ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 border-b border-stone-100 text-right">
                                                <span class="font-semibold text-stone-800">{{ number_format($semana->precio, 2, ',', '.') }} &euro;</span>
                                            </td>
                                            <td class="px-4 py-3 border-b border-stone-100 text-center">
                                                @if($semana->estado === 'disponible')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-olive-100 text-olive-800">
                                                        <span class="w-2 h-2 rounded-full bg-olive-500 mr-1.5"></span>
                                                        Disponible
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <span class="w-2 h-2 rounded-full bg-red-500 mr-1.5"></span>
                                                        Reservada
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-stone-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-stone-500 mb-2">No hay semanas registradas</h3>
                    <p class="text-stone-400">Proximamente publicaremos la disponibilidad.</p>
                </div>
            @endif

            <div class="mt-12 bg-olive-50 rounded-xl p-8 text-center border border-olive-100">
                <h3 class="text-xl font-bold text-stone-800 mb-2">Quieres reservar?</h3>
                <p class="text-stone-600 mb-4">Contacta con nosotros para hacer tu reserva o resolver cualquier duda.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="mailto:info@agrivall.com" class="inline-block bg-olive-700 hover:bg-olive-800 text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                        Contactar por email
                    </a>
                    <a href="tel:+34612345678" class="inline-block border-2 border-olive-700 text-olive-700 hover:bg-olive-700 hover:text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                        Llamar: +34 612 345 678
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
