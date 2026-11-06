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
        Schema::create('asambleas', function (Blueprint $table) {
            $table->id(); // 1, 2, 3...
            
            // Códigos únicos e identificadores
            $table->string('codigo_acreditacion')->unique(); // Ej: 56-SP29-KQJR-2
            $table->string('convocatoria'); // Ej: 56-2G7Q-793N-6
            
            // Personal directivo de la asamblea
            $table->string('presidente'); // Ej: PROF. JUAN MARTÍNEZ ACOSTA
            $table->string('copresidente')->nullable(); // Puede quedar vacío (null) como en tus ejemplos
            
            // Ubicación organizacional interna del SNTE
            $table->string('region'); // Ej: EXTRAORDINARIA (Nota: revisa si aquí va el nombre de la región)
            $table->string('delegacion_ct'); // Ej: Delegación D-I-83
            
            // Fechas clave
            $table->date('fecha_asamblea'); // Guardará la fecha en formato YYYY-MM-DD
            $table->date('fecha_acreditacion'); // Guardará la fecha en formato YYYY-MM-DD
            
            // Datos del lugar y geografía
            $table->string('recinto'); // Ej: EDIFICIO SINDICAL
            $table->text('domicilio'); // Usamos text por si el domicilio es muy largo
            $table->string('lugar_expedicion'); // Ej: Xalapa-Enríquez, Veracruz
            
            // Control e identificación visual
            $table->integer('version')->default(1); // Número de versión (1, 2...)
            $table->string('titulo_lateral')->nullable(); // Ej: ACRETACIÓN PRESIDENTE(A)...
            
            $table->timestamps(); // Crea automáticamente created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asambleas');
    }
};
