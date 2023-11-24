<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{TextInput};
use Filament\Resources\Resource;
use Filament\Resources\IngredientsListingResource;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\CustomPanelLayout;
use Filament\Forms\Components\BelongsTo;
use Filament\Forms\Components\FormContainer;
use App\Filament\Resources\IngredientsListingResource\Pages\{ CreateIngredientsListing, EditIngredientsListing, ListIngredientsListings };
use App\Models\IngredientsListing;
use Filament\Facades\Filament;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getRecordTitle(?Model $record): string|null|Htmlable
    {
        return $record->title;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                CustomPanelLayout::make('Price')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        TextInput::make('price')
                            ->required(),
                        TextInput::make('image_url')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('Manage ingredients listings')
                ->color('success')
                ->icon('heroicon-m-academic-cap')
                ->url(
                    fn (Recipe $record): string => static::getUrl('ingredients-listings.index', [
                        'parent' => $record->id,
                    ])
                ),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),

            'ingredients-listings.index' => ListIngredientsListings::route('/{parent}/ingredients-listings'),
            'ingredients-listings.create' => CreateIngredientsListing::route('/{parent}/ingredients-listings/create'),
            'ingredients-listings.edit' => EditIngredientsListing::route('/{parent}/ingredients-listings/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
