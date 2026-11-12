<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DelegacionAsamblea extends Model
{
        /**
     * Nombre de la tabla.
     */
    protected $table = 'delegaciones_asambleas';

    /**
     * Campos permitidos para asignación masiva.
     */
    protected $fillable = [
        'region_id',
        'delegacion',
        'fecha_asamblea',
        'hora',
        'recinto',
        'domicilio',
    ];

    /**
     * Conversiones de atributos.
     */
    // protected function casts(): array
    // {
    //     return [
    //         'fecha_asamblea' => 'date',
    //     ];
    // }

    /**
     * Relación: Una delegación pertenece a una región.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
