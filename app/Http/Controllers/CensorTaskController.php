<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
use App\Models\DAG;

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
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CensorTask $censorTask)
    {
        //
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
        $tasks = CensorTask::where('entity_type', 'Entry')->where('status', 6)->get();
        return view('censor.entry.entryTaskList', ['tasks' => $tasks]);
    }    

    public function branchTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'EntryBranch')->get();
        return view('censor.branch.branchTaskList', ['tasks' => $tasks]);
    }

    public function versionTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'EntryVersion')->get();
        return view('censor.version.versionTaskList', ['tasks' => $tasks]);
    }

    public function taskTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'EntryVersionTask')->get();
        return view('censor.task.taskTaskList', ['tasks' => $tasks]);
    }

    public function wallTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Wall')->get();
        return view('censor.wall.wallTaskList', ['tasks' => $tasks]);
    }

    public function topicTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Topic')->get();
        return view('censor.topic.topicTaskList', ['tasks' => $tasks]);
    }

    public function commentTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Comment')->get();
        return view('censor.comment.commentTaskList', ['tasks' => $tasks]);
    }

    public function mediaTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Media')->get();
        return view('censor.media.mediaTaskList', ['tasks' => $tasks]);
    }

    public function albumTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Album')->get();
        return view('censor.album.albumTaskList', ['tasks' => $tasks]);
    }

    public function treeTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Tree')->get();
        return view('censor.tree.treeTaskList', ['tasks' => $tasks]);
    }

    public function edgeTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Edge')->get();
        return view('censor.edge.edgeTaskList', ['tasks' => $tasks]);
    }

    public function nodeTaskList()
    {
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

    public function handleEntryTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->changeStatus(10); // 同意
                $task->entry->changeStatus(1101111545);
                break;
            case 'reject':
                $task->changeStatus(4); // 拒绝
                $task->entry->changeStatus(1101111444);
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }

        return back()->with('success', 'Entry task status updated.');
    }

    public function handleBranchTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->branch->changeStatus(1201111545);
                $task->changeStatus(10); // 同意
                break;
            case 'reject':
                $task->branch->changeStatus(1201113474);
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }
        
        return back()->with('success', 'Branch task status updated.');
    }

    public function handleVersionTask(Request $request)
    {
        $id = Crypt::decrypt($request->encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $task->version->changeStatus(1301111545);
                $task->changeStatus(10);; // 同意
                break;
            case 'reject':
                $task->version->changeStatus(1301113474);
                $task->changeStatus(4); // 拒绝
                break;
            case 'wait':
                $task->changeStatus(7); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }

        return back()->with('success', 'Version task status updated.');
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

        return back()->with('success', 'Task task status updated.');
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

        return back()->with('success', 'Wall task status updated.');
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

        return back()->with('success', 'Topic task status updated.');
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

        return back()->with('success', 'Comment task status updated.');
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

        return back()->with('success', 'Media task status updated.');
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

        return back()->with('success', 'Album task status updated.');
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

        return back()->with('success', 'Tree task status updated.');
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

        return back()->with('success', 'Edge task status updated.');
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
        return back()->with('success', 'Node task status updated.');
    }
}
