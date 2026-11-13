<?php

namespace App\Livewire;

use App\Models\Delegacion;
use App\Models\Delegado;
use App\Models\Region;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule as ValidationRule; // <-- 1. Importamos ValidationRule con alias para no chocar con el atributo Rule


#[Layout('components.layouts.app')]
class RegistroDelegado extends Component
{
    use WithFileUploads;

    #[Rule('required|string|max:255')]
    public string $nombre = '';

    #[Rule('required|string|max:255')]
    public string $apellido_paterno = '';

    #[Rule('nullable|string|max:255')]
    public string $apellido_materno = '';

    #[Rule('required|string|in:H,M,O')]
    public string $genero = '';

    #[Rule('required|string|size:13|unique:delegados,rfc')]
    public string $rfc = '';

    #[Rule('required|digits:10')]
    public string $telefono = '';

    #[Rule('required|email|max:255')]
    public string $email = '';

    public $regiones = [];
    public $delegaciones = [];


    #[Rule('required|exists:regiones,id')]
    public $region_id = '';

    #[Rule('required|exists:delegaciones,id')]
    public $delegacion_id = '';
    
    #[Rule('required|string|max:225')]
    public string $nivel_educativo = '';    
    
    #[Rule('required|integer|unique:delegados,numero_personal')]
    public string $numero_personal ='';

    #[Rule('required|string|max:225')]
    public string $tema ='';


    // Variables auxiliares para mostrar los nombres en la vista de revisión
    public string $region_nombre = '';
    public string $delegacion_nombre = '';    

    // #[Rule('nullable|image|mimes:jpg,jpeg,png|max:2048')]
    // public $fotografia;

    // Variable de control para alternar entre el formulario y la vista de revisión previa
    public bool $isConfirming = false;





    public function mount()
    {
        $this->regiones = Region::orderBy('id')->get();
    }

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

    protected function rules(): array
    {
        return [
            'tema' => ['required', 'string', ValidationRule::in(Delegado::TEMAS)],
        ];
    }



    // Paso 1: Valida los datos y pasa a la pantalla de revisión (sin guardar aún)
    public function reviewData()
    {
        $this->validate();

        $delegacionObj = Delegacion::with('region')->find($this->delegacion_id);

        $this->delegacion_nombre = $delegacionObj?->delegacion ?? '';
        $this->region_nombre = $delegacionObj?->region?->nombre ?? '';

        $this->isConfirming = true;
    }

    // Permitir regresar al formulario si el usuario detecta un error al revisar
    public function editData()
    {
        $this->isConfirming = false;
    }    

 

    protected function messages(): array
    {
        return [
            'region_id.required' => 'La región es obligatoria.',
            'delegacion_id.required' => 'La delegación es obligatoria.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'genero.required' => 'El género es obligatorio.',
            'rfc.required' => 'El RFC es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener 10 dígitos.',
            'rfc.size' => 'El RFC debe tener 13 caracteres.',
            'rfc.unique' => 'El RFC ya está registrado.',
            'numero_personal.unique' => 'El número personal ya está registrado.',
            'numero_personal.required' => 'El número personal es obligatorio.',
            'numero_personal.integer' => 'El número personal debe ser un valor numérico.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'nivel_educativo.required' => 'El nivel educativo es obligatorio.',
            'tema.required' => 'La selección del tema es obligatoria.',
            'fotografia.image' => 'La fotografía debe ser una imagen válida (jpg, jpeg, png).',
        ];
    }

    public function save()
    {
        // Inspecciona el valor exacto que se quiere guardar
        // dd([
        //     'nivel_educativo_enviado' => $this->nivel_educativo,
        //     'todos_los_datos' => $this->all()
        // ]);

        $this->validate();

        // $rutaFoto = $this->fotografia->store('delegados/fotos', 'public');

        $delegado = Delegado::create([
            'delegacion_id' => $this->delegacion_id,
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'genero' => $this->genero,
            'rfc' => $this->rfc,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'nivel_educativo' => $this->nivel_educativo,
            'numero_personal' => $this->numero_personal,
            // 'fotografia'                => $rutaFoto,
            'estatus'                   => 'presunto_delegado',
            'tema'                      => $this->tema,
        ]);

        return $this->redirectRoute('registro.exito', ['folio' => $delegado->folio], navigate: true);
    }

    public function reiniciarFormulario()
    {
        $this->reset([
            'region_id',
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
            'fotografia',
            'tema',
        ]);
    }

    public function render()
    {
        return view('livewire.registro.delegado.formulario', [
            'temas' => Delegado::TEMAS, // <-- 5. Enviamos la lista a la vista
        ]);
    }
}