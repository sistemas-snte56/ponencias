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
            $table->string('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->enum('genero', ['H', 'M', 'O'])->nullable();
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
            $table->string('rfc')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('numero_personal')->unique()->nullable();
            $table->string('uudd'); // Unidad/Dependencia
            $table->string('folio')->unique();
            $table->text('codigo_qr')->nullable();
            $table->string('ponencia_pdf_path')->nullable();
            $table->string('ponencia_docx_path')->nullable();
            $table->timestamp('descargado_at')->nullable();
            
            // Relaciones
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
