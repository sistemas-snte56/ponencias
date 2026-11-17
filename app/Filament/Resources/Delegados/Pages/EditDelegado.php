<?php

namespace App\Filament\Resources\Delegados\Pages;

use App\Filament\Resources\Delegados\DelegadoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDelegado extends EditRecord
{
    protected static string $resource = DelegadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
