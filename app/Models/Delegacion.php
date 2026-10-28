<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Delegacion extends Model
{
    protected $table = 'delegaciones';

    protected $fillable = [
        'region_id',
        'nivel_id',
        'delegacion',
    ];

    /**
     * La delegación pertenece a una región
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * La delegación pertenece a un nivel educativo
     */
    public function nivel(): BelongsTo
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }  
    
    /**
     * Se obtiene el nombre completo de la delegacion y se utiliaza para mostrarlo en el select de la relacion con los participantes
     */
    protected function delegacionCompleta(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->delegacion . ' - ' . $this->nivel->nombre . ' - ' . $this->sede,
        );
    }    
}
