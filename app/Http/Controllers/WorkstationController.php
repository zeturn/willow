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

use Illuminate\Support\Facades\Redis;

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

        // 定义 Redis 键名
        $key = 'entry_trend';

        // 尝试从 Redis 获取数据
        $trend_entries = Redis::get($key);

        // 如果 Redis 中没有数据
        if (!$trend_entries) {
            // 获取热榜数据
            $trend_entries = visits('App\Models\Entry')->top(20);

            // 将数据转换为 JSON 并存储到 Redis，设置过期时间为 10 分钟
            Redis::setex($key, 600, json_encode($trend_entries));
        } else {
            // 如果 Redis 中有数据，则解码 JSON
            $trend_entries = json_decode($trend_entries);
        }

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
            'trend_entries' => $trend_entries,
        ]);
    }

    public function entry_branch_events(){
        // 检查用户是否登录
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面
            return redirect()->route('login');
        }

        // 获取当前登录用户
        $user = Auth::user();

        // 加载用户相关资产
        $branches = $user->branches()->paginate(15);

        // 传递数据到视图
        return view('workstation.entry-branch-events', [
            'user' => $user,
            'branches' => $branches,
            'pagename' => 'entry_branch_events',
        ]);
    }

    public function entry_version_events(){
        // 检查用户是否登录
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面
            return redirect()->route('login');
        }

        // 获取当前登录用户
        $user = Auth::user();

        // 加载用户相关资产
        $versions = $user->versions()->paginate(15);

        // 传递数据到视图
        return view('workstation.entry-version-events', [
            'user' => $user,
            'versions' => $versions,
            'pagename' => 'entry_version_events',
        ]);
    }

    public function topic_events(){
        // 检查用户是否登录
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面
            return redirect()->route('login');
        }

        // 获取当前登录用户
        $user = Auth::user();

        // 加载用户相关资产
        $topics = $user->topics()->paginate(15);

        // 传递数据到视图
        return view('workstation.topic-events', [
            'user' => $user,
            'topics' => $topics,
            'pagename' => 'topic_events',
        ]);
    }

    public function comment_events(){
        // 检查用户是否登录
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面
            return redirect()->route('login');
        }

        // 获取当前登录用户
        $user = Auth::user();
        
        $comments = $user->comments()->paginate(15);

        // 传递数据到视图
        return view('workstation.comment-events', [
            'user' => $user,
            'comments' => $comments,
            'pagename' => 'comment_events',
        ]);
    }

    public function entry_version_task_events(){
        // 检查用户是否登录
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面
            return redirect()->route('login');
        }

        // 获取当前登录用户
        $user = Auth::user();

        // 加载用户相关资产
        $versionTasks = $user->versiontasks()->paginate(15);

        // 传递数据到视图
        return view('workstation.entry-version-task-events', [
            'user' => $user,
            'versionTasks' => $versionTasks,
            'pagename' => 'entry_version_task_events',
        ]);
    }

    public function censor_task_events(){
        // 检查用户是否登录
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面
            return redirect()->route('login');
        }

        // 获取当前登录用户
        $user = Auth::user();

        // 传递数据到视图
        return view('workstation.cesor-task-events', [
            'user' => $user,
        ]);
        
    }
}