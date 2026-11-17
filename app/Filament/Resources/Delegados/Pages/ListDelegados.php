<?php

namespace App\Filament\Resources\Delegados\Pages;

use App\Filament\Resources\Delegados\DelegadoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDelegados extends ListRecords
{
    protected static string $resource = DelegadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
