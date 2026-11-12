<?php

namespace Database\Seeders;

use App\Models\DelegacionAsamblea;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DelegacionAsambleaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Leer el archivo JSON desde la carpeta database/data/
        $rutaJson = database_path('seeders/data/delegaciones_asambleas.json');
        
        if (!File::exists($rutaJson)) {
            $this->command->error("El archivo JSON no existe en: {$rutaJson}");
            return;
        }
        
        $json = File::get($rutaJson);
        $delegaciones_asambleas = json_decode($json, true);    
        
        // 2. Limpiar la tabla antes de rellenar para evitar duplicados
        DelegacionAsamblea::truncate();

        // 3. Procesar e insertar los registros
        foreach ($delegaciones_asambleas as $datos) {
             // Insertar el registro en la base de datos usando asignación masiva
            DelegacionAsamblea::create($datos);
        }

        $this->command->info("¡Se importaron correctamente " . count($delegaciones_asambleas) . " delegaciones con éxito!");

    }
}
