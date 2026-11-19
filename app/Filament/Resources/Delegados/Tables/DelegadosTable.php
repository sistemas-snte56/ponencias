<?php

namespace App\Filament\Resources\Delegados\Tables;

use App\Exports\DelegadosExport;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class DelegadosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('delegacion.region.nombre')
                    ->searchable(),                
                TextColumn::make('delegacion.delegacion_completa')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('delegacion', function ($q) use ($search) {
                            $q->where('delegacion', 'like', "%{$search}%")
                            ->orWhere('sede', 'like', "%{$search}%")
                            ->orWhereHas('nivel', function ($nivelQuery) use ($search) {
                                $nivelQuery->where('nombre', 'like', "%{$search}%");
                            });
                        });
                    }),
                TextColumn::make('nombre_completo')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where(function ($q) use ($search) {
                            $q->where('nombre', 'like', "%{$search}%")
                            ->orWhere('apellido_paterno', 'like', "%{$search}%")
                            ->orWhere('apellido_materno', 'like', "%{$search}%")
                            ->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', COALESCE(apellido_materno, '')) like ?", ["%{$search}%"]);
                        });
                    }),
                // TextColumn::make('nombre')
                //     ->searchable(),
                // TextColumn::make('apellido_paterno')
                //     ->searchable(),
                // TextColumn::make('apellido_materno')
                //     ->searchable(),
                TextColumn::make('genero')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('rfc')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('telefono')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('nivel_educativo')
                    ->badge(),
                TextColumn::make('numero_personal')
                    ->searchable(),
                TextColumn::make('uudd')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('folio')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('estatus')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tema')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('exportar_excel')
                    ->label('Exportar a Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function () {
                        \Filament\Notifications\Notification::make()
                                    ->title('¡Exportación exitosa!')
                                    ->body('El archivo de delegados se ha descargado correctamente.')
                                    ->success()
                                    ->send();                        
                        return Excel::download(new DelegadosExport, 'delegados.xlsx');
                    })
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->paginationPageOptions([10, 25, 50, 100])
            ->defaultPaginationPageOption(100);            
    }
}
