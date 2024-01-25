<?php

namespace App\Http\Controllers;

use App\Models\CensorTask;
use Illuminate\Http\Request;

class CensorTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $tasks = CensorTask::where('entity_type', 'Branch')->get();
        return view('censor.branchTaskList', ['tasks' => $tasks]);
    }

    public function versionTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Version')->get();
        return view('censor.versionTaskList', ['tasks' => $tasks]);
    }

    public function taskTaskList()
    {
        $tasks = CensorTask::where('entity_type', 'Task')->get();
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

}
