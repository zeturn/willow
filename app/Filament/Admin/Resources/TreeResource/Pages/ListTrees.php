<?php

namespace App\Filament\Admin\Resources\TreeResource\Pages;

use App\Filament\Admin\Resources\TreeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrees extends ListRecords
{
    protected static string $resource = TreeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
