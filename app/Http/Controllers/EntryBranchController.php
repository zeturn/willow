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

    /**
     * 显示演示版本
     *
     * 此函数用于显示特定分支的演示版本。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后从分支记录中获取演示版本信息。
     * 最后，将分支和演示版本信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function showDemoVersion($id)
    {
        try {

            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;

            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 从分支记录中获取演示版本信息
            $demoversion =$branch->demoVersion;

            // 将分支和演示版本信息传递给视图
            return view('entries.branches.show.show-demo-version', [
                'branch' => $branch,
                'demoversion' => $demoversion,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching demo version: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
    }


    /**
     * 显示版本列表
     *
     * 此函数用于显示特定分支的版本列表。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后从分支记录中获取所有版本信息。
     * 最后，将分支和版本信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function showVersionList($id)
    {
        try {

            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;

            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 从分支记录中获取所有版本信息
            $versions =$branch->versions;

            // 将分支和版本信息传递给视图
            return view('entries.branches.show.show-version-list', [
                'branch' => $branch,
                'versions' => $versions,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching version list: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
    }


    /**
     * 显示分支信息
     *
     * 此函数用于显示特定分支的详细信息。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 最后，将分支信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function showInfo($id)
    {
        try {

            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;


            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 将分支信息传递给视图
            return view('entries.branches.show.show-info', [
                'branch' => $branch,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching branch info: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
    }


    /**
     * 显示编辑者列表
     *
     * 此函数用于显示特定分支的所有者和编辑者列表。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后获取分支的所有者和编辑者信息。
     * 最后，将分支、所有者和编辑者信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function showEditors($id)
    {
        try {

            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;
            
            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 获取分支的所有者信息
            $owner =$branch->owner;

            // 获取分支的编辑者列表
            $editors =$branch->users;

            // 将分支、所有者和编辑者信息传递给视图
            return view('entries.branches.show.show-editors', [
                'branch' => $branch,
                'owner' => $owner,
                'editors' => $editors,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching editors: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
    }


    /**
     * 显示控制面板
     *
     * 此函数用于显示特定分支的控制面板。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后获取分支的所有者和编辑者信息。
     * 最后，将分支、所有者和编辑者信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function showControl($id)
    {
        try {

            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;

            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 获取分支的所有者信息
            $owner =$branch->owner;

            // 获取分支的编辑者列表
            $editors =$branch->users;

            // 将分支、所有者和编辑者信息传递给视图
            return view('entries.branches.show.control.control', [
                'branch' => $branch,
                'owner' => $owner,
                'editors' => $editors,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching control panel data: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
    }


    /**
     * ----------------------------------
     * control 功能区
     */
    /**
     * 显示推送请求
     *
     * 此函数用于显示特定分支的版本推送请求。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后检查当前用户是否是分支的所有者，如果不是，则返回403 Forbidden响应。
     * 最后，将分支和待审核的版本信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function pushRequests($id)
    {
        try {
            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;

            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 检查当前用户是否拥有访问分支的权限
            if ($branch->owner->id !== Auth::id()) {
                // 如果没有权限，则返回403 Forbidden响应
                abort(403);
            }

            // 获取分支的待审核版本信息
            $versionsforreview = $branch->versionsforreview;

            // 将分支和待审核的版本信息传递给视图
            return view('entries.branches.show.control.push-requests', [
                'branch' => $branch,
                'versionsforreview' => $versionsforreview,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching push requests: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.404');
        }
    }

    /**
     * 显示编辑者组
     *
     * 此函数用于显示特定分支的编辑者组信息。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后检查当前用户是否是分支的所有者，如果不是，则返回403 Forbidden响应。
     * 最后，将分支、分支ID、所有者和编辑者信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function EditorGroup($id)
    {
        try {
            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;

            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 检查当前用户是否拥有访问分支的权限
            if ($branch->owner->id !== Auth::id()) {
                // 如果没有权限，则返回403 Forbidden响应
                abort(403);
            }

            // 获取分支ID
            $branchId =$branch->id;

            // 获取分支的所有者信息
            $owner =$branch->owner;

            // 获取分支的编辑者列表
            $editors =$branch->users;

            // 将分支、分支ID、所有者和编辑者信息传递给视图
            return view('entries.branches.show.control.editor-group', [
                'branch' => $branch,
                'branchId' => $branchId,
                'owner' => $owner,
                'editors' => $editors,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching editor group: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
    }

    
    /**
     * 显示版本列表
     *
     * 此函数用于显示特定分支的版本列表。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后检查当前用户是否是分支的所有者，如果不是，则返回403 Forbidden响应。
     * 最后，将分支和版本信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function VersionList($id)
    {
        try {
            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;

            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 检查当前用户是否拥有访问分支的权限
            if ($branch->owner->id !== Auth::id()) {
                // 如果没有权限，则返回403 Forbidden响应
                abort(403);
            }

            // 获取分支的版本信息
            $versions =$branch->versions;

            // 将分支和版本信息传递给视图
            return view('entries.branches.show.control.version-list', [
                'branch' => $branch,
                'versions' => $versions,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching version list: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
    }

    /**
     * 显示拉取规则
     *
     * 此函数用于显示特定分支的拉取规则。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后检查当前用户是否是分支的所有者，如果不是，则返回403 Forbidden响应。
     * 最后，将分支信息传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function pullRule($id)
    {
        try {

            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;
            
            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 检查当前用户是否拥有访问分支的权限
            if ($branch->owner->id !== Auth::id()) {
                // 如果没有权限，则返回403 Forbidden响应
                abort(403);
            }

            // 将分支信息传递给视图
            return view('entries.branches.show.control.pull-rule', [
                'branch' => $branch,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching pull rule: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
    }


        /**
     * 显示通用设置
     *
     * 此函数用于显示特定分支的通用设置。
     * 首先尝试查找对应的分支记录，如果不存在，则抛出异常。
     * 然后检查当前用户是否是分支的所有者，如果不是，则返回403 Forbidden响应。
     * 最后，将分支和分支ID传递给视图。
     *
     * @param int $id 分支ID
     * @return \Illuminate\View\View
     */
    public function GenreralSetting($id)
    {
        try {

            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;
            
            // 尝试查找指定ID的分支记录，如果不存在则抛出异常
            $branch = EntryBranch::findOrFail($id);

            // 检查当前用户是否拥有访问分支的权限
            if ($branch->owner->id !== Auth::id()) {
                // 如果没有权限，则返回403 Forbidden响应
                abort(403);
            }

            // 将分支和分支ID传递给视图
            return view('entries.branches.show.control.general-setting', [
                'branch' => $branch,
                'branchId' => $branch->id,
            ]);
        } catch (\Exception $e) {
            // 捕获任何异常并记录错误信息
            \Log::error("Error fetching general settings: " . $e->getMessage());

            // 可以选择返回错误视图或进行其他错误处理
            return view('errors.general');
        }
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
