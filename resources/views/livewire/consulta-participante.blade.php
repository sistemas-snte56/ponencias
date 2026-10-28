<div class="max-w-4xl mx-auto w-full px-4 py-8">
    <div class="bg-white shadow-sm border border-gray-200 rounded-2xl p-6 md:p-8">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Consulta de Ponencia Registrada</h2>
            <p class="text-sm text-gray-600 mt-1">Ingresa tu número de personal para consultar los detalles de tu registro en el XII Congreso.</p>
        </div>

        {{-- Formulario de Búsqueda --}}
        <form wire:submit.prevent="buscarParticipante" class="flex flex-col md:flex-row gap-3 justify-center items-start mb-8">
            <div class="w-full md:w-96 flex flex-col gap-1">
                <input type="text" wire:model="numero_personal" placeholder="Ingresa tu número de personal"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                @error('numero_personal') 
                    <span class="text-red-600 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="bg-[#ff5608] text-white font-medium px-6 py-2 rounded-lg hover:bg-[#ee7a00] transition flex items-center justify-center">
                <span wire:loading.remove>Consultar</span>
                <span wire:loading>Buscando...</span>
            </button>
        </form>

        {{-- Resultados de la Búsqueda --}}
        @if ($busqueda_realizada)
            @if ($participante)
                <div class="border border-green-200 bg-green-50 rounded-xl p-6 space-y-4">
                    <div class="flex items-center justify-between border-b border-green-200 pb-3">
                        <div>
                            <span class="text-xs uppercase tracking-wider text-green-700 font-semibold">Estado: Registrado</span>
                            <h3 class="text-xl font-bold text-gray-800">{{ $participante->nombre_completo }}</h3>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-500 block">Folio Asignado:</span>
                            <span class="text-lg font-black text-[#ee7a00]">{{ $participante->folio }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                        <div>
                            <span class="font-semibold block text-gray-900">Delegación:</span>
                            {{ $participante->delegacion->delegacion_completa ?? 'N/A' }}
                        </div>
                        <div>
                            <span class="font-semibold block text-gray-900">Nivel Educativo:</span>
                            {{ $participante->nivel_educativo }}
                        </div>
                        <div class="md:col-span-2">
                            <span class="font-semibold block text-gray-900">Eje Temático:</span>
                            {{ $participante->tema }}
                        </div>
                        <div class="md:col-span-2">
                            <span class="font-semibold block text-gray-900">Título de la Ponencia:</span>
                            <p class="text-gray-800 font-medium bg-white p-3 rounded-lg border border-gray-200 mt-1">{{ $participante->titulo_ponencia }}</p>
                        </div>
                    </div>

                    {{-- Indicador de archivos adjuntos --}}
                    <div class="pt-4 border-t border-green-200 flex flex-wrap gap-4 items-center justify-between">
                        <div class="text-xs text-gray-600">
                            Registro guardado el: {{ $participante->created_at->format('d/m/Y H:i') }}
                        </div>
                        @if($participante->ponencia_pdf_path)
                            <a href="{{ asset('storage/' . $participante->ponencia_pdf_path) }}" target="_blank"
                                class="inline-flex items-center gap-1 text-sm bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                                Ver PDF adjunto
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <div class="border border-red-200 bg-red-50 rounded-xl p-6 text-center text-red-700">
                    <p class="font-semibold">No se encontró ninguna ponencia registrada con el número personal proporcionado.</p>
                    <p class="text-sm mt-1">Verifica que esté escrito correctamente o acércate al comité organizador.</p>
                </div>
            @endif
        @endif

    </div>
</div>