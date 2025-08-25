<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kategori')
                    ->label('Kategori')
                    ->required()
                    ->maxLength(100),

                TextInput::make('judul')
                    ->required()
                    ->maxLength(255),

                Textarea::make('headline')
                    ->label('Headline Utama')
                    ->maxLength(500),

                Textarea::make('deskripsi')
                    ->maxLength(1000),

                FileUpload::make('gambar')
                    ->directory('banners')
                    ->image()
                    ->required()
                    ->maxSize(2048),

                TextInput::make('link')
                    ->label('URL Shop Now')
                    ->placeholder('https://domain.com/shop')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori')->label('Kategori')->sortable()->searchable(),
                TextColumn::make('judul')->sortable()->searchable(),
                TextColumn::make('headline')->limit(30),
                TextColumn::make('deskripsi')->limit(30),
                ImageColumn::make('gambar')->label('Gambar'),
                TextColumn::make('link')->label('Link')->limit(30),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
