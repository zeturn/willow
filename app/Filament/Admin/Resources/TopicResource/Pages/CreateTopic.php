<?php

namespace App\Filament\Admin\Resources\TopicResource\Pages;

use App\Filament\Admin\Resources\TopicResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTopic extends CreateRecord
{
    protected static string $resource = TopicResource::class;
}
