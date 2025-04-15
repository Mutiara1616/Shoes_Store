<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('recycle_bin')
                ->label('Recycle Bin')
                ->url(static::$resource::getUrl('recycle-bin'))
                ->icon('heroicon-o-trash')
                ->color('warning'),
        ];
    }
}
