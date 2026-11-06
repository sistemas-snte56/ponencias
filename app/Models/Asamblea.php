<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asamblea extends Model
{
    protected $table = 'asambleas';
    protected $fillable = [
        'codigo_acreditacion',
        'convocatoria',
        'presidente',
        'copresidente',
        'region',
        'delegacion_ct',
        'fecha_asamblea',
        'fecha_acreditacion',
        'recinto',
        'domicilio',
        'lugar_expedicion',
        'version',
        'titulo_lateral'
    ];

    /**
     * Mutadores de conversión de tipos (Casts)
     * Esto asegura que Laravel trate las fechas como objetos Carbon de manera automática.
     */
    protected $casts = [
        'fecha_asamblea' => 'date',
        'fecha_acreditacion' => 'date',
        'version' => 'integer',
    ];    
}
