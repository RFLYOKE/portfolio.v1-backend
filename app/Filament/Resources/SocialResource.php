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

                Forms\Components\TextInput::make('url')
                    ->label('Profile URL')
                    ->required()
                    ->url(),
            ]);
    }

/*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Configures the table for displaying social links.
     *
     * @param Table $table The table instance to configure.
     * @return Table The configured table instance with columns, filters, and actions.
     *
     * Columns:
     * - 'name': Sortable and searchable text column for the platform name.
     * - 'icon': Text column displaying the icon name or path, limited to 30 characters.
     * - 'url': Text column for the profile URL, limited to 50 characters.
     *
     * Actions:
     * - EditAction: Allows editing of table entries.
     *
     * Bulk Actions:
     * - DeleteBulkAction: Allows bulk deletion of selected entries.
     */

/*******  feab5c17-2062-4d92-b941-5fc24bf52188  *******/
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('icon')->label('Icon')->limit(30),
                Tables\Columns\TextColumn::make('url')->label('Link')->limit(50),
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
