<?php

namespace App\Exports;

use App\Models\Delegado; // O el nombre del modelo que mapea tus registros
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Filament\Notifications\Notification; // Opcional: si usas las notificaciones de Filament

class DelegadosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Delegado::with('delegacion.region', 'delegacion.nivel')
            ->get()
            ->map(function ($delegado) {
                return [
                    'Región' => $delegado->delegacion->region->nombre ?? '',
                    'Delegacion' => $delegado->delegacion->delegacion ?? '',
                    'Sede' => $delegado->delegacion->sede ?? '',
                    'Nivel' => $delegado->delegacion->nivel->nombre ?? '',
                    'Nombre' => $delegado->nombre,
                    'Apellido Paterno' => $delegado->apellido_paterno,
                    'Apellido Materno' => $delegado->apellido_materno,
                    'Género' => $delegado->genero,
                    'RFC' => $delegado->rfc,
                    'Teléfono' => $delegado->telefono,
                    'Email' => $delegado->email,
                    'Número_Personal' => $delegado->numero_personal,
                    'Nivel_Educativo' => $delegado->nivel_educativo,
                    'Estatus' => $delegado->estatus,
                    'Tema' => strtoupper($delegado->tema),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Región',
            'Delegacion',
            'Sede',
            'Nivel',
            'Nombre',
            'Apellido Paterno',
            'Apellido Materno',
            'Género',
            'RFC',
            'Teléfono',
            'Email',
            'Número_Personal',
            'Nivel_Educativo',
            'Estatus',
            'Tema',
        ];
    }

    /**
     * Se ejecuta justo cuando el archivo termina de procesarse
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Aquí puedes mandar una notificación de Filament al usuario autenticado si lo deseas:
                Notification::make()
                    ->title('¡Exportación exitosa!')
                    ->body('El padrón de delegados se ha descargado correctamente.')
                    ->success()
                    ->sendToDatabase(auth()->user()); // Opcional: envíalo a su centro de notificaciones
            },
        ];
    }    
}