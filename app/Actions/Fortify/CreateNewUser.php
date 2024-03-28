<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        //使用session创建提示
        session()->flash('message','欢迎！');

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $team = $this->createTeam($user); // 接收返回的团队实例
                setPermissionsTeamId($team->id);
                $user->switchTeam($team);
                $roleUser = Role::firstOrCreate(['name' => 'User', 'team_id' => null]);
                $user->assignRole($roleUser); // 在分配角色时指定团队 ID


                // 创建EmailVerification对象
                $emailVerification = new EmailVerification;
                $emailVerification->user_id =$user->id;
                $emailVerification->verification_key = rand(100000, 999999); // 生成一个随机密钥
                $emailVerification->verification_type = 3; // 指定验证类型 3.六位数字
                $emailVerification->action_type = 0; //动作类型 0.注册 1.修改邮箱
                $emailVerification->save();
                $emailVerification->sendVerificationEmail(); // 发送验证邮件
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): Team
    {
        $team = $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));

        return $team; // 返回创建的团队实例
    }
}
