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
        Schema::create('delegaciones_asambleas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regiones')->cascadeOnDelete();
            $table->string('delegacion', 100);
            $table->string('fecha_asamblea', 100);
            $table->time('hora');
            $table->string('recinto', 255);
            $table->string('domicilio', 500);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegaciones_asambleas');
    }
};
