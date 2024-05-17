<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;


class HelloUser extends Widget
{
    protected static string $view = 'filament.admin.widgets.hello-user';

    protected int | string | array $columnSpan = '2';

    #获取用户名称以及当前时间，返回给视图
    public function data()
    {
        return [
            'user' => auth()->user(),
            'time' => now(),
        ];
    }
}
