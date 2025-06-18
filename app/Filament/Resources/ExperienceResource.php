<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Experiences';
    protected static ?string $pluralModelLabel = 'Experiences';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('job')
                    ->label('Job Description')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('Start date')
                    ->required(),
                Forms\Components\DatePicker::make('End date'),

                Forms\Components\Repeater::make('contents')
                ->label('Experience Details')
                ->schema([
                    Forms\Components\Textarea::make('value')->label('Description'),
                ])
                ->addable()
                ->deletable()
                ->reorderable()
                ->default([])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('job')
                    ->label('Job'),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date'),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date'),
            ])
            ->filters([
                
            ])
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
