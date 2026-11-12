<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Delegado extends Model
{
    protected $table = 'delegados';

    protected $fillable = [
        'delegacion_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'genero',
        'rfc',
        'telefono',
        'email',
        'nivel_educativo',
        'numero_personal',
        'uudd',
        'folio',
        'codigo_qr',
        'fotografia',
        'estatus'
    ];


    /**
     * El delegado pertenece a una delegación
     */
    public function delegacion() : BelongsTo
    {
        return $this->belongsTo(Delegacion::class, 'delegacion_id');
    }
    
    protected static function booted() : void
    {
        static::creating(function ($delegado) {
            // 1. Asignar el creador automáticamente
            $delegado->created_by = auth()->id() ?? 1;

            // 2. Generar UUID primero (lo necesitamos para el QR)
            $delegado->uudd = (string) Str::uuid();


            // 3. Generar Folio ÚNICO con reintento automático
            $year = now()->format('Y');
            do {
                $nuevoFolio = "SNTE56-CSE-{$year}-" . strtoupper(bin2hex(random_bytes(3)));
                // Verificamos si este folio ya existe en la tabla
                $existe = static::where('folio', $nuevoFolio)->exists();
            } while ($existe);
            $delegado->folio = $nuevoFolio;

            // 4. Generar la URL del QR
            $delegado->codigo_qr = url("/validar-delegado/{$delegado->uudd}");            

        });

        static::saving(function (delegado $delegado) {
            $delegado->nombre = mb_strtoupper(
                trim($delegado->nombre), 'UTF-8'
            );

            $delegado->apellido_paterno = mb_strtoupper(
                trim($delegado->apellido_paterno),
                'UTF-8'
            );

            $delegado->apellido_materno = $delegado->apellido_materno
                ? mb_strtoupper(trim($delegado->apellido_materno), 'UTF-8')
                : null;

            $delegado->rfc = $delegado->rfc
                ? mb_strtoupper(trim($delegado->rfc), 'UTF-8')
                : null;

        });
    }    


    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => collect([
                $this->nombre,
                $this->apellido_paterno,
                $this->apellido_materno,
            ])
            ->filter() //filter() elimina los valores vacíos o null
            ->implode(' '), // los une utilizando un espacio:
        );
    }    

    public function getEstatusLabelAttribute(): string
    {
        return match ($this->estatus) {
            'presunto_delegado' => 'PRESUNTO DELEGADO',
            'delegado_electo'   => 'DELEGADO ELECTO',
            'delegado_efectivo' => 'DELEGADO EFECTIVO',
            default             => 'PRESUNTO DELEGADO',
        };
    }

    public function getEstatusColorHexAttribute(): string
    {
        return match ($this->estatus) {
            'presunto_delegado' => '#D97706', // Ámbar / Naranja
            'delegado_electo'   => '#2563EB', // Azul institucional
            'delegado_efectivo' => '#059669', // Verde validación
            default             => '#D97706',
        };
    }    

}
