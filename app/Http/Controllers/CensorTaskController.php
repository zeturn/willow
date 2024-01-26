<?php

namespace App\Http\Controllers;

use App\Models\CensorTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
    
    public function entryTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Entry')->get();
        return view('censor.entryTaskList', ['tasks' => $tasks]);
    }

    public function branchTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'EntryBranch')->get();
        return view('censor.branchTaskList', ['tasks' => $tasks]);
    }

    public function versionTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'EntryVersion')->get();
        return view('censor.versionTaskList', ['tasks' => $tasks]);
    }

    public function taskTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'EntryVersionTask')->get();
        return view('censor.taskTaskList', ['tasks' => $tasks]);
    }

    public function wallTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Wall')->get();
        return view('censor.wallTaskList', ['tasks' => $tasks]);
    }

    public function topicTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Topic')->get();
        return view('censor.topicTaskList', ['tasks' => $tasks]);
    }

    public function commentTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Comment')->get();
        return view('censor.commentTaskList', ['tasks' => $tasks]);
    }

    public function mediaTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Media')->get();
        return view('censor.mediaTaskList', ['tasks' => $tasks]);
    }

    public function albumTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Album')->get();
        return view('censor.albumTaskList', ['tasks' => $tasks]);
    }

    public function treeTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Tree')->get();
        return view('censor.treeTaskList', ['tasks' => $tasks]);
    }

    public function edgeTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Edge')->get();
        return view('censor.edgeTaskList', ['tasks' => $tasks]);
    }

    public function nodeTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Node')->get();
        return view('censor.nodeTaskList', ['tasks' => $tasks]);
    }

    //审核方法

    public function entryTask($id)
    {
        $task = CensorTask::where('entity_type', 'Entry')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.entryCheck', compact('task', 'encryptedId'));
    }

    public function branchTask($id)
    {
        $task = CensorTask::where('entity_type', 'EntryBranch')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.branchCheck', compact('task', 'encryptedId'));
    }

    public function versionTask($id)
    {
        $task = CensorTask::where('entity_type', 'EntryVersion')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.versionCheck', compact('task', 'encryptedId'));
    }

    public function taskTask($id)
    {
        $task = CensorTask::where('entity_type', 'EntryVersionTask')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.taskCheck', compact('task', 'encryptedId'));
    }

    public function wallTask($id)
    {
        $task = CensorTask::where('entity_type', 'Wall')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.wallCheck', compact('task', 'encryptedId'));
    }

    public function topicTask($id)
    {
        $task = CensorTask::where('entity_type', 'Topic')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.topicCheck', compact('task', 'encryptedId'));
    }

    public function commentTask($id)
    {
        $task = CensorTask::where('entity_type', 'Comment')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.commentCheck', compact('task', 'encryptedId'));
    }

    public function mediaTask($id)
    {
        $task = CensorTask::where('entity_type', 'Media')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        $media = $task->media;
        return view('censor.mediaCheck', compact('task', 'encryptedId','media'));
    }

    public function albumTask($id)
    {
        $task = CensorTask::where('entity_type', 'Album')->findOrFail($id);
        $album = $task->album;
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.albumCheck', compact('task', 'encryptedId','album'));
    }

    public function treeTask($id)
    {
        $task = CensorTask::where('entity_type', 'Tree')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.treeCheck', compact('task', 'encryptedId'));
    }

    public function edgeTask($id)
    {
        $task = CensorTask::where('entity_type', 'Edge')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.edgeCheck', compact('task', 'encryptedId'));
    }

    public function nodeTask($id)
    {
        $task = CensorTask::where('entity_type', 'Node')->findOrFail($id);
        $encryptedId = Crypt::encrypt($task->id);
        return view('censor.nodeCheck', compact('task', 'encryptedId'));
    }
    //执行区

    private function updateTaskStatus($encryptedId, $action)
    {
        $id = Crypt::decrypt($encryptedId);
        $task = CensorTask::findOrFail($id);

        switch ($action) {
            case 'approve':
                $task->status = 6; // 同意
                break;
            case 'reject':
                $task->status = 4; // 拒绝
                break;
            case 'wait':
                $task->status = 3; // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }

        $task->save();

        return $task;
    }

    public function handleEntryTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Entry task status updated.');
    }

    public function handleBranchTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Branch task status updated.');
    }

    public function handleVersionTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Version task status updated.');
    }

    public function handleTaskTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Task task status updated.');
    }

    public function handleWallTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Wall task status updated.');
    }

    public function handleTopicTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Topic task status updated.');
    }

    public function handleCommentTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Comment task status updated.');
    }

    public function handleMediaTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Media task status updated.');
    }

    public function handleAlbumTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Album task status updated.');
    }

    public function handleTreeTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Tree task status updated.');
    }

    public function handleEdgeTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Edge task status updated.');
    }

    public function handleNodeTask(Request $request)
    {
        $task = $this->updateTaskStatus($request->encryptedId, $request->action);
        return back()->with('success', 'Node task status updated.');
    }
}
