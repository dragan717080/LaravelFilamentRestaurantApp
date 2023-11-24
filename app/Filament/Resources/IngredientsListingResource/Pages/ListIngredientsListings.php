<?php

namespace App\Filament\Resources\IngredientsListingResource\Pages;
use App\Filament\Resources\RecipeResource;
use App\Filament\Traits\HasParentResource;
use App\Filament\Resources\IngredientsListingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIngredientsListings extends ListRecords
{
    use HasParentResource;

    protected static string $resource = IngredientsListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->url(
                    fn (): string => static::getParentResource()::getUrl('ingredients-listings.create', [
                        'parent' => $this->parent,
                    ])
                ),
        ];
    }
}
