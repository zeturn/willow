<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;
use App\Models\Permission;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 插入指定用户
        $user = User::create([
            'id' => '62662626-6662-6626-2666-262662626226',
            'name' => 'Henry',
            'email' => 'zhr626@outlook.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        // 确保"User"角色存在
        $roleUser = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $user->assignRole($roleUser);

        // 为指定用户创建团队
        $this->createTeam($user);
        // 确保"User"角色存在
        $roleUser = Role::firstOrCreate(['name' => 'User']);

        // 创建 50 个随机用户
        User::factory()->count(200)->create()->each(function ($user) {
            $this->createTeam($user);
            $this->assignRole($roleUser);
        });
    }

    /**
     * 为指定用户创建团队
     *
     * @param \App\Models\User $user
     */
    protected function createTeam($user)
    {
        $user->ownedTeams()->save(new Team([
            'name' => $user->name . "'s Team",
            'user_id' => $user->id,
            'personal_team' => true,
        ]));
    }
}

//php artisan db:seed --class=UserSeeder