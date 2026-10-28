<?php

use App\Livewire\ConsultaParticipante;
use App\Models\Participante;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Livewire\RegistroPonencia;


/*
|--------------------------------------------------------------------------
| Ruta Raíz
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return redirect()->route('public.consulta');
// });




Route::get('/', RegistroPonencia::class)->name('public.registro-ponencia');
/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

// 1. Buscador principal (Livewire) — los maestros se buscan aquí
Route::get('/consulta', ConsultaParticipante::class)
    ->name('public.consulta');

// // 2. Validación por QR — ruta que escanea el QR y muestra resultado directo
// Route::get('/validar/{uudd}', function ($uudd) {
//     $participante = Participante::where('uudd', $uudd)->first();

//     if (!$participante) {
//         return response()->view('validar.error_qr', [], 404);
//     }

//     return view('validar.resultados_qr', compact('participante'));
// })->name('validar.constancia');

// Ruta para descargar el Acuse en PDF con QR
Route::get('/descargar-acuse/{uudd}', function ($uudd) {
    $participante = Participante::where('uudd', $uudd)->firstOrFail();

    // Marcar como descargado si es la primera vez
    if (is_null($participante->descargado_at)) {
        $participante->update(['descargado_at' => now()]);
    }

    // Generar el código QR
    $qrCode = base64_encode(
        QrCode::format('svg')
            ->size(150)
            ->margin(1)
            ->errorCorrection('H')
            // ->generate(route('validar.constancia', $participante->uudd))
            ->generate(route('validar.constancia', ['uudd' => $participante->uudd]))
    );

    // Cargar la vista del PDF
    $pdf = Pdf::loadView('pdf.acuse-ponencia', compact('participante', 'qrCode'))
        ->setPaper('letter', 'portrait');

    return $pdf->stream('Acuse-' . $participante->folio . '.pdf');
})->name('acuse.descargar');


Route::get('/validar/{uudd}', function ($uudd) {
    $participante = Participante::where('uudd', $uudd)->first();

    if (!$participante) {
        return response()->view('validar.error_qr', [], 404);
    }

    return view('validar.resultados_qr', compact('participante'));
})->name('validar.constancia');