<?php

namespace App\Filament\Resources\IngredientsListingResource\Pages;

use App\Filament\Resources\IngredientsListingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\RecipeResource;
use App\Filament\Traits\HasParentResource;

class CreateIngredientsListing extends CreateRecord
{
    use HasParentResource;

    protected static string $resource = IngredientsListingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? static::getParentResource()::getUrl('ingredients-listings.index', [
            'parent' => $this->parent,
        ]);
    }
 
    // This can be moved to Trait, but we are keeping it here
    //   to avoid confusion in case you mutate the data yourself
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['recipe_title'] = $this->parent->title;
 
        return $data;
    }
}
