<?php

namespace App\Filament\Resources\Delegados\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DelegadoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('delegacion.id')
                    ->label('Delegacion'),
                TextEntry::make('nombre'),
                TextEntry::make('apellido_paterno'),
                TextEntry::make('apellido_materno')
                    ->placeholder('-'),
                TextEntry::make('genero')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('rfc')
                    ->placeholder('-'),
                TextEntry::make('telefono')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('nivel_educativo')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('numero_personal')
                    ->placeholder('-'),
                TextEntry::make('uudd'),
                TextEntry::make('folio'),
                TextEntry::make('codigo_qr')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('fotografia')
                    ->placeholder('-'),
                TextEntry::make('estatus'),
                TextEntry::make('descargado_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('tema')
                    ->badge()
                    ->placeholder('-'),
            ]);
    }
}
