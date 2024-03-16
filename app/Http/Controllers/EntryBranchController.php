<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryVersion;
use App\Models\EntryBranchUser;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EntryBranchController extends Controller
{

    /**
     * 显示分支
     *
     * 
     * @param int $branchId
     * @return \Illuminate\View\View
     */

    public function show($branchId)
    {
        $branch = EntryBranch::findOrFail($branchId);//关联的分支

        $versions = $branch->versions;//下属版本

        $demoVersion = $branch->demoVersion; // 获取与 demo_version_id 匹配的版本

        $walls = $branch->walls;//关联的walls



        return view('entries.branches.show',  [
            'branch' => $branch,
            'versions' => $versions,
            'demoVersion' => $demoVersion,
            'walls' => $walls,
        ]);
    }

    public function showDemoVersion($id){


        $branch = EntryBranch::findOrFail($id);

        $demoversion = $branch->demoVersion;
        
        return view('entries.branches.show.show-demo-version', [
            'branch' => $branch,
            'demoversion' => $demoversion,
        ]);
    }

    public function showVersionList($id){

        $branch = EntryBranch::findOrFail($id);
        
        $versions = $branch->versions;

        return view('entries.branches.show.show-version-list', [
            'branch' => $branch,
            'versions' => $versions,
        ]);

    }

    public function showInfo($id){

        $branch = EntryBranch::findOrFail($id);
        
        return view('entries.branches.show.show-info', [
            'branch' => $branch,
        ]);

    }

    public function showEditors($id){

        $branch = EntryBranch::findOrFail($id);

        $owner = $branch->owner;

        $editors = $branch->users;

        //dd($owner,$editors);
        return view('entries.branches.show.show-editors', [
            'branch' => $branch,
            'owner' => $owner,
            'editors' => $editors,
        ]);

    }

    public function showControl($id){

        $branch = EntryBranch::findOrFail($id);

        $owner = $branch->owner;

        $editors = $branch->users;

        return view('entries.branches.show.control.control', [
            'branch' => $branch,
            'owner' => $owner,
            'editors' => $editors,
        ]);

    }

    /**
     * ----------------------------------
     * control 功能区
     */
    public function pushRequests($id){

        $branch = EntryBranch::findOrFail($id);

        // 检查当前用户是否拥有访问分支的权限
        if ($branch->owner->id !== Auth::id()) {
            // 如果没有权限，则返回403 Forbidden响应
            abort(403);
        }

        $versionsforreview = $branch->versionsforreview; 

        return view('entries.branches.show.control.push-requests', [
            'branch' => $branch,
            'versionsforreview' => $versionsforreview,
        ]);

    }
    public function EditorGroup($id){

        $branch = EntryBranch::findOrFail($id);

        // 检查当前用户是否拥有访问分支的权限
        if ($branch->owner->id !== Auth::id()) {
            // 如果没有权限，则返回403 Forbidden响应
            abort(403);
        }

        $branchId = $branch->id;

        $owner = $branch->owner;

        $editors = $branch->users;

        return view('entries.branches.show.control.editor-group', [
            'branch' => $branch,
            'branchId' => $branchId,
            'owner' => $owner,
            'editors' => $editors,
        ]);

    }
    
    public function VersionList($id){

        $branch = EntryBranch::findOrFail($id);

        // 检查当前用户是否拥有访问分支的权限
        if ($branch->owner->id !== Auth::id()) {
            // 如果没有权限，则返回403 Forbidden响应
            abort(403);
        }
        
        $versions = $branch->versions;

        return view('entries.branches.show.control.version-list', [
            'branch' => $branch,
            'branch' => $branch,
            'versions' => $versions,
        ]);

    }
    public function GenreralSetting($id){

        $branch = EntryBranch::findOrFail($id);
        
        // 检查当前用户是否拥有访问分支的权限
        if ($branch->owner->id !== Auth::id()) {
            // 如果没有权限，则返回403 Forbidden响应
            abort(403);
        }

        return view('entries.branches.show.control.general-setting', [
            'branch' => $branch,
            'branchId' => $branch->id,
        ]);

    }

    public function pullRule($id)
    {
        $branch = EntryBranch::findOrFail($id);
        // 检查当前用户是否拥有访问分支的权限
        if ($branch->owner->id !== Auth::id()) {
            // 如果没有权限，则返回403 Forbidden响应
            abort(403);
        }
        // 如果有权限，则渲染视图
        return view('entries.branches.show.control.pull-rule', [
            'branch' => $branch,
        ]);
    }

    //功能区域

    public function changeDemoVersion($id, $newDemoVersionId){

        $branch = EntryBranch::findOrFail($id);

        $branch -> changeDemoVersion($newDemoVersionId);

        $version = EntryVersion::findOrFail($newDemoVersionId);

        $version -> changeStatus(1570);
        
        return view('entries.branches.show.control.pull-rule', [
            'branch' => $branch,
        ]);

    }

    public function VersionAccept($id, $newVersionId){

        $branch = EntryBranch::findOrFail($id);

        $version = EntryVersion::findOrFail($newVersionId);

        $version -> changeStatus(1560);
        
        return view('entries.branches.show.control.pull-rule', [
            'branch' => $branch,
        ]);

    }


    /**
     * show 功能区结束
     * -----------------------------------------------
     */

    /**
     * 显示分支列表
     *
     * 
     * @param int $entryId
     * @return \Illuminate\View\View
     */

    public function branchList($entryId)
    {
        $entry = Entry::findOrFail($entryId);
        $branches = $entry->branches;  // 这里就是使用那个关联方法

        return view('entries.branches.list', compact('entry', 'branches'));
    }


    /**
     * 显示创建新分支的表单
     *
     * @param Request $request
     * @param int $entryId
     * @return \Illuminate\View\View
     */
    public function create(Request $request, $entryId)
    {
        // 获取词条下的所有分支
        $entry = Entry::find($entryId);
        $branches = $entry->branches;

        // 获取词条下所有分支的每一个版本
        $versions = [];
        foreach ($branches as $branch) {
            foreach ($branch->versions as $version) {
                $versions[] = $version;
            }
        }

        return view('entries.branches.create ', [
            'branches' => $branches,
            'versions' => $versions,
            'entryId' => $entryId
        ]);
    }

    /**
     * ---------------------------------------------
     * 逻辑方法开始
     * 
     * 
     */

     public function store(Request $request, $entryId)
     {
         // 验证请求数据
         $validatedData = $request->validate([
             'is_pb' => 'required|boolean',
             'is_free' => 'required|boolean',
             'name' => 'required|string',
             'description' => 'required|string',
             'content' => 'required|string',
         ]);
     
         try {
             // 启动数据库事务
             DB::beginTransaction();
     
             $entry = Entry::findOrFail($entryId);
     
             $branch = $entry->branches()->create([
                 'is_pb' => $validatedData['is_pb'],
                 'is_free' => $validatedData['is_free'],
                 'status' => 9,
             ]);
     
             $version = $branch->versions()->create([
                 'name' => $validatedData['name'],
                 'description' => $validatedData['description'],
                 'content' => $validatedData['content'],
                 'author_id' => Auth::id(),
                 'status' => 9,
             ]);
     
             EntryBranchUser::newOwner($branch->id, Auth::id());
     
             $branch->update(['Demo_Version_ID' => $version->id]);
     
             // 提交事务
             DB::commit();
     
             return redirect()->route('entry.show', $entryId);
         } catch (\Exception $e) {
             // 回滚事务
             DB::rollback();
     
             // 记录异常
             Log::error("[EntryBranch]词条分支创建失败:  " . $e->getMessage());
     
             // 可以选择返回错误信息或重定向到错误页面
             return back()->with('error', '操作失败，请重试。');
         }
     }
     

    //添加编辑用户
    //不用
    public function addeditor($userId,$branchId){

        $thisBranch = EntryBranch::findOrFail($branchId);

        $thisBranch->addUser($userId);

    }

    //删除编辑用户
    //不用
    public function deleteeditor($userId,$branchId){

        $thisBranch = EntryBranch::findOrFail($branchId);

        $thisBranch->deleteUser($userId);

        return true;
    }

    //删除版本
    public function deleteversion($versionId,$branchId){

        $thisVerison = EntryVersion::findOrFail($versionId);

        $thisVerison->delete;

        return true;
    }


    // 更新分支信息。
    public function update(Request $request, $branchId)
    {
        $branch = EntryBranch::find($branchId);
        if (!$branch) {
            return redirect()->back()->withErrors('Branch not found.');
        }

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $branch->update([
            'name' => $request->name,
            'is_pb' => $request->is_pb,
            'is_free' => $request->is_free,
            'status' => 9,
        ]);

        return redirect()->route('entry.show', $branch->entry_id);
    }

    // 软删除特定分支。
    public function softDelete($branchId)
    {
        $branch = EntryBranch::find($branchId);
        if (!$branch) {
            return redirect()->back()->withErrors('Branch not found.');
        }

        $branch->softDelete();
        return redirect()->route('entry.show', $branch->entry_id);
    }

    // 恢复软删除的分支。
    public function restore($branchId)
    {
        $branch = EntryBranch::withTrashed()->find($branchId);
        if (!$branch) {
            return redirect()->back()->withErrors('Branch not found.');
        }

        $branch->restore();
        return redirect()->route('entry.show', $branch->entry_id);
    }

    /**
     * 创建 EntryBranch 和 Wall 之间的关联。
     *
     * @param Request $request
     * @param string  $branchUuid EntryBranch 实体的 UUID
     * @return \Illuminate\Http\Response
     */
    public function createEWLink(Request $request, $branchUuid)
    {
        // 数据验证
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 查找 EntryBranch 实体
        $branch = EntryBranch::where('id', $branchUuid)->first();
        if (!$branch) {
            return response()->json(['error' => 'EntryBranch not found'], 404);
        }

        // 创建链接
        try {
            $wallData = $request->only(['name', 'description']);
            $entityWallAssociation = $branch->createEWLink($wallData);

            // 使用 session() 辅助函数设置 session 数据
            session()->flash('message','讨论墙创建成功！');

            //return response()->json(['message' => 'Link created successfully', 'link' => $entityWallAssociation], 201);
            return back();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create link'], 500);
        }
    }


    // 其他的方法...
}
