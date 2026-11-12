<x-layouts.app>
    <div class="max-w-2xl mx-auto py-12 md:py-16 px-4">

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

            <!-- Encabezado -->
            <div class="bg-orange-600 px-6 py-6 text-center">

                <div
                    class="w-16 h-16 bg-white/20 text-white rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h2 class="text-2xl md:text-3xl font-bold text-white">
                    ¡Registro Exitoso!
                </h2>

                <p class="text-orange-100 text-base mt-2">
                    XII Congreso Seccional Extraordinario de la Sección 56 del SNTE
                </p>

            </div>

            <!-- Contenido -->
            <div class="p-6 md:p-8 space-y-6">

                <!-- Mensaje de éxito -->
                <div class="text-center">
                    <p class="text-gray-800 text-lg md:text-xl font-medium">
                        Tus datos han sido recibidos correctamente.
                    </p>
                    <p class="text-base text-gray-600 mt-2">
                        Tu registro como <strong>Presunto Delegado</strong> ha sido generado satisfactoriamente.
                    </p>
                </div>

                <!-- Folio de registro -->
                <div class="bg-orange-50 border border-orange-200 rounded-xl p-6 text-center">

                    <div class="flex items-center justify-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        <span class="text-base font-bold uppercase tracking-widest text-orange-700">
                            Folio de Registro
                        </span>
                    </div>

                    <p class="text-3xl md:text-4xl font-mono font-extrabold text-orange-600 tracking-wider">
                        {{ $delegado->folio }}
                    </p>

                    <p class="text-base text-orange-700 mt-3">
                        Identificador único de tu registro
                    </p>

                </div>

                <!-- Datos del participante -->
                <div class="border border-gray-200 rounded-xl overflow-hidden">

                    <!-- Título -->
                    <div class="bg-orange-50 px-5 py-4 border-b border-orange-100">
                        <h3 class="text-base font-bold text-orange-700 uppercase tracking-wide flex items-center gap-2">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>

                            Información del participante
                        </h3>
                    </div>

                    <!-- Información -->
                    <div class="p-5 space-y-5">

                        <div>
                            <p class="text-base text-gray-500 mb-2">Nombre completo</p>
                            <p class="text-base md:text-lg font-bold text-gray-800 uppercase">
                                {{ $delegado->nombre_completo }}
                            </p>
                        </div>

                        <div class="border-t border-orange-100"></div>

                        <div>
                            <p class="text-base text-gray-500 mb-2">Delegación / Centro de Trabajo</p>
                            <p class="text-base md:text-lg font-semibold text-gray-800 uppercase">
                                {{ $delegado->delegacion->delegacion }}
                            </p>
                        </div>

                        <div>
                            <p class="text-base text-gray-500 mb-2">Región</p>
                            <p class="text-base md:text-lg font-semibold text-gray-800 uppercase">
                                {{ $delegado->delegacion->region->nombre }}
                            </p>
                        </div>

                        <div class="border-t border-orange-100"></div>

                        <!-- Estatus -->
                        <div class="space-y-3">

                            <div>
                                <p class="text-base text-gray-500 mb-1">
                                    Estatus actual del registro
                                </p>
                            </div>

                            <div
                                class="w-full flex items-center justify-center gap-3 px-5 py-4 rounded-xl bg-orange-100 border border-orange-200 text-orange-700">
                                <span class="w-3 h-3 rounded-full bg-orange-500 flex-shrink-0"></span>

                                <span class="text-base md:text-lg font-bold uppercase text-center">
                                    {{ $delegado->estatus_label }}
                                </span>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- Aviso importante -->
                <div class="bg-orange-50 border border-orange-200 border-l-4 border-l-orange-500 rounded-xl p-4">

                    <div class="flex gap-3">

                        <svg class="w-5 h-5 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                        </svg>

                        <div>
                            <p class="text-base font-bold text-orange-900">
                                ¡Importante!
                            </p>

                            <p class="text-base text-orange-800 mt-1">
                                Conserva tu folio de registro como comprobante de tu pre-registro. Te recomendamos
                                guardarlo para futuras consultas.
                            </p>
                        </div>

                    </div>

                </div>

<!-- Acciones -->
<div class="flex flex-col sm:flex-row justify-center gap-3 pt-5 border-t border-gray-100">

    <a href="{{ route('registro.index') }}"
        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-base font-semibold hover:bg-gray-50 transition">

        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 10l9-7 9 7v10a1 1 0 01-1 1h-5v-7h-6v7H4a1 1 0 01-1-1V10z"/>
        </svg>

        Inicio
    </a>

    <a href="{{ route('registro.index') }}"
        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-orange-600 hover:bg-orange-700 text-white text-base font-bold shadow-sm transition">

        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4"/>
        </svg>

        Nuevo registro
    </a>

</div>

            </div>
        </div>

    </div>
</x-layouts.app>