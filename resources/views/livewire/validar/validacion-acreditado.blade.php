<div class="flex items-center justify-center p-3 w-full my-auto">
    
    @if($asamblea)
        <!-- ========================================== -->
        <!-- CASO 1: EL CÓDIGO ES VÁLIDO (TARJETA VERDE) -->
        <!-- ========================================== -->
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl border-t-8 border-[#f18c21] overflow-hidden my-4">
            
            <!-- Estado de la Validación (Grande y con mucho contraste) -->
            <div class="bg-green-100 p-5 text-center border-b border-green-200 flex items-center justify-center gap-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-600 text-white font-black text-2xl shadow-md flex-shrink-0">✓</div>
                <div class="text-left">
                    <h2 class="text-green-900 font-extrabold text-xl uppercase tracking-wide">Documento Válido</h2>
                    <p class="text-sm font-bold text-green-700 mt-0.5">Verificado en la base de datos oficial</p>
                </div>
            </div>

            <!-- Detalles del Acreditado (Texto grande y etiquetas legibles) -->
            <div class="p-6 space-y-5 text-base">
                <div>
                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Código de Acreditación</span>
                    <span class="text-lg font-black text-gray-900 tracking-wider font-mono block bg-gray-50 p-2 rounded-lg border border-gray-200 mt-1">{{ $asamblea->codigo_acreditacion }}</span>
                </div>

                <div class="border-t-2 border-gray-100 pt-4">
                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Presidente(a)</span>
                    <span class="text-lg font-extrabold text-gray-900 uppercase block leading-tight">{{ $asamblea->presidente }}</span>
                    
                    @if($asamblea->copresidente)
                        <span class="block text-xs font-bold text-gray-500 uppercase tracking-widest mt-4 mb-1">Copresidente(a)</span>
                        <span class="text-lg font-extrabold text-gray-900 uppercase block leading-tight">{{ $asamblea->copresidente }}</span>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t-2 border-gray-100 pt-4">
                    <div>
                        <span class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Delegación y C.T.</span>
                        <span class="text-base font-extrabold text-gray-900 block mt-0.5">{{ $asamblea->delegacion_ct }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Región / Tipo</span>
                        <span class="text-base font-extrabold text-gray-900 block mt-0.5">{{ $asamblea->region }}</span>
                    </div>
                </div>

                <div class="border-t-2 border-gray-100 pt-4">
                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Recinto de la Asamblea</span>
                    <span class="text-base font-extrabold text-gray-900 block mt-0.5">{{ $asamblea->recinto }}</span>
                    <p class="text-sm font-semibold text-gray-600 mt-1 leading-relaxed bg-gray-50 p-2 rounded-lg border border-gray-100">{{ $asamblea->domicilio }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t-2 border-gray-100 pt-4 text-sm text-gray-600">
                    <div>
                        <span class="block text-xs font-bold uppercase text-gray-400 tracking-wider">Fecha Asamblea</span>
                        <span class="text-base font-bold text-gray-800 block mt-0.5">{{ $asamblea->fecha_asamblea->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Footer de la tarjeta -->
            <div class="bg-gray-100 px-5 py-3 text-center border-t-2 border-gray-200">
                &nbsp;
            </div>
        </div>
    @else
        <!-- ============================================ -->
        <!-- CASO 2: EL CÓDIGO NO EXISTE (TARJETA ROJA)  -->
        <!-- ============================================ -->
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl border-t-8 border-red-600 overflow-hidden my-4">
            
            <!-- Estado de Error (Grande y con alerta clara) -->
            <div class="bg-red-100 p-5 text-center border-b border-red-200 flex items-center justify-center gap-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-red-600 text-white font-black text-2xl shadow-md flex-shrink-0">✕</div>
                <div class="text-left">
                    <h2 class="text-red-900 font-extrabold text-xl uppercase tracking-wide">Código Inválido</h2>
                    <p class="text-sm font-bold text-red-700 mt-0.5">No se encuentra en los registros</p>
                </div>
            </div>

            <!-- Mensaje de Advertencia Ampliado -->
            <div class="p-6 text-center space-y-4">
                <p class="text-base font-bold text-gray-700 leading-relaxed">
                    Esta acreditación digital no pudo ser validada. Verifique que el código QR sea el correcto o que corresponda al proceso vigente.
                </p>
                <div class="bg-amber-100 rounded-xl p-4 border border-amber-200 text-left">
                    <span class="block text-sm font-black text-amber-950 uppercase tracking-wider mb-1">⚠️ Atención:</span>
                    <p class="text-sm font-bold text-amber-900 leading-relaxed">
                        Si considera que es un error técnico de su registro, comuníquese de inmediato con el administrador del sistema de su delegación sindical.
                    </p>
                </div>
            </div>

            <!-- Footer de Error -->
            <div class="bg-gray-100 px-5 py-3 text-center border-t-2 border-gray-200">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest block">SNTE Sección 56 Veracruz</span>
            </div>
        </div>
    @endif

</div>
