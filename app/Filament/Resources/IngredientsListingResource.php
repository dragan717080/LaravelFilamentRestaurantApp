<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngredientsListingResource\Pages;
use App\Filament\Resources\IngredientsListingResource\Pages\ListIngredientsListings;
use App\Filament\Resources\IngredientsListingResource\RelationManagers;
use App\Filament\Resources\RecipeResource\Pages\{ CreateRecipe, EditRecipe, ListRecipes };
use App\Models\{ IngredientsListing, Ingredient, Recipe};
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{TextInput, Select};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\{CustomPanelLayout, CustomSelect};
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class IngredientsListingResource extends Resource
{
    protected static ?string $model = IngredientsListing::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static string $parentResource = RecipeResource::class; 
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('quantity')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(999),
                Select::make('measure_unit')
                    ->options([
                        'l' => 'l',
                        'ml' => 'ml',
                        'kg' => 'kg',
                        'g' => 'g',
                    ]),
                Select::make('ingredient_name')
                    ->options(Ingredient::all()->pluck('name', 'name'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ingredient_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('quantity'),
                TextColumn::make('measure_unit'),
                TextColumn::make('recipe_title')
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(
                        
                        fn (ListIngredientsListings $livewire, Model $record): string => static::$parentResource::getUrl('ingredients-listings.edit', [
                            'record' => $record,
                            'parent' => $livewire->parent,
                        ])
                    ),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRecipe(?Model $record): string|null|Htmlable
    {
        return $record->title;
    }
}
