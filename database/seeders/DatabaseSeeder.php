<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
        
        public function run()
        {
            // 结束计时
            $start = microtime(true);
            // 执行 migrate 命令
            Artisan::call('migrate:refresh');

            // 运行 Seeder
            Artisan::call('db:seed', ['--class' => 'PermissionTableSeeder']);//生成权限
            Artisan::call('db:seed', ['--class' => 'UserTableSeeder']);//生成角色

            Artisan::call('db:seed', ['--class' => 'EntrySeeder']);//生成初始墙

            Artisan::call('db:seed', ['--class' => 'DiscussSeeder']);//生成初始墙

            Artisan::call('db:seed', ['--class' => 'TreeTableSeeder']);//生成root节点
            Artisan::call('db:seed', ['--class' => 'NodesTableSeeder']);//生成Node节点
            Artisan::call('db:seed', ['--class' => 'EdgesTableSeeder']);//生成Edge边

            Artisan::call('db:seed', ['--class' => 'CategoryEntityAssociationsTableSeeder']);//生成分类-词条链接


            // 执行 route:cache 命令
            Artisan::call('route:cache');

            // 清除缓存
            Artisan::call('cache:clear');

            // 结束计时
            $end = microtime(true);

            // 计算所需时间（毫秒）
            $executionTime = round(($end - $start) * 1000, 2);

            // 输出所需时间到终端
            echo '全部任务在 ' . $executionTime . ' ms 内完成填充' . PHP_EOL;
        }
    
}
//php artisan db:seed --class=DatabaseSeeder