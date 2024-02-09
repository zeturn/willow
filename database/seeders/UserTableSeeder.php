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
use Illuminate\Support\Facades\Artisan;

class UserTableSeeder extends Seeder
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
            'email_verified_at' => now(),
        ]);

        // 创建或确保角色存在
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'SuperAdmin', 'team_id' => null]);
        $roleUser = Role::firstOrCreate(['name' => 'User', 'team_id' => null]);


        //dd($roleSuperAdmin);
        // 为指定用户创建团队并分配"SuperAdmin"角色
        $team = $this->createTeam($user); // 接收返回的团队实例
        setPermissionsTeamId($team->id);
        $user->switchTeam($team);
        $user->assignRole($roleSuperAdmin); // 在分配角色时指定团队 ID

        // 创建 200 个随机用户
        User::factory()->count(100)->create()->each(function ($user) use ($roleUser) {
            $team = $this->createTeam($user); // 为每个用户创建团队
            setPermissionsTeamId($team->id);
            $user->switchTeam($team);
            $user->assignRole($roleUser); // 在分配角色时指定团队 ID
        });
    }

    /**
     * 为指定用户创建团队
     *
     * @param \App\Models\User $user
     */
    protected function createTeam($user)
    {
        $team = $user->ownedTeams()->save(new Team([
            'name' => $user->name . "'s Team",
            'user_id' => $user->id,
            'personal_team' => true,
        ]));
    
        return $team; // 返回创建的团队实例
    }
}
//php artisan db:seed --class=UserSeeder