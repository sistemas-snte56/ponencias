<?php

namespace App\Livewire\Validar;

use App\Models\Asamblea;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ValidacionAcreditado extends Component
{
    public $asamblea;

    public function mount($codigo)
    {
        // Buscamos el registro por su código único de acreditación
        $this->asamblea = Asamblea::where('codigo_acreditacion', $codigo)->first();

        // Si no existe, disparamos un error 404
        // if (!$this->asamblea) {
        //     abort(404, 'Código de acreditación no válido o inexistente.');
        // }
    }

    /**
     * Definimos un layout limpio para que no herede el panel administrativo de Filament
     */
    #[Layout('layouts.guest')] 
    public function render()
    {
        return view('livewire.validar.validacion-acreditado');
    }
}
