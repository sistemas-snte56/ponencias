<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Participante extends Model
{
    protected $table = 'participantes';

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'rfc',
        'genero',
        'telefono',
        'email',
        'numero_personal',
        'uudd',
        'folio',
        'codigo_qr',
        'delegacion_id',
        'created_by',
        'status',
        'descargado_at',
        'nivel_educativo',
        'tema',
        'ponencia_pdf_path',
        'ponencia_docx_path',
        'titulo_ponencia',
        'diagnostico_problema',
        'justificacion',
        'propuesta_resolucion',
        'impacto_esperado',
    ];

    /**
     * El participante pertenece a una delegación
     */
    public function delegacion() : BelongsTo
    {
        return $this->belongsTo(Delegacion::class, 'delegacion_id');
    }

    /**
     * Relacionamos el usuario que creo el registro de los participantes
     */
    public function creador() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
   

    protected static function booted() : void
    {
        static::creating(function ($participante) {
            // 1. Asignar el creador automáticamente
            $participante->created_by = auth()->id() ?? 1;

            // 2. Generar UUID primero (lo necesitamos para el QR)
            $participante->uudd = (string) Str::uuid();


            // 3. Generar Folio ÚNICO con reintento automático
            $year = now()->format('Y');
            do {
                $nuevoFolio = "SNTE56-CSE-{$year}-" . strtoupper(bin2hex(random_bytes(3)));
                // Verificamos si este folio ya existe en la tabla
                $existe = static::where('folio', $nuevoFolio)->exists();
            } while ($existe);
            $participante->folio = $nuevoFolio;

            // 4. Generar la URL del QR
            $participante->codigo_qr = url("/validar/{$participante->uudd}");            

        });

        static::saving(function (Participante $participante) {
            $participante->nombres = mb_strtoupper(
                trim($participante->nombres), 'UTF-8'
            );

            $participante->apellido_paterno = mb_strtoupper(
                trim($participante->apellido_paterno),
                'UTF-8'
            );

            $participante->apellido_materno = $participante->apellido_materno
                ? mb_strtoupper(trim($participante->apellido_materno), 'UTF-8')
                : null;

            $participante->rfc = $participante->rfc
                ? mb_strtoupper(trim($participante->rfc), 'UTF-8')
                : null;

            $participante->titulo_ponencia = $participante->titulo_ponencia
                ? mb_strtoupper(trim($participante->titulo_ponencia), 'UTF-8')
                : null;
        });
    }    


    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => collect([
                $this->nombres,
                $this->apellido_paterno,
                $this->apellido_materno,
            ])
            ->filter() //filter() elimina los valores vacíos o null
            ->implode(' '), // los une utilizando un espacio:
        );
    }

    protected $casts = [
        'descargado_at' => 'datetime',
    ];

}
