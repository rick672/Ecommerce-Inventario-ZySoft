<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable()
                    ->color('info')
                    ->badge(),
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->imageSize(80),
                
                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable()
                    ->searchable()
                    ->color('success')
                    ->badge(),
                TextColumn::make('price')
                    ->label('Precio')
                    ->money('BOB', true)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('is_active')
                    ->label('Estado')
                    ->sortable()
                    ->searchable()
                    ->color(fn (bool $state) => $state ? 'primary' : 'danger')
                    ->formatStateUsing(fn (bool $state) => $state ? 'Activo' : 'Inactivo')
                    ->badge(),
                TextColumn::make('summary')
                    ->label('Descripción corta')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date(),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
