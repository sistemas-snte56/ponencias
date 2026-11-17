<?php

namespace App\Filament\Resources\Delegados\Pages;

use App\Filament\Resources\Delegados\DelegadoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDelegado extends ViewRecord
{
    protected static string $resource = DelegadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
