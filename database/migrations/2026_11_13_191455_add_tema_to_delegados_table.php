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
        Schema::table('delegados', function (Blueprint $table) {
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
            ])->nullable()->after;  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delegados', function (Blueprint $table) {
            $table->dropColumn('tema');
        });
    }
};
