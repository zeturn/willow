<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * 运行数据库填充。
     *
     * @return void
     */
    public function run()
    {
        // 定义权限列表
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            // 工作站权限
            'workstation-visit',
            'workstation-edit',

            // 条目权限
            'entry-create',
            'entry-edit',
            'entry-soft-delete',
            'entry-delete',
            'entry-censor',

            // 条目分支权限
            'entry-branch-create',
            'entry-branch-edit',
            'entry-branch-soft-delete',
            'entry-branch-delete',
            'entry-branch-censor',

            // 条目版本权限
            'entry-version-create',
            'entry-version-edit',
            'entry-version-soft-delete',
            'entry-version-delete',
            'entry-version-censor',

            // 讨论wall区权限
            'wall-index',
            'wall-create',
            'wall-edit',
            'wall-delete-soft-delete',
            'wall-delete',
            'wall-censor',


            // 讨论topic区权限
            'topic-index',
            'topic-create',
            'topic-edit',
            'topic-delete-soft-delete',
            'topic-delete',
            'topic-censor',

            // 讨论comment区权限
            'comment-index',
            'comment-create',
            'comment-edit',
            'comment-delete-soft-delete',
            'comment-delete',
            'comment-censor',

            // 媒体相册album区权限
            'album-index',
            'album-create',
            'album-edit',
            'album-delete-soft-delete',
            'album-delete',
            'album-censor',

            // 媒体media区权限
            'media-index',
            'media-create',
            'media-edit',
            'media-delete-soft-delete',
            'media-delete',
            'media-censor',

            // censor权限
            'censor-index',
            'censor-list',
            'censor-create',
            'censor-edit',
            'censor-delete'
        ];

        

        // 创建权限
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 创建超级管理员角色并赋予权限
        $roleSuperAdmin = Role::create(['name' => 'SuperAdmin', 'team_id' => null]);
        $permissions = Permission::pluck('uuid','uuid')->all();
        $roleSuperAdmin->syncPermissions($permissions);

        // 创建普通用户角色并赋予特定权限
        $roleUser = Role::create(['name' => 'User', 'team_id' => null]);
        $roleUser -> givePermissionTo('workstation-visit');
        $roleUser -> givePermissionTo('workstation-edit');

    }
}
