<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\User;
use App\Models\Team;

use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryVersion;

use App\Models\Wall;
use App\Models\Topic;
use App\Models\Comment;

class StatsOverview extends BaseWidget
{
    # 刷新时间：15秒
    protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [


            Stat::make('User Count', User::count())
                ->description('Total users')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Team Count', Team::count())
                ->description('Total teams')
                ->color('success'),

            Stat::make('Entry Count', Entry::count())
                ->description('Total entries')
                ->color('success'),
            Stat::make('Entry Branch Count', EntryBranch::count())
                ->description('Total branches')
                ->color('success'),
            Stat::make('Entry Version Count', EntryVersion::count())
                ->description('Total versions')
                ->color('success'),


            Stat::make('Wall Count', Wall::count())
                ->description('Total walls')
                ->color('success'),
            Stat::make('Topic Count', Topic::count())
                ->description('Total Topics')
                ->color('success'),
            Stat::make('Comment Count', Comment::count())
                ->description('Total comments')
                ->color('success'),
        ];
    }
}
