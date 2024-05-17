<?php

namespace App\Filament\Admin\Resources\EntryVersionResource\Pages;

use App\Filament\Admin\Resources\EntryVersionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntryVersion extends EditRecord
{
    protected static string $resource = EntryVersionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
