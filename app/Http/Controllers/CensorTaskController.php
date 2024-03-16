<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\Models\CensorTask;
use App\Models\User;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use App\Models\EntryVersion;
use App\Models\EntryVersionTask;
use App\Models\EntityWallAssociation;

use App\Models\Tree;
use App\Models\Node;
use App\Models\Edge;
use App\Models\DCG;

use App\Models\Wall;
use App\Models\Topic;
use App\Models\Comment;

use App\Models\Album;
use App\Models\Media;
use App\Models\AlbumsMediaAssociation;

class CensorTaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:censor-index|censor-list|censor-create|censor-edit|censor-delete', ['only' => ['index','show']]);
         $this->middleware('permission:censor-create', ['only' => ['create','store']]);
         $this->middleware('permission:censor-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:censor-delete', ['only' => ['destroy']]);


         $this->middleware('permission:entry-censor', ['only' => ['entryTaskList', 'entryTask', 'handleEntryTask']]);
         $this->middleware('permission:entry-branch-censor', ['only' => ['branchTaskList', 'branchTask', 'handleBranchTask']]);
         $this->middleware('permission:entry-version-censor', ['only' => ['versionTaskList','versionTask','handleVersionTask']]);
         $this->middleware('permission:wall-censor', ['only' => ['wallTaskList', 'wallTask', 'handleWallTask']]);
         $this->middleware('permission:topic-censor', ['only' => ['topicTaskList', 'topicTask', 'handleTopicTask']]);
         $this->middleware('permission:comment-censor', ['only' => ['commentTaskList', 'commentTask', 'handleCommentTask']]);
         $this->middleware('permission:album-censor', ['only' => ['albumTaskList', 'albumTask', 'handleAlbumTask']]);
         $this->middleware('permission:media-censor', ['only' => ['mediaTaskList', 'mediaTask', 'handleMediaTask']]);
         $this->middleware('permission:tree-censor', ['only' => ['treeTaskList', 'treeTask', 'handleTreeTask']]);
         $this->middleware('permission:node-censor', ['only' => ['nodeTaskList', 'nodeTask', 'handleNodeTask']]);
         $this->middleware('permission:edge-censor', ['only' => ['edgeTaskList', 'edgeTask', 'handleEdgeTask']]);


    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('censor.index');
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('censor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CensorTask $censorTask)
    {
        return view('censor.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CensorTask $censorTask)
    {
        return view('censor.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CensorTask $censorTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CensorTask $censorTask)
    {
        //
    }
    
    /**
    *--------------------------
    * 任务列表
    *--------------------------
    */
    public function entryTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Entry')->where('status', 6)->orWhere('status', 7)->get();
        return view('censor.entry.entryTaskList', ['tasks' => $tasks]);
    }    

    public function branchTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'EntryBranch')->where('status', 6)->orWhere('status', 7)->get();
        return view('censor.branch.branchTaskList', ['tasks' => $tasks]);
    }

    public function versionTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'EntryVersion')->where('status', 6)->orWhere('status', 7)->get();
        return view('censor.version.versionTaskList', ['tasks' => $tasks]);
    }

    public function taskTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'EntryVersionTask')->get();
        return view('censor.task.taskTaskList', ['tasks' => $tasks]);
    }

    public function wallTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Wall')->get();
        return view('censor.wall.wallTaskList', ['tasks' => $tasks]);
    }

    public function topicTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Topic')->get();
        return view('censor.topic.topicTaskList', ['tasks' => $tasks]);
    }

    public function commentTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Comment')->get();
        return view('censor.comment.commentTaskList', ['tasks' => $tasks]);
    }

    public function mediaTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Media')->get();
        return view('censor.media.mediaTaskList', ['tasks' => $tasks]);
    }

    public function albumTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Album')->get();
        return view('censor.album.albumTaskList', ['tasks' => $tasks]);
    }

    public function treeTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Tree')->get();
        return view('censor.tree.treeTaskList', ['tasks' => $tasks]);
    }

    public function edgeTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Edge')->get();
        return view('censor.edge.edgeTaskList', ['tasks' => $tasks]);
    }

    public function nodeTaskList()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        $tasks = CensorTask::where('entity_type', 'Node')->get();
        return view('censor.node.nodeTaskList', ['tasks' => $tasks]);
    }

    /**
    *--------------------------
    * 审核页面
    *--------------------------
    */

    public function entryTask($id)
    {
        $task = CensorTask::where('entity_type', 'Entry')->orderBy('created_at', 'asc')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.entry.entryCheck', compact('task', 'encryptedId'));
    }

    public function branchTask($id)
    {
        $task = CensorTask::where('entity_type', 'EntryBranch')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.branch.branchCheck', compact('task', 'encryptedId'));
    }

    public function versionTask($id)
    {
        $task = CensorTask::where('entity_type', 'EntryVersion')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.version.versionCheck', compact('task', 'encryptedId'));
    }

    public function taskTask($id)
    {
        $task = CensorTask::where('entity_type', 'EntryVersionTask')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.task.taskCheck', compact('task', 'encryptedId'));
    }

    public function wallTask($id)
    {
        $task = CensorTask::where('entity_type', 'Wall')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.wall.wallCheck', compact('task', 'encryptedId'));
    }

    public function topicTask($id)
    {
        $task = CensorTask::where('entity_type', 'Topic')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.topic.topicCheck', compact('task', 'encryptedId'));
    }

    public function commentTask($id)
    {
        $task = CensorTask::where('entity_type', 'Comment')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.comment.commentCheck', compact('task', 'encryptedId'));
    }

    public function mediaTask($id)
    {
        $task = CensorTask::where('entity_type', 'Media')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        $media = $task->media;
        return view('censor.media.mediaCheck', compact('task', 'encryptedId','media'));
    }

    public function albumTask($id)
    {
        $task = CensorTask::where('entity_type', 'Album')->findOrFail($id);
        $album = $task->album;
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.album.albumCheck', compact('task', 'encryptedId','album'));
    }

    public function treeTask($id)
    {
        $task = CensorTask::where('entity_type', 'Tree')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.tree.treeCheck', compact('task', 'encryptedId'));
    }

    public function edgeTask($id)
    {
        $task = CensorTask::where('entity_type', 'Edge')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.edge.edgeCheck', compact('task', 'encryptedId'));
    }

    public function nodeTask($id)
    {
        $task = CensorTask::where('entity_type', 'Node')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.node.nodeCheck', compact('task', 'encryptedId'));
    }
    
    /**
    *--------------------------
    * 审核执行
    *--------------------------
    */

    /**
     * 处理词条任务。
     * Handle the entry task based on the action provided.
     * 此方法首先确认用户是否登录，然后尝试解密请求中的加密ID，并根据提供的动作更新任务状态。
     * This method first ensures the user is authenticated, attempts to decrypt the encrypted ID in the request, and updates the task status based on the provided action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleEntryTask(Request $request)
    {
        // 确认用户是否登录 / Ensure the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，则重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Ensure the 'login' route is defined in your routes file
        }

        try {
            // 尝试解密请求中的加密ID / Attempt to decrypt the encrypted ID in the request
            $id = Crypt::decrypt($request->encryptedId);
        } catch (Exception $e) {
            // 解密失败，返回错误信息 / Decryption failed, return with an error message
            return back()->with('error', 'Invalid task identifier.');
        }

        // 尝试找到对应的任务，如果不存在则返回错误 / Attempt to find the corresponding task, return an error if not found
        $task = CensorTask::find($id);
        if (!$task) {
            return back()->with('error', 'Task not found.');
        }

        // 根据请求中的动作更新任务状态 / Update the task status based on the action in the request
        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意 / Approve
                $task->entry->changeStatus(1101111545);
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝 / Reject
                $task->entry->changeStatus(1101111444);
                break;
            case 'wait':
                $task->changeStatus(7); // 等待 / Wait
                break;
            default:
                // 处理未知操作 / Handle unknown actions
                return back()->with('error', 'Invalid action.');
        }

        //使用session创建提示
        session()->flash('message','审核操作成功！');

        // 返回成功消息 / Return with a success message
        return redirect()->route('censor.tasks.list.entry');
    }

    /**
     * 处理分支任务。
     * Handle the branch task based on the action provided.
     * 此方法确保用户已经登录，并且对加密ID解密、查找任务、以及更新任务状态进行了异常处理和验证。
     * This method ensures the user is authenticated, and adds exception handling and validation for decrypting ID, finding tasks, and updating task status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleBranchTask(Request $request)
    {
        // 确认用户是否已经登录 / Ensure the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，则重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Ensure the 'login' route is defined in your routes file
        }

        try {
            // 尝试解密请求中的加密ID / Attempt to decrypt the encrypted ID in the request
            $id = Crypt::decrypt($request->encryptedId);
        } catch (Exception $e) {
            // 解密失败，返回错误信息 / Decryption failed, return with an error message
            return back()->with('error', 'Invalid task identifier.');
        }

        // 尝试找到对应的任务，如果不存在则返回错误 / Attempt to find the corresponding task, return an error if not found
        $task = CensorTask::find($id);
        if (!$task) {
            return back()->with('error', 'Task not found.');
        }

        // 根据请求中的动作更新任务和分支的状态 / Update the task and branch status based on the action in the request
        switch ($request->action) {
            case 'approve':
                $task->branch->changeStatus(1201111545);
                $task->changeStatus(10); // 同意 / Approve
                break;
            case 'reject':
                $task->branch->changeStatus(1201113474);
                $task->changeStatus(4); // 拒绝 / Reject
                break;
            case 'wait':
                $task->changeStatus(7); // 等待 / Wait
                break;
            default:
                // 处理未知操作 / Handle unknown actions
                return back()->with('error', 'Invalid action.');
        }

        //使用session创建提示
        session()->flash('message','审核操作成功！');

        // 返回成功消息 / Return with a success message
        return redirect()->route('censor.tasks.list.branch');
    }

    /**
     * 处理版本任务。
     * Handle the version task based on the action provided.
     * 此方法首先确认用户是否登录，然后尝试解密请求中的加密ID，并根据提供的动作更新版本任务状态。
     * This method first ensures the user is authenticated, attempts to decrypt the encrypted ID in the request, and updates the version task status based on the provided action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleVersionTask(Request $request)
    {
        // 确认用户是否登录 / Ensure the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，则重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Ensure the 'login' route is defined in your routes file
        }

        try {
            // 尝试解密请求中的加密ID / Attempt to decrypt the encrypted ID in the request
            $id = Crypt::decrypt($request->encryptedId);
        } catch (Exception $e) {
            // 解密失败，返回错误信息 / Decryption failed, return with an error message
            return back()->with('error', 'Invalid task identifier.');
        }

        // 通过ID查找任务，如果未找到则自动抛出异常 / Find the task by ID, automatically throws an exception if not found
        $task = CensorTask::findOrFail($id);

        // 根据请求中的动作更新任务状态 / Update the task status based on the action in the request
        switch ($request->action) {
            case 'approve':
                $task->version->changeStatus(1301111545); // 同意版本变更 / Approve version change
                $task->changeStatus(10); // 同意 / Approve
                break;
            case 'reject':
                $task->version->changeStatus(1301113474); // 拒绝版本变更 / Reject version change
                $task->changeStatus(4); // 拒绝 / Reject

                $version = $task->version;

                $versionId = $version->id;
                //dd($versionId);

                // 使用 EntryVersionTask 类来查找匹配的条目
                $entryVersionTask = EntryVersionTask::where('version_id',$versionId)
                    ->withTrashed() // 包含软删除的记录
                    ->first();

            //dd($entryVersionTask);
                // 如果找到匹配的条目并且它已经被软删除
                if ($entryVersionTask &&$entryVersionTask->trashed()) {
                    // 尝试恢复软删除的条目
                    $entryVersionTask->restore();
                    $entryVersionTask->status=1401113466;
                    $entryVersionTask->save();

                    $version->status = 1101113474;
                    $version->save();
                }
                break;
            case 'wait':
                $task->changeStatus(7); // 等待 / Wait
                break;
            default:
                // 处理未知操作，返回错误消息 / Handle unknown actions, return with an error message
                return back()->with('error', 'Invalid action.');
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');

        // 返回成功消息 / Return with a success message
        return redirect()->route('censor.tasks.list.version');
    } 

    public function handleTaskTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }

    public function handleWallTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }

    public function handleTopicTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }

    public function handleCommentTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }

    public function handleMediaTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7);// 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }

    public function handleAlbumTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }

    public function handleTreeTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }

    public function handleEdgeTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }

    public function handleNodeTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->changeStatus(7); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        //使用session创建提示
        session()->flash('message','审核操作成功！');
        return back();
    }
}
