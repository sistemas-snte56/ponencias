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
        Schema::create('delegados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegacion_id')->constrained('delegaciones_asambleas')->cascadeOnDelete();

            //Datos personales
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->enum('genero', ['H', 'M', 'O'])->nullable();
            $table->string('rfc', 13)->unique()->nullable();
            $table->string('telefono', 10)->nullable();
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
            
            // Control
            $table->string('folio')->unique();
            $table->text('codigo_qr')->nullable();
            $table->string('fotografia')->nullable();

            // Estatus: presunto_delegado, delegado_electo, delegado_efectivo
            $table->string('estatus')->default('presunto_delegado');  
            
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
        Schema::dropIfExists('delegados');
    }
};
