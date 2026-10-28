<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acuse de Registro - {{ $participante->folio }}</title>
    <style>
        body { font-family: sans-serif; color: #333; font-size: 13px; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #ee7a00; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; color: #ee7a00; }
        .subtitle { font-size: 14px; color: #666; }
        .folio-box { background: #f9f9f9; border: 1px solid #ddd; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .folio { font-size: 20px; font-weight: bold; color: #ee7a00; }
        .section-title { font-weight: bold; background: #eee; padding: 5px 10px; margin-top: 15px; margin-bottom: 8px; font-size: 12px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        td { padding: 4px 6px; vertical-align: top; }
        .label { font-weight: bold; width: 35%; color: #555; }
        .footer { position: absolute; bottom: 30px; width: 100%; text-align: center; font-size: 10px; color: #777; border-top: 1px solid #ddd; padding-top: 10px; }
        .qr-container { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">SINDICATO NACIONAL DE TRABAJADORES DE LA EDUCACIÓN</div>
        <div class="subtitle">
            XII Congreso Seccional Extraordinario de la <strong>Sección 56 del SNTE</strong><br>Comprobante de Registro</div>
    </div>

    <div class="folio-box">
        <span>FOLIO DE REGISTRO OFICIAL</span>
        <div class="folio">{{ $participante->folio }}</div>
    </div>

    <div class="section-title">Datos del Participante</div>
    <table>
        <tr>
            <td class="label">Nombre Completo:</td>
            <td>{{ $participante->nombre_completo }}</td>
        </tr>
        <tr>
            <td class="label">RFC:</td>
            <td>{{ $participante->rfc }}</td>
        </tr>
        <tr>
            <td class="label">Número de Personal:</td>
            <td>{{ $participante->numero_personal ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Nivel Educativo:</td>
            <td>{{ $participante->nivel_educativo }}</td>
        </tr>
        <tr>
            <td class="label">Región:</td>
            <td>{{ $participante->delegacion->region->nombre ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Delegación:</td>
            <td>{{ $participante->delegacion->delegacion_completa ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-title">Datos de la Ponencia</div>
    <table>
        <tr>
            <td class="label">Eje Temático:</td>
            <td>{{ $participante->tema }}</td>
        </tr>
        <tr>
            <td class="label">Título:</td>
            <td><strong>{{ $participante->titulo_ponencia }}</strong></td>
        </tr>
    </table>

    <div class="qr-container">
        <img src="data:image/svg+xml;base64,{{ $qrCode }}" width="110" alt="Código QR de Validación">
        <div style="font-size: 9px; color: #555; margin-top: 4px;">Escanea para validar autenticidad</div>
    </div>

    <div class="footer">
        Este documento es un comprobante oficial de registro generado digitalmente el {{ $participante->created_at->format('d/m/Y H:i') }}.<br>
        Sistema de Gestión de Ponencias - SNTE.
    </div>

</body>
</html>