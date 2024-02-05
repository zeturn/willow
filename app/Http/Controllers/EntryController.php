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

use Inertia\Inertia;

class EntryController extends Controller
{
    // 显示所有词条。
    public function index()
    {
        $entries = Entry::paginate(30);
        return view('entries.index', compact('entries'));
    }

    /**
     * 显示创建新词条的表单。
     * Display the form for creating a new entry.
     * 这个方法现在增加了一个检查，确保只有当用户已经登录时才能访问创建词条的表单。
     * If the user is not authenticated, they are redirected to the login page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        // 用户已登录，显示创建新词条的表单 / The user is authenticated, display the form for creating a new entry
        return view('entries.create');
        // return Inertia::render('entry/create');
    }

    /**
     * store
     * 词条创建方法
     * 该方法用于创建新的词条及相关数据，并确保整个创建过程的事务性和数据的完整性。
     * @param Request $request 请求对象，包含需要创建词条的相关数据
     * @return \Illuminate\Http\RedirectResponse 返回重定向响应
     */
    public function store(Request $request)
    {
        // 数据验证 / Data validation
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
        ]);

        // 开始数据库事务 / Start database transaction
        DB::beginTransaction();

        try {
            // 创建新词条 / Create new entry
            $entry = Entry::create([
                'name' => $validated['name'],
                'status' => 1101113344, // 初始状态，等待审核 / Initial status, pending review
            ]);

            if (!$entry) {
                throw new \Exception('Entry creation failed');
            }

            // 创建主分支（CB）/ Create main branch (CB)
            $branch = $entry->branches()->create([
                'name' => $validated['name'],
                'entry_id'=> $entry->id,
                'is_pb' => true,
                'is_free' => true,
                'status' => 1201113244, // 初始状态，等待审核 / Initial status, pending review
            ]);

            if (!$branch) {
                throw new \Exception('Branch creation failed');
            }

            EntryBranchUser::newOwner($branch->id, Auth::id());

            // 创建版本（Version）/ Create version
            $version = $branch->versions()->create([
                'entry_branch_id' => $branch->id,
                'name' => $validated['name'],
                'description' => $validated['description'],
                'content' => $validated['content'],
                'author_id' => Auth::id(),
                'status' => 1301113244, // 初始状态，等待审核 / Initial status, pending review
            ]);

            if (!$version) {
                throw new \Exception('Version creation failed');
            }

            $branch->changeDemoVersion($version->id);
            $entry->changeDemoBranch($branch->id);

            // 创建审核任务 / Create censor task
            $entry->createCensorTask();
            $branch->createCensorTask();
            $version->createCensorTask();

            // 提交数据库事务 / Commit database transaction
            DB::commit();

            return redirect()->route('entry.index')->with('success', '词条创建成功');
        } catch (\Exception $e) {
            // 回滚数据库事务 / Rollback database transaction
            DB::rollBack();

            // 记录错误日志 / Log the error
            Log::error('[Entry] 词条创建失败: ' . $e->getMessage());

            return back()->withInput()->withErrors('数据库异常，词条创建失败');
        }
    }

    /**
     * show
     * 显示特定词条的详细信息
     * 该方法用于获取并展示指定词条的详情，包括相关的分支和版本信息。
     * @param int|string $id 词条的唯一标识符/ID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response 视图响应或HTTP响应
     */
    public function show($id)
    {
        try {
            // 尝试查找词条 / Attempt to find the entry
            $entry = Entry::findOrFail($id);

            // 检查词条是否公开可见 / Check if entry is publicly visible
            if ($entry->isPublicVisible()) {
                $walls = $entry->walls;
                // 使用模型中的方法获取 Demo Branch 和 Demo Version / Retrieve Demo Branch and Demo Version using model methods
                $demoBranch = $entry->getDemoBranch();
                $demoVersion = $demoBranch ? $demoBranch->getDemoVersion() : null;

                // 确保 Demo Branch 和 Demo Version 都存在 / Ensure both Demo Branch and Demo Version exist
                if (!$demoBranch || !$demoVersion) {
                    throw new \Exception('Failed to retrieve demo branch or demo version');
                }

                // 返回到视图，并传递获取的数据 / Return to the view with the retrieved data
                return view('entries.show', [
                    'entry' => $entry,
                    'walls' => $walls,
                    'demoBranch' => $demoBranch,
                    'demoVersion' => $demoVersion,
                    'userId' => Auth::id(),
                    'entryId' => $id,
                ]);
            } else {
                // 如果词条不公开可见，则中止并返回403错误 / Abort and return a 403 error if the entry is not publicly visible
                abort(403, 'Access denied: 4(waiting for censor)');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // 如果无法找到词条，则返回404错误 / Return a 404 error if the entry is not found
            return abort(404, 'Entry not found');
        } catch (\Exception $e) {
            // 记录错误日志 / Log the error
            Log::error('[Entry] 词条详情展示失败: ' . $e->getMessage());

            // 返回一个带有错误消息的响应 / Return a response with an error message
            return response()->view('errors.general', ['message' => 'Failed to display entry details'], 500);
        }
    }


    // 显示解释页面
    public function showExplanation($id)
    {
        $entry = Entry::findOrFail($id);//寻找词条

        //dd($entry -> isPublicVisible());
        if($entry -> isPublicVisible()){

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
        }else{
            abort(403);
        }
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
