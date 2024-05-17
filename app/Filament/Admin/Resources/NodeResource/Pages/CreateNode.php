<?php

namespace App\Filament\Admin\Resources\NodeResource\Pages;

use App\Filament\Admin\Resources\NodeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNode extends CreateRecord
{
    protected static string $resource = NodeResource::class;
}
