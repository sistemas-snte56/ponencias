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

    // Control del Wizard (Paso actual: 1, 2, 3, 4 o 'exito')
    public $paso = 1;

    // 1. Datos Personales
    public $nombres = '';
    public $apellido_paterno = '';
    public $apellido_materno = '';
    public $genero = '';
    public $rfc = '';
    public $telefono = '';
    public $email = '';

    // 2. Adscripción (Región, Delegación, Nivel y Número personal)
    public $region_id = '';
    public $delegacion_id = '';
    public $nivel_educativo = '';
    public $numero_personal = '';
    
    public $regiones = [];
    public $delegaciones = [];

    // 3. Datos de la Ponencia
    public $tema = '';
    public $titulo_ponencia = '';
    public $diagnostico_problema = '';
    public $justificacion = '';
    public $propuesta_resolucion = '';
    public $impacto_esperado = '';

    // 4. Archivos Adjuntos
    public $archivo_pdf;
    public $archivo_docx;

    // Para mostrar el folio al finalizar
    public $folioRegistrado = null;

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

    // Navegación entre pasos del Wizard
    public function siguientePaso()
    {
        // Validar únicamente los campos correspondientes al paso actual antes de avanzar
        if ($this->paso == 1) {
            $this->validate([
                'nombres' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'nullable|string|max:255',
                'genero' => 'required|in:H,M,O',
                'rfc' => 'required|string|max:13|unique:participantes,rfc',
                'telefono' => 'required|digits:10',
                'email' => 'required|email|max:255|unique:participantes,email',
            ], [
                // Nombres
                'nombres.required' => 'El nombre es obligatorio.',
                'nombres.string' => 'El nombre debe ser texto.',
                'nombres.max' => 'El nombre no debe superar los 255 caracteres.',

                // Apellido paterno
                'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
                'apellido_paterno.string' => 'El apellido paterno debe ser texto.',
                'apellido_paterno.max' => 'El apellido paterno no debe superar los 255 caracteres.',

                // Apellido materno
                'apellido_materno.string' => 'El apellido materno debe ser texto.',
                'apellido_materno.max' => 'El apellido materno no debe superar los 255 caracteres.',

                // Género
                'genero.required' => 'El género es obligatorio.',
                'genero.in' => 'El género seleccionado no es válido.',

                // RFC
                'rfc.required' => 'El RFC es obligatorio.',
                'rfc.string' => 'El RFC debe ser texto.',
                'rfc.max' => 'El RFC no debe superar los 13 caracteres.',
                'rfc.unique' => 'Este RFC ya está registrado.',

                // Teléfono
                'telefono.required' => 'El teléfono es obligatorio.',
                'telefono.digits' => 'El teléfono debe contener exactamente 10 dígitos.',

                // Email
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'Ingresa un correo electrónico válido.',
                'email.max' => 'El correo no debe superar los 255 caracteres.',
                'email.unique' => 'Este correo electrónico ya está registrado.',
            ]);
        } elseif ($this->paso == 2) {
            $this->validate([
                'region_id' => 'required',
                'delegacion_id' => 'required|exists:delegaciones,id',
                'nivel_educativo' => 'required',
                'numero_personal' => 'nullable|regex:/^[0-9]+$/|max:10|unique:participantes,numero_personal',
            ],[
                // Región
                'region_id.required' => 'La región es obligatoria.',

                // Delegación
                'delegacion_id.required' => 'La delegación es obligatoria.',
                'delegacion_id.exists' => 'La delegación seleccionada no es válida.',

                // Nivel educativo
                'nivel_educativo.required' => 'El nivel educativo es obligatorio.',

                // Número de personal
                'numero_personal.regex' => 'El número de personal debe ser numérico.',
                'numero_personal.max' => 'El número de personal no debe superar los 10 caracteres.',
                'numero_personal.unique' => 'Este número de personal ya cuenta con una ponencia registrada.',
            ]);
        } elseif ($this->paso == 3) {
            $this->validate([
                'tema' => 'required',
                'titulo_ponencia' => 'required|string|max:255',
                'diagnostico_problema' => 'required|string',
                'justificacion' => 'required|string',
                'propuesta_resolucion' => 'required|string',
                'impacto_esperado' => 'required|string',
            ],[
                // Tema
                'tema.required' => 'El tema es obligatorio.',

                // Título de la ponencia
                'titulo_ponencia.required' => 'El título de la ponencia es obligatorio.',
                'titulo_ponencia.string' => 'El título de la ponencia debe ser texto.',
                'titulo_ponencia.max' => 'El título de la ponencia no debe superar los 255 caracteres.',

                // Diagnóstico del problema
                'diagnostico_problema.required' => 'El diagnóstico del problema es obligatorio.',
                'diagnostico_problema.string' => 'El diagnóstico del problema debe ser texto.',

                // Justificación
                'justificacion.required' => 'La justificación es obligatoria.',
                'justificacion.string' => 'La justificación debe ser texto.',

                // Propuesta de resolución
                'propuesta_resolucion.required' => 'La propuesta de resolución es obligatoria.',
                'propuesta_resolucion.string' => 'La propuesta de resolución debe ser texto.',

                // Impacto esperado
                'impacto_esperado.required' => 'El impacto esperado es obligatorio.',
                'impacto_esperado.string' => 'El impacto esperado debe ser texto.',
            ]);
        }

        $this->paso++;
    }

    public function pasoAnterior()
    {
        if ($this->paso > 1) {
            $this->paso--;
        }
    }

    // Guardar todo el registro final
    public function guardar()
    {
        // Validación del último paso (Archivos opcionales u obligatorios según definas)
        $this->validate([
            'archivo_pdf' => 'required|mimes:pdf|max:10240', // Máx 10MB
            'archivo_docx' => 'nullable|mimes:doc,docx|max:10240',
        ], [
            // Archivo PDF
            'archivo_pdf.mimes' => 'El archivo debe estar en formato PDF.',
            'archivo_pdf.max' => 'El archivo PDF no debe superar los 10 MB.',
            'archivo_pdf.required' => 'El archivo PDF es obligatorio.',

            // Archivo Word
            'archivo_docx.mimes' => 'El archivo debe estar en formato Word (.doc o .docx).',
            'archivo_docx.max' => 'El archivo Word no debe superar los 10 MB.',
        ]);

        // Guardar archivos si existen
        $pdfPath = $this->archivo_pdf ? $this->archivo_pdf->store('ponencias/pdfs', 'public') : null;
        $docxPath = $this->archivo_docx ? $this->archivo_docx->store('ponencias/docs', 'public') : null;

        // Creación del participante (aprovechando tu modelo que genera folio y QR automático)
        $participante = Participante::create([
            'delegacion_id' => $this->delegacion_id,
            'nombres' => $this->nombres,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno ?: null,
            'genero' => $this->genero,
            'rfc' => $this->rfc,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'nivel_educativo' => $this->nivel_educativo,
            'numero_personal' => $this->numero_personal ?: null,
            'tema' => $this->tema,
            'titulo_ponencia' => $this->titulo_ponencia,
            'diagnostico_problema' => $this->diagnostico_problema,
            'justificacion' => $this->justificacion,
            'propuesta_resolucion' => $this->propuesta_resolucion,
            'impacto_esperado' => $this->impacto_esperado,
            'ponencia_pdf_path' => $pdfPath,
            'ponencia_docx_path' => $docxPath,
        ]);

        $this->folioRegistrado = $participante->folio;
        $this->paso = 'exito'; // Cambia a la pantalla final de acuse
    }

    public function reiniciarFormulario()
    {
        $this->reset([
            'paso',
            'nombres',
            'apellido_paterno',
            'apellido_materno',
            'genero',
            'rfc',
            'telefono',
            'email',
            'region_id',
            'delegacion_id',
            'nivel_educativo',
            'numero_personal',
            'tema',
            'titulo_ponencia',
            'diagnostico_problema',
            'justificacion',
            'propuesta_resolucion',
            'impacto_esperado',
            'archivo_pdf',
            'archivo_docx',
            'folioRegistrado',
        ]);

        // Volver explícitamente al paso 1 y recargar regiones
        $this->paso = 1;
        $this->regiones = Region::orderBy('id')->get();
        $this->delegaciones = [];
    }

    public function render()
    {
        return view('livewire.registro-ponencia');
    }
}