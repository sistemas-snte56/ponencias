<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegacion_id')->constrained('delegaciones');

            //Datos personales
            $table->string('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->enum('genero', ['H', 'M', 'O'])->nullable();
            $table->string('rfc')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();

            // Datos laborales
            $table->enum('nivel_educativo', [
                'PREESCOLAR',
                'EDUCACION ESPECIAL',
                'PRIMARIAS',
                'SECUNDARIAS',
                'PENSIONADOS Y JUBILADOS',
                'EDUCACION FISICA',
                'NIVELES ESPECIALES',
                'TELESECUNDARIAS',
                'PAAE',
                'BACHILLERATO',
                'TELEBACHILLERATO',
                'NORMAL',
                'UPV'
            ])->nullable();            
            $table->string('numero_personal')->unique()->nullable();
            $table->string('uudd'); // Unidad/Dependencia

            // Ponencia
            $table->enum('tema', [
                'I. Artículo Tercero Constitucional, Educación y Escuela Pública.',
                'II. Derechos Laborales y Profesionales.',
                'III. Previsión y Seguridad Social.',
                'IV. Jubilados y Pensionados.',
                'V. Salarios, Prestaciones e Incentivos.',
                'VI. Inteligencia Artificial en el Ámbito Educativo y Sindical.',
                'VII. Entornos Escolares Libres de Violencia.',
                'VIII. Demandas de los Subsistemas Homologados.',
                'IX. Equidad, Paridad e Inclusión.',
                'X. Reforma Estatutaria.'
            ])->nullable();
            $table->string('ponencia_pdf_path')->nullable();
            $table->string('ponencia_docx_path')->nullable();

            // Control
            $table->string('folio')->unique();
            $table->text('codigo_qr')->nullable();
            $table->timestamp('descargado_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
