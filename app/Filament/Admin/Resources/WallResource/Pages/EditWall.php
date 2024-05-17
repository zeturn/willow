<?php

namespace App\Filament\Admin\Resources\WallResource\Pages;

use App\Filament\Admin\Resources\WallResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWall extends EditRecord
{
    protected static string $resource = WallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
