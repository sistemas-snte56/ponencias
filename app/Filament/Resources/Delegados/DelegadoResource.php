<?php

namespace App\Filament\Resources\Delegados;

use App\Filament\Resources\Delegados\Pages\CreateDelegado;
use App\Filament\Resources\Delegados\Pages\EditDelegado;
use App\Filament\Resources\Delegados\Pages\ListDelegados;
use App\Filament\Resources\Delegados\Pages\ViewDelegado;
use App\Filament\Resources\Delegados\Schemas\DelegadoForm;
use App\Filament\Resources\Delegados\Schemas\DelegadoInfolist;
use App\Filament\Resources\Delegados\Tables\DelegadosTable;
use App\Models\Delegado;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DelegadoResource extends Resource
{
    protected static ?string $model = Delegado::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre_completo';

    public static function form(Schema $schema): Schema
    {
        return DelegadoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DelegadoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DelegadosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDelegados::route('/'),
            'create' => CreateDelegado::route('/create'),
            'view' => ViewDelegado::route('/{record}'),
            'edit' => EditDelegado::route('/{record}/edit'),
        ];
    }
}
