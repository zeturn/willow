<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use App\Models\EntryVersion;
use App\Models\EntryVersionTask;
use App\Models\EntityWallAssociation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr; // 添加这一行来引入 Arr 类

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class EntryController extends Controller
{
    // 显示所有词条。
    public function index()
    {
        $entries = Entry::paginate(30);
        return view('entries.index', compact('entries'));
    }

    // 显示创建新词条的表单。
    public function create()
    {
        return view('entries.create');
    }


    /***
     * store
     * 总创建方法
     * 
     * 
     * 
     */
    public function store(Request $request)
    {
        // 数据验证
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
        ]);
    
        DB::beginTransaction();
    
        try {
            // 创建新词条
            $entry = Entry::create([
                'name' => $validated['name'],
                'status' => 5 // 假设 5 代表某种状态
            ]);
    
            // 创建主分支（CB）
            $branch = $entry->branches()->create([
                'name' => $validated['name'],
                'entry_id'=> $entry->id,
                'is_pb' => true,
                'is_free' => true,
                'status' => 5
            ]);
    
            EntryBranchUser::newOwner($branch->id, Auth::id());
    
            // 创建版本（Version）
            $version = $branch->versions()->create([
                'entry_branch_id' => $branch->id,
                'name' => $validated['name'],
                'description' => $validated['description'],
                'content' => $validated['content'],
                'author_id' => Auth::id(),
                'status' => 5,
            ]);
    
            $branch->changeDemoVersion($version->id);
            $entry->changeDemoBranch($branch->id);
    
            DB::commit();
    
            return redirect()->route('entry.index')->with('success', '词条创建成功');
        } catch (\Exception $e) {
            DB::rollBack();
    
            // 记录错误日志
            Log::error('[Entry]词条创建失败: ' . $e->getMessage());
    
            return back()->withInput()->withErrors('词条创建失败');
        }
    }
    


    // 显示特定词条的详细信息。
    public function show($id)
    {
        $entry = Entry::findOrFail($id);//寻找词条

        $walls = $entry->walls;
        // 使用模型中的方法获取 Demo Branch 和 Demo Version
        $demoBranch = $entry->getDemoBranch();
        //dd($demoBranch);
        $demoVersion = $demoBranch->getDemoVersion();

        //dd(Auth::id());

        // 返回到视图，并传递获取的数据
        return view('entries.show', [
            'entry' => $entry,
            'walls' => $walls,
            'demoBranch' => $demoBranch,
            'demoVersion' => $demoVersion,
            'userId' =>  Auth::id(),
            'entryId' => $id,

        ]);
    }

    // 显示解释页面
    public function showExplanation($id)
    {
        $entry = Entry::findOrFail($id);//寻找词条

        $walls = $entry->walls;
        // 使用模型中的方法获取 Demo Branch 和 Demo Version
        $demoBranch = $entry->getDemoBranch();
        //dd($demoBranch);
        $demoVersion = $demoBranch->getDemoVersion();

        //dd(Auth::id());

        // 返回到视图，并传递获取的数据
        return view('entries.show.show-explanation', [
            'entry' => $entry,
            'walls' => $walls,
            'demoBranch' => $demoBranch,
            'demoVersion' => $demoVersion,
            'userId' =>  Auth::id(),
            'entryId' => $id,

        ]);
    }

    // 显示分支页面
    public function showBranch($id)
    {
        $entry = Entry::findOrFail($id);
        $branches = $entry->branches;

        return view('entries.show.show-branch', compact('entry','branches'));
    }

    

    // 显示控制页面
    public function showControl($id)
    {
        $entry = Entry::findOrFail($id);//寻找词条

        $walls = $entry->walls;
        // 使用模型中的方法获取 Demo Branch 和 Demo Version
        $demoBranch = $entry->getDemoBranch();
        //dd($demoBranch);
        $demoVersion = $demoBranch->getDemoVersion();

        //dd(Auth::id());

        // 返回到视图，并传递获取的数据
        return view('entries.show.show-control', [
            'entry' => $entry,
            'walls' => $walls,
            'demoBranch' => $demoBranch,
            'demoVersion' => $demoVersion,
            'userId' =>  Auth::id(),
            'entryId' => $id,

        ]);
    }

    //showBranch 方法区 缩进tab
        public function BranchesList($id)
        {
            $entry = Entry::findOrFail($id);

            return view('entries.show.branch.brancheslist', compact('entry'));
            
        }
        /**
         * 
         */
        public function myBranches($id)
        {
            $entry = Entry::findOrFail($id);
            //dd();
            $mybranches = User::findOrFail(Auth::id())->branches->where('entry_id', $id);


            //dd($mybranches,Auth::id(),$id);
            return view('entries.show.branch.mybranches', compact('entry','mybranches'));

        } 

        public function createBranch($id)
        {
            $entry = Entry::findOrFail($id);

            return view('entries.show.branch.createbranch', compact('entry'));
        }

        public function addEditor($id)
        {
            $entry = Entry::findOrFail($id);
        }

        public function PushApplication($id)
        {
            $entry = Entry::findOrFail($id);

            
        }

        //进行中的编辑版本
        public function TaskinProcess($id)
        {
            $entry = Entry::findOrFail($id);
        
            // 获取当前登录用户的ID
            $userId = Auth::id();
        
            // 获取与当前用户相关的EntryVersionTask记录
            $tasks = EntryVersionTask::where('author_id', $userId)
                                     ->where('entry_id', $id)
                                     ->get();
        
            // 传递数据到视图
            return view('entries.show.branch.taskinprocess', compact('entry', 'tasks'));
        }


    // 显示社区页面
    public function showCommunity($id)
    {
        $entry = Entry::with('walls.topics')->findOrFail($id);
    
        // 返回到视图，并传递获取的数据
        return view('entries.show.show-community', [
            'entry' => $entry,
            'walls' => $entry->walls,
        ]);
    }


    // 显示相册页面
    public function showAlbum($id)
    {
        $entry = Entry::findOrFail($id);
        $albums = $entry->albums()->with('medias')->get();

        $albumsCover = $albums->mapWithKeys(function ($album) {
            $cover = Arr::random($album->medias->pluck('url')->toArray());
            return [$album->id => $cover];
        });

        $entryId = $entry->id;

        return view('entries.show.show-album', compact('entry', 'albums', 'entryId', 'albumsCover'));
    }

    // 显示详细信息页面
    public function showDetails($id)
    {
        $entry = Entry::findOrFail($id);

        $branchesNum = $entry -> branches ->count();

        return view('entries.show.show-details', compact('entry', 'branchesNum'));
    }










    // 删除特定词条（硬删除）。
    public function delete($id)
    {
        Entry::findOrFail($id)->forceDelete();
        return redirect()->route('entry.index');
    }

    // 软删除特定词条。
    public function softDelete($id)
    {
        Entry::findOrFail($id)->softDelete();
        return redirect()->route('entry.index');
    }

    // 恢复软删除的词条。
    public function restore($id)
    {
        $entry = Entry::withTrashed()->findOrFail($id);
        $entry->restore();
        return redirect()->route('entry.index');
    }
    
    /**
     * 创建 Entry 和 Wall 之间的关联。
     *
     * @param Request $request
     * @param string  $entryUuid Entry 实体的 UUID
     * @return \Illuminate\Http\Response
     */
    public function createEWLink(Request $request, $entryUuid)
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

        // 查找 Entry 实体
        $entry = Entry::where('id', $entryUuid)->first();
        if (!$entry) {
            return response()->json(['error' => 'Entry not found'], 404);
        }

        // 创建链接
        try {
            $wallData = $request->only(['name', 'slug', 'description']);
            $entityWallAssociation = $entry->createEWLink($wallData);

            return response()->json(['message' => 'Link created successfully', 'link' => $entityWallAssociation], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create link', 'errorInfo' => $e], 500);
        }
    }


    
    // 显示创建新词条的表单。
    public function editgate($id)
    {
        return view('entries.editgate',[
            'entryId' => $id,
        ]);
    }

}
