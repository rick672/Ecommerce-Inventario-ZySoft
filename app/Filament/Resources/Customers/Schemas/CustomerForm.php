<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Información del Cliente')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required(),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->unique(table: 'customers', column: 'email')
                            ->validationMessages([
                                'unique' => 'Este correo electrónico ya está en uso.',
                            ])
                            ->email(),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->unique(table: 'customers', column: 'phone')
                            ->validationMessages([
                                'unique' => 'Este teléfono ya está en uso.',
                            ])
                            ->tel(),
                        TextInput::make('nit')
                            ->label('NIT / Razón Social')
                            ->unique(table: 'customers', column: 'nit')
                            ->validationMessages([
                                'unique' => 'Esta razón social ya está en uso.',
                            ])
                            ->required(),
                        Toggle::make('is_active')
                            ->label('¿Activo?')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }
}
