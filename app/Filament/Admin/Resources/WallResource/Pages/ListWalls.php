<?php

namespace App\Filament\Admin\Resources\WallResource\Pages;

use App\Filament\Admin\Resources\WallResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWalls extends ListRecords
{
    protected static string $resource = WallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
