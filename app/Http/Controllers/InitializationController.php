<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InitializationController extends Controller
{
    public function index()
    {
        return view('initialization.index');
    }

    public function runInitialization(Request $request)
    {
        $password = $request->input('password');

        // 检查密码是否正确
        if ($password !== 'password') {
            return redirect()->back()->withErrors('密钥错误！');
        }

        // 执行 migrate 命令
        Artisan::call('migrate');

        // 执行 migrate 命令
        Artisan::call('migrate:refresh');

        // 运行 Seeder
        Artisan::call('db:seed', ['--class' => 'PermissionTableSeeder']);//生成权限
        Artisan::call('db:seed', ['--class' => 'UserTableSeeder']);//生成角色

        Artisan::call('db:seed', ['--class' => 'EntryTableSeeder']);//生成初始墙

        Artisan::call('db:seed', ['--class' => 'DiscussTableSeeder']);//生成初始墙

        Artisan::call('db:seed', ['--class' => 'TreeTableSeeder']);//生成root节点
        Artisan::call('db:seed', ['--class' => 'NodesTableSeeder']);//生成Node节点
        Artisan::call('db:seed', ['--class' => 'EdgesTableSeeder']);//生成Edge边

        Artisan::call('db:seed', ['--class' => 'CategoryEntityAssociationsTableSeeder']);//生成分类-词条链接


        // 执行 route:cache 命令
        Artisan::call('route:cache');

        // 清除缓存
        Artisan::call('cache:clear');

        // 返回成功消息
        return redirect()->back()->with('success', '初始化完成！');
    }

    public function runArtificialData(Request $request)
    {
        $password = $request->input('password');

        // 检查密码是否正确
        if ($password !== 'password') {
            return redirect()->back()->withErrors('密钥错误！');
        }

        // 运行 Seeder
        Artisan::call('db:seed', ['--class' => 'PostsTableSeeder']);//生成帖子
        Artisan::call('db:seed', ['--class' => 'CommentsTableSeeder']);//生成评论

        // 返回成功消息
        return redirect()->back()->with('success', '数据填充完成！');
    }
}
