<div class="max-w-5xl mx-auto w-full px-4 py-6">

    {{-- Pantalla de Éxito / Acuse --}}
    @if ($paso === 'exito')
        <div class="bg-white border border-green-200 rounded-2xl p-8 text-center shadow-lg">
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                ✓
            </div>
            <h2 class="text-2xl font-bold text-[#ff5608] mb-2">¡Registro de Ponencia Exitoso!</h2>
            <p class="text-gray-600 mb-6">Tu propuesta ha sido enviada correctamente al sistema del congreso.</p>
            
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 max-w-sm mx-auto mb-6">
                <span class="text-xs text-gray-500 uppercase tracking-wider block">Tu Folio de Registro es:</span>
                <span class="text-2xl font-black text-[#ee7a00]">{{ $folioRegistrado }}</span>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                {{-- Buscamos el UUID del registro recién hecho --}}
                @php
                    $ultimoParticipante = App\Models\Participante::where('folio', $folioRegistrado)->first();
                @endphp

                @if($ultimoParticipante)
                    <a href="{{ route('acuse.descargar', $ultimoParticipante->uudd) }}" target="_blank"
                        class="w-full sm:w-auto bg-gray-800 text-white font-medium px-6 py-2.5 rounded-xl hover:bg-gray-700 transition flex items-center justify-center gap-2">
                        📥 Descargar Acuse PDF
                    </a>
                @endif

                <button type="button" wire:click="reiniciarFormulario" 
                    class="w-full sm:w-auto bg-[#ff5608] text-white font-medium px-6 py-2.5 rounded-xl hover:bg-[#ee7a00] transition">
                    Ir al inicio
                </button>
            </div>
        </div>
    @else

        {{-- Indicador Visual de Pasos del Wizard --}}
        <div class="mb-8">
            <div class="flex items-center justify-between max-w-2xl mx-auto">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold {{ $paso == 1 ? 'bg-[#ff5608] text-white' : 'bg-gray-200 text-gray-600' }}">1</div>
                    <span class="text-base mt-1 text-gray-600">Personal</span>
                </div>
                <div class="flex-1 h-1 mx-2 {{ $paso > 1 ? 'bg-[#ff5608]' : 'bg-gray-200' }}"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold {{ $paso == 2 ? 'bg-[#ff5608] text-white' : 'bg-gray-200 text-gray-600' }}">2</div>
                    <span class="text-base mt-1 text-gray-600">Laboral</span>
                </div>
                <div class="flex-1 h-1 mx-2 {{ $paso > 2 ? 'bg-[#ff5608]' : 'bg-gray-200' }}"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold {{ $paso == 3 ? 'bg-[#ff5608] text-white' : 'bg-gray-200 text-gray-600' }}">3</div>
                    <span class="text-base mt-1 text-gray-600">Ponencia</span>
                </div>
                <div class="flex-1 h-1 mx-2 {{ $paso > 3 ? 'bg-[#ff5608]' : 'bg-gray-200' }}"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold {{ $paso == 4 ? 'bg-[#ff5608] text-white' : 'bg-gray-200 text-gray-600' }}">4</div>
                    <span class="text-base mt-1 text-gray-600">Archivos</span>
                </div>
            </div>
        </div>

        @if (session('ok'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-800 px-4 py-3">
                {{ session('ok') }}
            </div>
        @endif

        {{-- Formulario Principal --}}
        <div class="bg-white shadow-sm border border-gray-200 rounded-2xl p-6 md:p-8">
            <form wire:submit.prevent="guardar" class="flex flex-col gap-6">

                {{-- ================= PASO 1: DATOS PERSONALES ================= --}}
                @if ($paso == 1)
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-[#ff5608] border-b pb-2">1. Datos Personales y de Contacto</h3>

                        {{-- Nombre y apellidos --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex flex-col gap-1">
                                <label for="nombres" class="text-sm font-semibold text-gray-700">Nombre(s)</label>
                                <input id="nombres" type="text" wire:model="nombres" placeholder="Ingresa tu nombre"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                                @error('nombres') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="apellido_paterno" class="text-sm font-semibold text-gray-700">Apellido paterno</label>
                                <input id="apellido_paterno" type="text" wire:model="apellido_paterno" placeholder="Apellido paterno"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                                @error('apellido_paterno') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="apellido_materno" class="text-sm font-semibold text-gray-700">Apellido materno</label>
                                <input id="apellido_materno" type="text" wire:model="apellido_materno" placeholder="Apellido materno"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                                @error('apellido_materno') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Género y RFC --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <label for="genero" class="text-sm font-semibold text-gray-700">Género</label>
                                <select id="genero" wire:model="genero"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition">
                                    <option value="">Selecciona tu género</option>
                                    <option value="H">Hombre</option>
                                    <option value="M">Mujer</option>
                                    <option value="O">Otro</option>
                                </select>
                                @error('genero') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="rfc" class="text-sm font-semibold text-gray-700">RFC</label>
                                <input id="rfc" type="text" wire:model="rfc" placeholder="RFC"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white uppercase focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                                @error('rfc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Teléfono y correo --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <label for="telefono" class="text-sm font-semibold text-gray-700">Teléfono (10 dígitos)</label>
                                <input id="telefono" type="tel" wire:model="telefono" placeholder="Teléfono" maxlength="10"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                                @error('telefono') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="email" class="text-sm font-semibold text-gray-700">Correo electrónico</label>
                                <input id="email" type="email" wire:model="email" placeholder="Correo electrónico"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ================= PASO 2: DATOS LABORALES Y ADSCRIPCIÓN ================= --}}
                @if ($paso == 2)
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-[#ff5608] border-b pb-2">2. Adscripción Sindical y Laboral</h3>

                        {{-- Región y Delegación --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <label for="region_id" class="text-sm font-semibold text-gray-700">Región</label>
                                <select id="region_id" wire:model.live="region_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition">
                                    <option value="">Seleccione una región</option>
                                    @foreach ($regiones as $region)
                                        <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('region_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="delegacion_id" class="text-sm font-semibold text-gray-700">Delegación</label>
                                <select id="delegacion_id" wire:model="delegacion_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition">
                                    <option value="">Seleccione una delegación</option>
                                    @foreach ($delegaciones as $delegacion)
                                        <option value="{{ $delegacion->id }}">{{ $delegacion->delegacion_completa }}</option>
                                    @endforeach
                                </select>
                                @error('delegacion_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Nivel Educativo y Número Personal --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <label for="nivel_educativo" class="text-sm font-semibold text-gray-700">Nivel Educativo</label>
                                <select id="nivel_educativo" wire:model="nivel_educativo"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition">
                                    <option value="">Seleccione nivel educativo</option>
                                    <option value="PREESCOLAR">PREESCOLAR</option>
                                    <option value="EDUCACION ESPECIAL">EDUCACION ESPECIAL</option>
                                    <option value="PRIMARIAS">PRIMARIAS</option>
                                    <option value="SECUNDARIAS">SECUNDARIAS</option>
                                    <option value="PENSIONADOS Y JUBILADOS">PENSIONADOS Y JUBILADOS</option>
                                    <option value="EDUCACION FISICA">EDUCACION FISICA</option>
                                    <option value="NIVELES ESPECIALES">NIVELES ESPECIALES</option>
                                    <option value="TELESECUNDARIAS">TELESECUNDARIAS</option>
                                    <option value="PAAE">PAAE</option>
                                    <option value="BACHILLERATO">BACHILLERATO</option>
                                    <option value="TELEBACHILLERATO">TELEBACHILLERATO</option>
                                    <option value="NORMAL">NORMAL</option>
                                    <option value="UPV">UPV</option>
                                </select>
                                @error('nivel_educativo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="numero_personal" class="text-sm font-semibold text-gray-700">Número de Personal</label>
                                <input id="numero_personal" type="text" wire:model="numero_personal" placeholder="Número de personal"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                                @error('numero_personal') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ================= PASO 3: CUERPO DE LA PONENCIA ================= --}}
                @if ($paso == 3)
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-[#ff5608] border-b pb-2">3. Temática y Cuerpo de la Ponencia</h3>

                        <div class="flex flex-col gap-1">
                            <label for="tema" class="text-sm font-semibold text-gray-700">Eje Temático</label>
                            <select id="tema" wire:model="tema"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition">
                                <option value="">Seleccione el eje temático</option>
                                <option value="I. Artículo Tercero Constitucional, Educación y Escuela Pública.">I. Artículo Tercero Constitucional, Educación y Escuela Pública.</option>
                                <option value="II. Derechos Laborales y Profesionales.">II. Derechos Laborales y Profesionales.</option>
                                <option value="III. Previsión y Seguridad Social.">III. Previsión y Seguridad Social.</option>
                                <option value="IV. Jubilados y Pensionados.">IV. Jubilados y Pensionados.</option>
                                <option value="V. Salarios, Prestaciones e Incentivos.">V. Salarios, Prestaciones e Incentivos.</option>
                                <option value="VI. Inteligencia Artificial en el Ámbito Educativo y Sindical.">VI. Inteligencia Artificial en el Ámbito Educativo y Sindical.</option>
                                <option value="VII. Entornos Escolares Libres de Violencia.">VII. Entornos Escolares Libres de Violencia.</option>
                                <option value="VIII. Demandas de los Subsistemas Homologados.">VIII. Demandas de los Subsistemas Homologados.</option>
                                <option value="IX. Equidad, Paridad e Inclusión.">IX. Equidad, Paridad e Inclusión.</option>
                                <option value="X. Reforma Estatutaria.">X. Reforma Estatutaria.</option>
                            </select>
                            @error('tema') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="titulo_ponencia" class="text-sm font-semibold text-gray-700">Título de la Ponencia</label>
                            <input id="titulo_ponencia" type="text" wire:model="titulo_ponencia" placeholder="Título oficial de la propuesta"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition" />
                            @error('titulo_ponencia') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="diagnostico_problema" class="text-sm font-semibold text-gray-700">1. Diagnóstico y Planteamiento del Problema</label>
                            <textarea id="diagnostico_problema" wire:model="diagnostico_problema" rows="3" placeholder="Describa el contexto actual..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition"></textarea>
                            @error('diagnostico_problema') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="justificacion" class="text-sm font-semibold text-gray-700">2. Justificación y Fundamentación</label>
                            <textarea id="justificacion" wire:model="justificacion" rows="3" placeholder="Exponga las razones teóricas..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition"></textarea>
                            @error('justificacion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="propuesta_resolucion" class="text-sm font-semibold text-gray-700">3. Propuesta Concreta de Resolución / Acción</label>
                            <textarea id="propuesta_resolucion" wire:model="propuesta_resolucion" rows="3" placeholder="Detalle la propuesta de solución..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition"></textarea>
                            @error('propuesta_resolucion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="impacto_esperado" class="text-sm font-semibold text-gray-700">4. Impacto Esperado y Conclusiones</label>
                            <textarea id="impacto_esperado" wire:model="impacto_esperado" rows="3" placeholder="Sintetice los beneficios..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-[#ee7a00] focus:border-[#ee7a00] transition"></textarea>
                            @error('impacto_esperado') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @endif

                {{-- ================= PASO 4: ARCHIVOS ADJUNTOS ================= --}}
                @if ($paso == 4)
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-[#ff5608] border-b pb-2">4. Adjuntar Documentos</h3>
                        <p class="text-sm text-gray-600">Puedes adjuntar tu documento en formato PDF o Word (máximo 10MB por archivo).</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2 p-4 border border-dashed border-gray-300 rounded-xl bg-gray-50">
                                <label for="archivo_pdf" class="text-sm font-semibold text-gray-700">Documento en PDF</label>
                                <input id="archivo_pdf" type="file" wire:model="archivo_pdf" accept=".pdf"
                                    class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#ee7a00] hover:file:bg-orange-100" />
                                <div wire:loading wire:target="archivo_pdf" class="text-xs text-[#ee7a00]">Subiendo PDF...</div>
                                @error('archivo_pdf') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-2 p-4 border border-dashed border-gray-300 rounded-xl bg-gray-50">
                                <label for="archivo_docx" class="text-sm font-semibold text-gray-700">Documento en Word (Opcional)</label>
                                <input id="archivo_docx" type="file" wire:model="archivo_docx" accept=".doc,.docx"
                                    class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#ee7a00] hover:file:bg-orange-100" />
                                <div wire:loading wire:target="archivo_docx" class="text-xs text-[#ee7a00]">Subiendo Word...</div>
                                @error('archivo_docx') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ================= BOTONES DE NAVEGACIÓN ================= --}}
                <div class="flex items-center justify-between pt-4 border-t border-gray-200 mt-6">
                    @if ($paso > 1)
                        <button type="button" wire:click="pasoAnterior"
                            class="bg-gray-200 text-gray-700 font-medium px-6 py-2 rounded-2xl hover:bg-gray-300 transition">
                            Anterior
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if ($paso < 4)
                        <button type="button" wire:click="siguientePaso"
                            class="bg-[#ff5608] text-white font-medium px-8 py-2 rounded-2xl hover:bg-[#ee7a00] transition">
                            Siguiente
                        </button>
                    @else
                        <button type="submit" wire:loading.attr="disabled"
                            class="bg-green-600 text-white font-medium px-8 py-2 rounded-2xl hover:bg-green-700 transition flex items-center justify-center disabled:opacity-60">
                            <span wire:loading.remove wire:target="guardar">Finalizar y Registrar</span>
                            <span wire:loading wire:target="guardar">Guardando registro...</span>
                        </button>
                    @endif
                </div>

            </form>
        </div>
    @endif
</div>