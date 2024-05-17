<?php

namespace App\Filament\Admin\Resources\EdgeResource\Pages;

use App\Filament\Admin\Resources\EdgeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEdges extends ListRecords
{
    protected static string $resource = EdgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
