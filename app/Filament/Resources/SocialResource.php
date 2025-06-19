<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialResource\Pages;
use App\Models\Social;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SocialResource extends Resource
{
    protected static ?string $model = Social::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationLabel = 'Social Links';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Platform Name')
                    ->required()
                    ->maxLength(100),

                    Forms\Components\FileUpload::make('icon')
                    ->label('Upload Icon')
                    ->image()
                    ->directory('icons') // folder penyimpanan di storage/app/public/icons
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/svg+xml'])
                    ->maxSize(1024) // maks 1MB
                    ->helperText('Upload gambar icon (SVG, PNG, JPG)')
                    ->required(),                

                Forms\Components\TextInput::make('href')
                    ->label('Profile URL')
                    ->required()
                    ->url(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('icon')->label('Icon')->height(60),
                Tables\Columns\TextColumn::make('href')->label('Link')->limit(50),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocials::route('/'),
            'create' => Pages\CreateSocial::route('/create'),
            'edit' => Pages\EditSocial::route('/{record}/edit'),
        ];
    }
}
