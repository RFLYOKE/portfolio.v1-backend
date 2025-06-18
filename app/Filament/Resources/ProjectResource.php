<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';
    protected static ?string $navigationLabel = 'Projects';
    protected static ?string $pluralModelLabel = 'Projects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(1000),

                Forms\Components\Repeater::make('sub_description')
                    ->label('Sub Description')
                    ->schema([
                        Forms\Components\Textarea::make('value') 
                            ->label('Point')
                            ->required()
                            ->rows(2),
                    ])
                    ->defaultItems(1)
                    ->minItems(1)
                    ->columns(1)
                    ->cloneable()
                    ->dehydrated() 
                    ->mutateDehydratedStateUsing(fn ($state) => collect($state)->pluck('value')->toArray()),

                Forms\Components\TextInput::make('href')
                    ->label('Project Link')
                    ->url()
                    ->nullable(),

                Forms\Components\TextInput::make('logo')
                    ->nullable(),

                Forms\Components\TextInput::make('image')
                    ->label('Image Path')
                    ->required(),

                Forms\Components\MultiSelect::make('tags')
                    ->relationship('tags', 'name')
                    ->label('Technologies')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge()
                    ->separator(', '),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
