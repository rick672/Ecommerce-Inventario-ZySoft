<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Detalles del Producto')
                    ->columns(12)
                    ->schema([
                        TextInput::make('code')
                            ->label('Código')
                            ->placeholder('Código del producto')
                            ->required()
                            ->alphaDash() //letras, numeros y guiones
                            ->columnSpan(3)
                            ->maxLength(50),
                        TextInput::make('name')
                            ->label('Nombre')
                            ->placeholder('Nombre del producto')
                            ->required()
                            ->columnSpan(5)
                            ->maxLength(255),
                        TextInput::make('price')
                            ->label('Precio')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Bs.')
                            ->required()
                            ->columnSpan(4)
                            ->step(0.01),
                        TextInput::make('summary')
                            ->label('Descripción corta')
                            ->placeholder('Descripción corta del producto')
                            ->required()
                            ->columnSpan(7)
                            ->maxLength(255),
                        Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'name')
                            ->placeholder('Selecciona una categoría')
                            ->searchable()
                            ->preload()
                            ->columnSpan(5)
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true)
                            ->columnSpan(12)
                            ->required(),
                    ]),
                Section::make('Imagen del Producto')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Imagen')
                            ->disk('public')
                            ->directory('products')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(2048) // 2MB
                            ->required()
                    ]),
                Section::make('Descripción')
                    ->schema([
                        RichEditor::make('description')
                            ->label('Descripción Detallada')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'link',
                                'redo',
                                'undo',
                            ])
                            ->helperText('Proporciona una descripción detallada del producto.'),
                    ]),
            ]);
    }
}
