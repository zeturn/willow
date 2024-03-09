<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryVersion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

use Inertia\Inertia;

class EntryVersionController extends Controller
{

    public function show($versionId)
    {
        // 根据给定的ID找到版本
        $version = EntryVersion::find($versionId);

        $walls = $version -> walls;

        return view('entries.versions.show', compact('version','walls'));
    }

    public function contentCensorShow($versionId)
    {
        // 根据给定的ID找到版本
        $version = EntryVersion::find($versionId);

        $encryptedId = Crypt::encrypt($version->id);

        return view('entries.versions.content-censor-show', compact('version','encryptedId'));
    }

    public function handleContentCensor(Request $request){
        $id = Crypt::decrypt($request->encryptedId);
        $version = EntryVersion::findOrFail($id);

        switch ($request->action) {
            case 'approve':
                $version->changeStatus(1301113745); // 同意
                break;
            case 'reject':
                $version->changeStatus(130111847); // 拒绝
                break;
            case 'wait':
                $version->changeStatus(130111847); // 等待
                break;
            default:
                // 可能需要处理未知操作
                break;
        }

        return back()->with('success', 'Version task status updated.');
    }
    
    // 显示创建新版本的表单。
    public function create($branchId)
    {
        $branch = EntryBranch::find($branchId);

        if (!$branch) {
            return redirect()->back()->withErrors('Branch not found.');
        }
        
        return view('entries.versions.create', ['branch' => $branch]);
    }

    // 显示创建新版本的表单。
    public function editor($editorId)
    {
        
        return view('entries.versions.editor', ['eveId' => $editorId]);
    }

    // 存储新版本。
    public function store(Request $request, $branchId)
    {
        //dd($branchId);
        $branch = EntryBranch::find($branchId);
        if (!$branch) {
            return redirect()->back()->withErrors('Branch not found.');
        }

        $request->validate([
            'content' => 'required',
        ]);

        EntryVersion::create([
            'entry_branch_id' => $branchId,
            'name' => $request->name,
            'meta' => $request->meta,
            'description' => $request-> description,
            'content' => $request-> content,
            'author_id' => Auth::id(),
            'status' => 9,
        ]);

        return redirect()->route('entry.show', $branch->entry_id);
    }

    //展示当前分支下所有的版本
    public function versionList(Request $request, $branchId)
    {
        // 通过ID查找分支，如果不存在则抛出404异常
        $branch = EntryBranch::findOrFail($branchId);

        // 获取分支相关的版本信息，并应用分页
        // 可以根据需要调整每页显示的版本数量
        $versions = $branch->versions()->paginate(10);

        // 返回视图，同时传递分支和版本信息
        return view('entries.versions.list', compact('branch', 'versions'));
    }

    /**
     * 创建 EntryVersion 和 Wall 之间的关联。
     *
     * @param Request $request
     * @param string  $versionUuid EntryVersion 实体的 UUID
     * @return \Illuminate\Http\Response
     */
    public function createEWLink(Request $request, $versionUuid)
    {
        // 数据验证
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 查找 EntryVersion 实体
        $version = EntryVersion::where('id', $versionUuid)->first();
        if (!$version) {
            return response()->json(['error' => 'EntryVersion not found'], 404);
        }

        // 创建链接
        try {
            $wallData = $request->only(['name', 'slug', 'description']);
            $entityWallAssociation = $version->createEWLink($wallData);

            return response()->json(['message' => 'Link created successfully', 'link' => $entityWallAssociation], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create link'], 500);
        }
    }

    // 其他你列出的方法...
}
