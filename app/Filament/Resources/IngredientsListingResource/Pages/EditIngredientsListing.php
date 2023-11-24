<?php

namespace App\Filament\Resources\IngredientsListingResource\Pages;

use App\Filament\Resources\IngredientsListingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\RecipeResource;
use App\Filament\Traits\HasParentResource;

class EditIngredientsListing extends EditRecord
{
    use HasParentResource;

    protected static string $resource = IngredientsListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            // Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? static::getParentResource()::getUrl('ingredients-listings.index', [
            'parent' => $this->parent,
        ]);
    }
 
    protected function configureDeleteAction(Actions\DeleteAction $action): void
    {
        $resource = static::getResource();
 
        $action->authorize($resource::canDelete($this->getRecord()))
            ->successRedirectUrl(static::getParentResource()::getUrl('ingredients-listings.index', [
                'parent' => $this->parent,
            ]));
    }
}
