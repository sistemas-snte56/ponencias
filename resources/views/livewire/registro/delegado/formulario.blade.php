<div class="max-w-5xl mx-auto w-full py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <!-- Encabezado -->
        <div class="bg-orange-600 px-6 py-5 text-white">
            <h1 class="text-2xl font-bold">Registro de Presuntos Delegados</h1>
            <p class="text-orange-100 text-sm mt-1">Congreso Seccional Extraordinario - SNTE</p>
        </div>



        @if (! $isConfirming)
            <form wire:submit="reviewData" class="p-6 space-y-6">
                <!-- Región y Delegación -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="region_id" class="block text-normal font-semibold text-gray-700">Región</label>
                        <select id="region_id" wire:model.live="region_id" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 bg-white shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none">
                            <option value="">Seleccione una región</option>
                            @foreach ($regiones as $region)
                                <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                            @endforeach
                        </select>
                        @error('region_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="delegacion_id" class="block text-normal font-semibold text-gray-700">Delegación y/o C.T. de la asamblea</label>
                        <select id="delegacion_id" wire:model="delegacion_id" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 bg-white shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none">
                            <option value="">Seleccione una delegación de la asamblea</option>
                            @foreach ($delegaciones as $delegacion)
                                <option value="{{ $delegacion->id }}">{{ $delegacion->delegacion }}</option>
                            @endforeach
                        </select>
                        @error('delegacion_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Datos Generales -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="nombre" class="block text-normal font-semibold text-gray-700">Nombre</label>
                        <input id="nombre" type="text" wire:model="nombre" placeholder="Ingresa tu nombre" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none uppercase" />
                        @error('nombre') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="apellido_paterno" class="block text-normal font-semibold text-gray-700">Apellido Paterno</label>
                        <input id="apellido_paterno" type="text" wire:model="apellido_paterno" placeholder="Ingresa tu apellido paterno" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none uppercase" />
                        @error('apellido_paterno') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="apellido_materno" class="block text-normal font-semibold text-gray-700">Apellido Materno</label>
                        <input id="apellido_materno" type="text" wire:model="apellido_materno" placeholder="Ingresa tu apellido materno" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none uppercase" />
                        @error('apellido_materno') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="genero" class="block text-normal font-semibold text-gray-700">Género</label>
                        <select id="genero" wire:model="genero" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 bg-white shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none">
                            <option value="">Seleccione un género...</option>
                            <option value="H">HOMBRE</option>
                            <option value="M">MUJER</option>
                            <option value="O">OTRO</option>
                        </select>
                        @error('genero') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="rfc" class="block text-normal font-semibold text-gray-700">RFC (Con Homoclave)</label>
                        <input id="rfc" type="text" maxlength="13" wire:model="rfc" placeholder="Ingresa tu RFC" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none uppercase" />
                        @error('rfc') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="numero_personal" class="block text-normal font-semibold text-gray-700">Número de Personal / Empleado</label>
                        <input id="numero_personal" type="text" wire:model="numero_personal" placeholder="Ingresa tu número de personal" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none" />
                        @error('numero_personal') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="nivel_educativo" class="block text-normal font-semibold text-gray-700">Nivel Educativo</label>
                        <select id="nivel_educativo" wire:model="nivel_educativo" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 bg-white shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none">
                            <option value="">Seleccione un nivel...</option>
                            <option value="PREESCOLAR">PREESCOLAR</option>
                            <option value="EDUCACIÓN ESPECIAL">EDUCACIÓN ESPECIAL</option>
                            <option value="PRIMARIAS">PRIMARIAS</option>
                            <option value="SECUNDARIAS">SECUNDARIAS</option>
                            <option value="PENSIONADOS Y JUBILADOS">PENSIONADOS Y JUBILADOS</option>
                            <option value="EDUCACION FISICA">EDUCACIÓN FÍSICA</option>
                            <option value="NIVELES ESPECIALES">NIVELES ESPECIALES</option>
                            <option value="TELESECUNDARIA">TELESECUNDARIA</option>
                            <option value="PAAE">PAAE</option>
                            <option value="BACHILLERATO">BACHILLERATO</option>
                            <option value="TELEBACHILLERATO">TELEBACHILLERATO</option>
                            <option value="NORMAL">NORMAL</option>
                            <option value="UPV">UPV</option>
                        </select>
                        @error('nivel_educativo') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="telefono" class="block text-normal font-semibold text-gray-700">Teléfono Celular (10 dígitos)</label>
                        <input id="telefono" type="tel" maxlength="10" placeholder="Ej. 2281234567" wire:model="telefono" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none" />
                        @error('telefono') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-normal font-semibold text-gray-700">Correo Electrónico</label>
                        <input id="email" type="email" placeholder="correo@ejemplo.com" wire:model="email" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 shadow-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none" />
                        @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- <div class="md:col-span-2">
                        <label for="fotografia" class="block text-normal font-semibold text-gray-700">Fotografía para Gafete (JPG/PNG, máx 2MB)</label>
                        <input id="fotografia" type="file" wire:model="fotografia" accept="image/png, image/jpeg" class="w-full px-4 py-3 mt-1 block rounded-xl border border-gray-300 bg-white shadow-sm text-sm text-gray-500 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" />
                        @error('fotografia') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror

                        @if ($fotografia)
                            <div class="mt-3">
                                <p class="text-xs text-gray-500 mb-1">Vista previa:</p>
                                <img src="{{ $fotografia->temporaryUrl() }}" class="h-28 w-28 object-cover rounded-xl border border-gray-300 shadow-sm">
                            </div>
                        @endif
                    </div> --}}
                </div>

                <div class="pt-4 border-t border-gray-200 flex justify-end">
                    <button type="submit" wire:loading.attr="disabled" class="bg-orange-600 hover:bg-orange-700 disabled:opacity-50 text-white font-bold py-3 px-6 rounded-xl shadow-sm transition focus:outline-none focus:ring-2 focus:ring-orange-200">
                        <span wire:loading.remove>Completar Registro</span>
                        <span wire:loading>Procesando...</span>
                    </button>
                </div>
            </form>
        @else


<!-- PASO 2: REVISIÓN Y CONFIRMACIÓN -->
<div class="p-6 md:p-8 space-y-6">

    <!-- Encabezado -->
    <div class="border-b border-orange-100 pb-4">
        <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-orange-100 text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.053-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                    Revisión de información
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Verifica que tus datos sean correctos antes de completar tu registro.
                </p>
            </div>
        </div>
    </div>

    <!-- Aviso -->
    <div class="bg-orange-50 border border-orange-200 border-l-4 border-l-orange-500 rounded-xl p-4">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
            </svg>
            <p class="text-sm text-orange-900">
                <strong>Importante:</strong>
                Una vez guardada la información, se emitirá tu registro oficial para el Congreso.
                Te recomendamos revisar cuidadosamente los datos proporcionados.
            </p>
        </div>
    </div>

    <!-- Información del participante -->
    <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">

        <!-- Nombre -->
        <div class="bg-gray-100 px-5 py-5">
            <p class="text-xs font-semibold text-[#9d2449] uppercase tracking-wider mb-1">
                Datos del participante
            </p>
            <h3 class="text-lg md:text-xl font-bold text-[#9d2449] uppercase">
                {{ $nombre }} {{ $apellido_paterno }} {{ $apellido_materno }}
            </h3>
        </div>

        <div class="p-5 md:p-6">

            <!-- Información personal -->
            <h4 class="text-sm font-bold text-orange-700 uppercase tracking-wide mb-5 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Información personal
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-8 gap-y-5">

                <div>
                    <p class="text-xs text-gray-500 mb-1">RFC</p>
                    <p class="text-sm font-semibold text-gray-800">{{ strtoupper($rfc) }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Número de personal</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $numero_personal }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Género</p>
                    <p class="text-sm font-semibold text-gray-800">
                        {{ $genero === 'H' ? 'HOMBRE' : ($genero === 'M' ? 'MUJER' : 'OTRO') }}
                    </p>
                </div>

                <div class="sm:col-span-2 md:col-span-3">
                    <p class="text-xs text-gray-500 mb-1">Nivel educativo</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $nivel_educativo }}</p>
                </div>

            </div>

            <div class="border-t border-orange-100 my-6"></div>

            <!-- Adscripción institucional -->
            <h4 class="text-sm font-bold text-orange-700 uppercase tracking-wide mb-5 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/>
                </svg>
                Adscripción institucional
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">

                <div>
                    <p class="text-xs text-gray-500 mb-1">Región</p>
                    <p class="text-sm font-semibold text-gray-800 uppercase">
                        {{ $region_nombre }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Delegación</p>
                    <p class="text-sm font-semibold text-gray-800 uppercase">
                        {{ $delegacion_nombre }}
                    </p>
                </div>

            </div>

            <div class="border-t border-orange-100 my-6"></div>

            <!-- Información de contacto -->
            <h4 class="text-sm font-bold text-orange-700 uppercase tracking-wide mb-5 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a2 2 0 011.96 1.608l.5 2.5a2 2 0 01-.72 1.95l-1.5 1.2a11 11 0 005.2 5.2l1.2-1.5a2 2 0 011.95-.72l2.5.5A2 2 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                Información de contacto
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">

                <div>
                    <p class="text-xs text-gray-500 mb-1">Teléfono</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $telefono }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Correo electrónico</p>
                    <p class="text-sm font-semibold text-gray-800 break-all">{{ $email }}</p>
                </div>

            </div>

        </div>
    </div>

    <!-- Confirmación -->
    <div class="bg-orange-50 rounded-xl border border-orange-100 p-4">
        <p class="text-sm text-orange-900">
            Al confirmar, manifiestas que la información proporcionada es correcta.
        </p>
    </div>

    <!-- Acciones -->
    <div class="flex flex-col-reverse sm:flex-row justify-between gap-3 pt-4 border-t border-gray-200">

        <button type="button"
            wire:click="editData"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-sm font-semibold hover:bg-gray-50 hover:border-orange-300 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536M4 20l4.5-1 11-11a2.5 2.5 0 00-3.536-3.536l-11 11L4 20z"/>
            </svg>
            Modificar información
        </button>

        <button type="button"
            wire:click="save"
            wire:loading.attr="disabled"
            wire:target="save"
            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-orange-600 hover:bg-orange-700 text-white text-sm font-bold shadow-sm transition disabled:opacity-50">

            <svg wire:loading.remove wire:target="save"
                class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 13l4 4L19 7"/>
            </svg>

            <svg wire:loading wire:target="save"
                class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
            </svg>

            <span wire:loading.remove wire:target="save">
                Confirmar y guardar registro
            </span>

            <span wire:loading wire:target="save">
                Guardando registro...
            </span>
        </button>

    </div>

</div>







        @endif

    </div>
</div>
