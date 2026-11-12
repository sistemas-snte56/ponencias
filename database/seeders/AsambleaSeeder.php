<?php

namespace Database\Seeders;

use App\Models\Asamblea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class AsambleaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Leer el archivo JSON desde la carpeta database/data/
        $rutaJson = database_path('seeders/data/acreditados.json');
        
        if (!File::exists($rutaJson)) {
            $this->command->error("El archivo JSON no existe en: {$rutaJson}");
            return;
        }

        $json = File::get($rutaJson);
        $acreditados = json_decode($json, true);

        // 2. Limpiar la tabla antes de rellenar para evitar duplicados
        // Asamblea::truncate();

        // 3. Procesar e insertar los registros
        foreach ($acreditados as $datos) {
            
            // Convertir 'fecha_asamblea' de DD/MM/YYYY a YYYY-MM-DD
            if (!empty($datos['fecha_asamblea'])) {
                $datos['fecha_asamblea'] = Carbon::createFromFormat('d/m/Y', $datos['fecha_asamblea'])->format('Y-m-d');
            }

            // Convertir 'fecha_acreditacion' de DD/MM/YYYY a YYYY-MM-DD
            if (!empty($datos['fecha_acreditacion'])) {
                $datos['fecha_acreditacion'] = Carbon::createFromFormat('d/m/Y', $datos['fecha_acreditacion'])->format('Y-m-d');
            }

            // Insertar el registro en la base de datos usando asignación masiva
            Asamblea::create($datos);
        }

        $this->command->info("¡Se importaron correctamente " . count($acreditados) . " acreditados con éxito!");
    }
}
