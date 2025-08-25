<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Select;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Produk Jasa';
    protected static ?string $pluralModelLabel = 'Produk Jasa';
    protected static ?string $modelLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required(),
            TextInput::make('subtitle')->label('Subtitle'), // Tambahan
            Textarea::make('description')->required(),
            Textarea::make('long_description')->label('Long Description'), // Tambahan
            TextInput::make('price')->numeric()->required(),
            TextInput::make('slug')->required(),
            Toggle::make('is_active')->label('Active')->default(true),

            Select::make('category_id')
            ->label('Category')
            ->relationship('category', 'name')
            ->required(),

            Repeater::make('images')
                ->relationship('images')
                ->schema([
                    FileUpload::make('image_path')
                        ->disk('public')
                        ->label('Image')
                        ->directory('products')
                        ->image()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(2048) // maksimal 2MB
                        ->required(),
                ])
                ->label('Product Images')
                ->columnSpanFull(),

            // Specifications
            Repeater::make('specifications')
                ->relationship('specifications')
                ->schema([
                    TextInput::make('label')->required(),
                    TextInput::make('value')->required(),
                ])
                ->label('Specifications')
                ->columnSpanFull(),

            // Includes
            Repeater::make('includes')
                ->relationship('includes')
                ->schema([
                    TextInput::make('item')->required(),
                ])
                ->label('Includes')
                ->columnSpanFull(),

            // Features
            Repeater::make('features')
                ->relationship('features')
                ->schema([
                    TextInput::make('feature')
                        ->label('Feature Item')
                        ->nullable(), // sekarang optional
                ])
                ->label('Features')
                ->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('price')->money('IDR'),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
