<div class="max-w-5xl mx-auto w-full px-4">
    @if (session('ok'))
        <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-800 px-4 py-3">
            {{ session('ok') }}
        </div>
    @endif

    <form wire:submit="guardar" class="flex flex-col gap-5">

        {{-- Región y Delegación --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col gap-1">
                <label for="region_id" class="text-sm font-semibold text-gray-700">Región</label>
                <select id="region_id" wire:model.live="region_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition">
                    <option value="">Seleccione una región</option>
                    @foreach ($regiones as $region)
                        <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                    @endforeach
                </select>
                @error('region_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="delegacion_id" class="text-sm font-semibold text-gray-700">Delegación</label>
                <select id="delegacion_id" wire:model="delegacion_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition">
                    <option value="">Seleccione una delegación</option>
                    @foreach ($delegaciones as $delegacion)
                        <option value="{{ $delegacion->id }}">{{ $delegacion->delegacion_completa }}</option>
                    @endforeach
                </select>
                @error('delegacion_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Nombre y apellidos --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex flex-col gap-1">
                <label for="nombres" class="text-sm font-semibold text-gray-700">Nombre(s)</label>
                <input id="nombres" type="text" wire:model="nombres" placeholder="Ingresa tu nombre"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                @error('nombres')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="apellido_paterno" class="text-sm font-semibold text-gray-700">Apellido paterno</label>
                <input id="apellido_paterno" type="text" wire:model="apellido_paterno" placeholder="Apellido paterno"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                @error('apellido_paterno')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="apellido_materno" class="text-sm font-semibold text-gray-700">Apellido materno</label>
                <input id="apellido_materno" type="text" wire:model="apellido_materno" placeholder="Apellido materno"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                @error('apellido_materno')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Género y RFC --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col gap-1">
                <label for="genero" class="text-sm font-semibold text-gray-700">Género</label>
                <select id="genero" wire:model="genero"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition">
                    <option value="">Selecciona tu género</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                    <option value="O">Otro</option>
                </select>
                @error('genero')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="rfc" class="text-sm font-semibold text-gray-700">RFC</label>
                <input id="rfc" type="text" wire:model="rfc" placeholder="RFC"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white uppercase
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                @error('rfc')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Teléfono y correo --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col gap-1">
                <label for="telefono" class="text-sm font-semibold text-gray-700">Teléfono</label>
                <input id="telefono" type="tel" wire:model="telefono" placeholder="Teléfono"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                @error('telefono')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="email" class="text-sm font-semibold text-gray-700">Correo electrónico</label>
                <input id="email" type="email" wire:model="email" placeholder="Correo electrónico"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Botón --}}
        <div class="flex justify-end mb-8">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full md:w-auto bg-[#ff5608] text-white font-medium px-8 py-2 rounded-2xl
                hover:bg-[#ee7a00] transition flex items-center justify-center disabled:opacity-60">
                <span wire:loading.remove>Guardar</span>
                <span wire:loading>Cargando...</span>
            </button>
        </div>

    </form>
</div>