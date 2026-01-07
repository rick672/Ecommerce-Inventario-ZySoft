<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->rules('required', 'string', 'max:255'),

                TextInput::make('slug')
                    ->required()
                    ->rules('required', 'string', 'max:255', 'unique:categories,slug'),

                TextInput::make('summary')
                    ->rules('nullable', 'string', 'max:255'),
            ]);
    }
}
