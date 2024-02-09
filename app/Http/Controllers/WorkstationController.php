<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use App\Models\EntryVersion;
use App\Models\EntryVersionTask;
use App\Models\EntityWallAssociation;

use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

 
class WorkstationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:SuperAdmin|workstation-visit|workstation-edit']);
    }
    /**
     * 每个人的工作站
     * 
     * 登录注册后跳转至此
     * 
     */
    public function index()
    {
        // 检查用户是否登录
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面
            return redirect()->route('login');
        }

        // 获取当前登录用户
        $user = Auth::user();

        /*setPermissionsTeamId($user->current_team_id);

        $roles = $user->getRoleNames();
        $session_team_id = getPermissionsTeamId();
        $current_team = $user->currentTeam;

        $role = Role::where('name', 'User')->firstOrFail();

        $hasper = $role->hasPermissionTo('workstation-visit');

        dd($roles, $session_team_id,$current_team,$hasper);*/
        // 加载用户相关资产
        $branches = $user->branches;
        $versions = $user->versions;
        $versionTasks = $user->versiontasks;
        $topics = $user->topics;
        $comments = $user->comments;
        $medias = $user->medias;
        $albums = $user->albums;

        // 传递数据到视图
        return view('workstation.index', [
            'user' => $user,
            'branches' => $branches,
            'versions' => $versions,
            'versionTasks' => $versionTasks,
            'topics' => $topics,
            'comments' => $comments,
            'medias' => $medias,
            'albums' => $albums,
        ]);
    }
    
}
