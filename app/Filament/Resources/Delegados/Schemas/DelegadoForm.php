<?php

namespace App\Filament\Resources\Delegados\Schemas;

use App\Models\Delegado;
use App\Models\Delegacion;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DelegadoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ==========================================
                // 1. DATOS PERSONALES
                // ==========================================

                Section::make('Datos personales')
                    ->description('Información personal del delegado.')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([

                        TextInput::make('nombre')
                            ->label('Nombre(s)')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('apellido_paterno')
                            ->label('Apellido paterno')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('apellido_materno')
                            ->label('Apellido materno')
                            ->maxLength(255),

                        Select::make('genero')
                            ->label('Género')
                            ->options([
                                'H' => 'Hombre',
                                'M' => 'Mujer',
                                'O' => 'Otro',
                            ])
                            ->native(false),

                        TextInput::make('rfc')
                            ->label('RFC')
                            ->maxLength(13)
                            ->minLength(12)
                            ->regex('/^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$/i')
                            ->validationMessages([
                                'regex' => 'El RFC no tiene un formato válido.',
                            ])
                            ->extraInputAttributes([
                                'style' => 'text-transform: uppercase',
                            ]),

                        TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(20),

                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        FileUpload::make('fotografia')
                            ->label('Fotografía del delegado')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('delegados')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->columnSpanFull(),

                    ]),

                // ==========================================
                // 2. DATOS LABORALES
                // ==========================================

                Section::make('Datos laborales')
                    ->description('Información de adscripción y situación laboral.')
                    ->icon('heroicon-o-briefcase')
                    ->columns(2)
                    ->schema([

                        Select::make('delegacion_id')
                            ->label('Delegación')
                            ->relationship(
                                name: 'delegacion',
                                titleAttribute: 'delegacion',
                            )
                            ->getOptionLabelFromRecordUsing(
                                fn (Delegacion $record): string =>
                                    $record->delegacion_completa
                            )
                            ->searchable(['delegacion'])
                            ->preload()
                            ->required()
                            ->columnSpanFull(),

                        Select::make('nivel_educativo')
                            ->label('Nivel educativo')
                            ->options([
                                'PREESCOLAR' => 'Preescolar',
                                'EDUCACION ESPECIAL' => 'Educación especial',
                                'PRIMARIAS' => 'Primarias',
                                'SECUNDARIAS' => 'Secundarias',
                                'PENSIONADOS Y JUBILADOS' => 'Pensionados y jubilados',
                                'EDUCACION FISICA' => 'Educación física',
                                'NIVELES ESPECIALES' => 'Niveles especiales',
                                'TELESECUNDARIAS' => 'Telesecundarias',
                                'PAAE' => 'PAAE',
                                'BACHILLERATO' => 'Bachillerato',
                                'TELEBACHILLERATO' => 'Telebachillerato',
                                'NORMAL' => 'Normal',
                                'UPV' => 'UPV',
                            ])
                            ->searchable()
                            ->native(false),

                        TextInput::make('numero_personal')
                            ->label('Número de personal')
                            ->maxLength(50),

                    ]),

                // ==========================================
                // 3. DATOS DEL CONGRESO
                // ==========================================

                Section::make('Datos del congreso')
                    ->description('Información de participación del delegado.')
                    ->icon('heroicon-o-academic-cap')
                    ->columns(2)
                    ->schema([

                        Select::make('tema')
                            ->label('Tema de participación')
                            ->options(
                                collect(Delegado::TEMAS)
                                    ->mapWithKeys(fn ($tema) => [
                                        $tema => $tema,
                                    ])
                                    ->all()
                            )
                            ->searchable()
                            ->native(false)
                            ->required()
                            ->columnSpanFull(),

                        Select::make('estatus')
                            ->label('Estatus del delegado')
                            ->options([
                                'presunto_delegado' => 'Presunto delegado',
                                'delegado_electo' => 'Delegado electo',
                                'delegado_efectivo' => 'Delegado efectivo',
                            ])
                            ->default('presunto_delegado')
                            ->native(false)
                            ->required(),

                    ]),

            ]);
    }
}
