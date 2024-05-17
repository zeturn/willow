<?php

namespace App\Filament\Admin\Resources\EntryBranchResource\Pages;

use App\Filament\Admin\Resources\EntryBranchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntryBranches extends ListRecords
{
    protected static string $resource = EntryBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
