<?php

namespace App\Filament\Admin\Resources\EntryBranchResource\Pages;

use App\Filament\Admin\Resources\EntryBranchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntryBranch extends EditRecord
{
    protected static string $resource = EntryBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
