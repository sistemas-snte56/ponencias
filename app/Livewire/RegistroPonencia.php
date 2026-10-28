<?php

namespace App\Livewire;
use App\Models\Delegacion;
use App\Models\Participante;
use App\Models\Region;
use Livewire\WithFileUploads;

use Livewire\Component;

class RegistroPonencia extends Component
{

    use WithFileUploads;


    public $nombres = '';
    public $apellido_paterno = '';
    public $apellido_materno = '';
    public $genero = '';
    public $rfc = '';
    public $telefono = '';
    public $email = '';

    public $region_id = '';
    public $delegacion_id = '';
    public $regiones = [];
    public $delegaciones = [];


    public function updatedRegionId($value)
    {
        $this->delegacion_id = '';

        if ($value) {
            $this->delegaciones = Delegacion::where('region_id', $value)
                ->orderBy('delegacion')
                ->get();
        } else {
            $this->delegaciones = [];
        }
    }




    protected function rules()
    {
        return [
            'delegacion_id' => 'required|exists:delegaciones,id',
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'genero' => 'required|in:H,M,O',
            'rfc' => 'required|string|max:13|unique:participantes,rfc',
            'telefono' => 'required|numeric|max:10',
            'email' => 'required|email|max:255|unique:participantes,email',
        ];
    }

    protected function messages()
    {
        return [
            'delegacion_id.required' => 'La delegación es obligatoria.',
            'delegacion_id.exists' => 'La delegación seleccionada no es válida.',
            'nombres.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'genero.required' => 'El género es obligatorio.',
            'genero.in' => 'El género seleccionado no es válido.',
            'rfc.required' => 'El RFC es obligatorio.',
            'rfc.unique' => 'El RFC ya está registrado.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono debe tener 10 dígitos.',
            'telefono.numeric' => 'El teléfono debe contener solo números.',
        ];
    }

    public function guardar()
    {
        $this->validate();

        $participante = Participante::create([
            'delegacion_id' => $this->delegacion_id,
            'nombres' => $this->nombres,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno ?: null,
            'genero' => $this->genero,
            'rfc' => $this->rfc,
            'telefono' => $this->telefono ?: null,
            'email' => $this->email ?: null,
                       
        ]);


        session()->flash('ok', "Registro guardado. Tu folio es {$participante->folio}");

        // Limpiar los campos del formulario
        $this->reset(['delegacion_id', 'nombres', 'apellido_paterno', 'apellido_materno', 'genero', 'rfc', 'telefono', 'email']);
    }

    public function render()
    {
        // return view('livewire.registro-ponencia', [
        //     'delegaciones' => Delegacion::orderBy('delegacion')->get(),
        // ]);

        $this->regiones = Region::orderBy('id')->get();

        return view('livewire.registro-ponencia');        
    }

    
}
