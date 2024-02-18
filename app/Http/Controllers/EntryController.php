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

    function __construct()
    {
        $this->middleware('permission:entry-create', ['only' => ['create','store']]);
        $this->middleware('permission:entry-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:entry-soft-edit', ['only' => ['softDelete']]);//一般用户，仅可以软删除
        $this->middleware('permission:entry-delete', ['only' => ['destroy', 'softDelete', 'restore']]);//高级用户，删除、软删除、恢复
    }

    /**
     * 显示所有词条的列表。
     * Display a listing of the entries.
     * 此方法用于获取所有词条并分页显示，同时确保只有登录用户才能访问此列表。
     * This method is used to retrieve all entries and display them with pagination, also ensures that only authenticated users can access this list.
     *
     * @return \Illuminate\Http\Response 返回视图或重定向到登录页面 / Returns view or redirects to login page
     */
    public function index()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
            return redirect()->route('login');
        }

        // 尝试获取词条列表，使用异常处理以增加代码的健壮性 / Attempt to retrieve the list of entries, use exception handling to increase code robustness
        try {
            // 使用分页查询来限制每页显示的词条数量，避免大量数据一次性加载 / Use pagination query to limit the number of entries shown per page, avoiding loading large amounts of data at once
            $entries = Entry::paginate(30);
        } catch (\Exception $e) {
            // 在获取数据时发生错误，重定向到错误页面并显示自定义错误消息 / An error occurred while fetching data, redirect to an error page with a custom error message
            // 使用view函数来返回错误视图，确保你的视图文件夹中有errors.general视图文件 / Use the view function to return an error view, ensure you have an errors.general view file in your views folder
            return view('errors.general', ['message' => '无法显示词条列表，请稍后再试。/Failed to display the entry list, please try again later.'], 500);
        }

        // 如果成功获取到词条列表，返回词条列表视图 / If the list of entries is successfully retrieved, return the entries list view
        // 使用compact函数将词条变量传递给视图，以便在视图中显示词条列表 / Use the compact function to pass the entries variable to the view, so the list of entries can be displayed in the view
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
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

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
            return response()->view('errors.general', ['message' => 'Failed to display entry details'], [500]);
        }
    }

    /**
     * -------------------------------------------------------
     * show方法区
     * 
     * 
     */

        /**
         * Display the explanation page for a given entry.
         * 显示给定词条的解释页面。
         * This method fetches an entry by its ID, checks if it's publicly visible, and then displays its details along with related data. If the entry is not found or not publicly visible, it handles these cases gracefully.
         * 此方法通过其 ID 获取一个词条，检查它是否公开可见，然后显示其详细信息及相关数据。如果找不到词条或词条不公开可见，它将优雅地处理这些情况。
         * 
         * @param int $id Entry ID / 词条ID
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\Response The view with entry details or an error response / 带有词条详细信息的视图或错误响应
         */
        public function showExplanation($id)
        {
            try {
                // Ensure the ID is an string(uuid) to prevent type mismatch.
                // 确保ID是一个uuid，以防止类型不匹配。
                $id = (string) $id;
                
                // Attempt to find the entry, fail with a 404 if not found.
                // 尝试找到词条，如果未找到则失败并返回404。
                $entry = Entry::findOrFail($id);
                // Check if the entry is publicly visible.
                // 检查词条是否公开可见。
                if (!$entry->isPublicVisible()) {
                    // If not visible, abort with a 403 error.
                    // 如果不可见，则中止并返回403错误。
                    abort(403, 'This entry is not publicly visible. 当前帖子正在审核。');
                }

                // Fetch related data only if the entry is visible.
                // 仅当词条可见时，才获取相关数据。
                $nodes = $entry->nodes;
                $walls = $entry->walls;
                $demoBranch = $entry->getDemoBranch();
                $demoVersion = $demoBranch ? $demoBranch->getDemoVersion() : null;

                // Return to the view with the fetched data.
                // 返回到视图，并传递获取的数据。
                return view('entries.show.show-explanation', [
                    'entry' => $entry,
                    'walls' => $walls,
                    'nodes' => $nodes,
                    'demoBranch' => $demoBranch,
                    'demoVersion' => $demoVersion,
                    'userId' => Auth::id(),
                    'entryId' => $id,
                    'tabname' => 'entry.show.explanation',
                ]);
            } catch (ModelNotFoundException $e) {
                // Handle the case where the entry is not found.
                // 处理未找到词条的情况。
                return view('errors.general', ['message' => 'Failed to display entry details'], [404]);
            } catch (\Exception $e) {
                // Handle any other exceptions.
                // 处理任何其他异常。
                return view('errors.general', ['message' => 'An error occurred while displaying the entry.'], [500]);
            }
        }

        /**
         * Display the branch page for a given entry.
         * 显示给定词条的分支页面。
         * This method fetches an entry by its ID and its related branches, then displays them. It includes error handling for cases when the entry does not exist or other exceptions occur.
         * 此方法通过其 ID 获取一个词条及其相关分支，然后显示它们。它包括错误处理，以应对词条不存在或其他异常发生的情况。
         * 
         * @param int $id Entry ID / 词条ID
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\Response The view with branch details or an error response / 带有分支详细信息的视图或错误响应
         */
        public function showBranch($id)
        {
            try {
                // Ensure the ID is an string(uuid) to prevent type mismatch.
                // 确保ID是一个uuid，以防止类型不匹配。
                $id = (string) $id;

                // Attempt to find the entry and its branches, fail with a 404 if not found.
                // 尝试找到词条及其分支，如果未找到则失败并返回404。
                $entry = Entry::findOrFail($id);
                $branches = $entry->branches;

                // Return to the view with the fetched data.
                // 返回到视图，并传递获取的数据。
                return view('entries.show.show-branch', compact('entry', 'branches'));
            } catch (ModelNotFoundException $e) {
                // Handle the case where the entry is not found by returning a custom error view.
                // 通过返回自定义错误视图来处理未找到词条的情况。
                // Log::error("Entry with ID {$id} not found.", ['exception' => $e]);
                return view('errors.general', ['message' => 'Entry not found.'], [404]);
            } catch (\Exception $e) {
                // Handle any other exceptions by logging and returning a general error view.
                // 通过记录日志并返回一个通用错误视图来处理任何其他异常。
                Log::error("An error occurred while displaying the branch for entry ID {$id}.", ['exception' => $e]);
                return view('errors.general', ['message' => 'An error occurred while displaying the branch.'], [500]);
            }
        }
    
        /**
         * Display the control page for a given entry.
         * 显示给定词条的控制页面。
         * This method fetches an entry by its ID, retrieves related information such as walls, demo branch, and demo version, then displays them. It handles cases where the entry might not exist or other exceptions occur gracefully.
         * 此方法通过其 ID 获取一个词条，检索相关信息，如墙壁、演示分支和演示版本，然后显示它们。它优雅地处理了词条可能不存在或发生其他异常的情况。
         * 
         * @param int $id Entry ID / 词条ID
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\Response The view with control details or an error response / 带有控制详细信息的视图或错误响应
         */
        public function showControl($id)
        {
            try {
                // Ensure the ID is an string(uuid) to prevent type mismatch.
                // 确保ID是一个uuid，以防止类型不匹配。
                $id = (string) $id;

                // Attempt to find the entry; if not found, a 404 exception is thrown.
                // 尝试查找词条；如果找不到，将抛出404异常。
                $entry = Entry::findOrFail($id);

                // Fetch related data for the entry.
                // 获取词条的相关数据。
                $walls = $entry->walls;
                $demoBranch = $entry->getDemoBranch();
                $demoVersion = $demoBranch ? $demoBranch->getDemoVersion() : null;

                // Return to the view with the fetched data, ensuring all necessary information is passed to the view.
                // 返回视图并传递获取的数据，确保向视图传递所有必要信息。
                return view('entries.show.show-control', [
                    'entry' => $entry,
                    'walls' => $walls,
                    'demoBranch' => $demoBranch,
                    'demoVersion' => $demoVersion,
                    'userId' => Auth::id(),
                    'entryId' => $id,
                    'tabname' => 'entry.show.control',
                ]);
            } catch (ModelNotFoundException $e) {
                // Log the error and return a custom error view if the entry is not found.
                // 如果找不到词条，记录错误并返回自定义错误视图。
                // Log::error("Entry with ID {$id} not found.", ['exception' => $e]);
                return view('errors.general', ['message' => 'Entry not found.'], [404]);
            } catch (\Exception $e) {
                // Handle any other exceptions by logging the error and returning a general error view.
                // 通过记录错误并返回通用错误视图来处理任何其他异常。
                Log::error("An error occurred while displaying the control page for entry ID {$id}.", ['exception' => $e]);
                return view('errors.general', ['message' => 'An error occurred while displaying the control page.'], [500]);
            }
        }

        /**
         * ----------------------------------------------------------------------
         * show方法区——Branch方法区
         * 
         * 
         */
            /**
             * Display a list of all branches for a specific entry.
             * 显示特定条目的所有分支的列表。
             * This method retrieves an entry by its ID and displays a list of its branches. It includes error handling for cases where the entry might not be found.
             * 此方法通过其ID检索条目，并显示其分支的列表。它包括处理找不到条目时的错误处理。
             * @param int $id Entry ID to fetch the branches list for/要获取分支列表的条目ID
             * @return View|RedirectResponse Returns a view with the branches list or a general error page/返回带有分支列表的视图或常规错误页面
             */
            public function BranchesList($id)
            {
                try {
                    // Attempt to find the entry by ID / 尝试通过ID找到条目
                    $entry = Entry::findOrFail($id);
                } catch (\Exception $e) {
                    // If the entry cannot be found, log the error and show a general error page / 如果找不到条目，记录错误并显示常规错误页面
                    // \Log::error("Entry not found for branches list: {$e->getMessage()}");
                    return view('errors.general', ['message' => 'Failed to find entry for branches list'], [500]);
                }

                $tabname = "entries.show.branch";

                // If the entry is found, return the view with the entry data to display its branches / 如果找到条目，返回带有条目数据的视图以显示其分支
                return view('entries.show.branch.brancheslist', compact('entry', 'tabname'));
            }

            /**
             * Display the user's branches for a specific entry.
             * 显示用户对特定条目的分支。
             * This method checks if the user is authenticated and displays their branches for a given entry. It ensures robust error handling and security.
             * 此方法检查用户是否已认证，并显示他们对给定条目的分支。它确保了强健的错误处理和安全性。
             * @param int $id Entry ID to fetch branches for/要获取分支的条目ID
             * @return View|RedirectResponse Returns a view with the branches or redirects to the login page/返回带有分支的视图或重定向到登录页面
             */
            public function myBranches($id)
            {
                // Check if the user is authenticated / 检查用户是否已经登录
                if (!Auth::check()) {
                    // If the user is not authenticated, redirect to the login page / 如果用户未登录，重定向到登录页面
                    return redirect()->route('login'); // Ensure the 'login' route is defined in your routes file / 确保你的路由文件中定义了 'login' 路由
                }

                try {
                    $entry = Entry::findOrFail($id);
                } catch (\Exception $e) {
                    // Log the error and redirect to a general error page if the entry is not found / 如果找不到条目，记录错误并重定向到常规错误页面
                    // \Log::error("Entry not found: {$e->getMessage()}");
                    return view('errors.general', ['message' => 'Failed to display entry details'], [500]);
                }

                try {
                    $mybranches = User::findOrFail(Auth::id())->branches->where('entry_id', $id);
                } catch (\Exception $e) {
                    // Log the error and show a general error page if the user or branches cannot be found / 如果找不到用户或分支，记录错误并显示常规错误页面
                    // \Log::error("User or branches not found: {$e->getMessage()}");
                    return view('errors.general', ['message' => 'Failed to load user branches'], [500]);
                }

                $tabname = "entries.show.branch";

                // Return the view with the entry and its branches / 返回带有条目及其分支的视图
                return view('entries.show.branch.mybranches', compact('entry', 'mybranches', 'tabname'));
            }

            /**
             * Display the form to create a new branch for an entry.
             * 显示为条目创建新分支的表单。
             * This method fetches an entry by its ID and shows a form to create a new branch. It includes error handling for entry not found.
             * 此方法通过其ID获取一个条目，并显示一个创建新分支的表单。它包括条目未找到的错误处理。
             * @param int $id Entry ID to create a branch for/要为其创建分支的条目ID
             * @return View|RedirectResponse Returns a view with the form or a general error page/返回带有表单的视图或常规错误页面
             */
            public function createBranch($id)
            {
                try {
                    $entry = Entry::findOrFail($id);
                } catch (\Exception $e) {
                    // Log the error and redirect to a general error page if the entry is not found / 如果找不到条目，记录错误并重定向到常规错误页面
                    // \Log::error("Entry not found for creating a branch: {$e->getMessage()}");
                    return view('errors.general', ['message' => 'Failed to find entry for creating branch'], [500]);
                }

                $tabname = "entries.show.branch";

                // Return the view to create a new branch with the entry data / 返回创建新分支的视图，带有条目数据
                return view('entries.show.branch.createbranch', compact('entry', 'tabname'));
            }

            /**
             * Add an editor to an entry.
             * 为条目添加编辑者。
             * This method is a placeholder for adding an editor to a specific entry by ID. It includes error handling for entry not found.
             * 此方法是为特定条目通过ID添加编辑的占位符。它包括条目未找到的错误处理。
             * @param int $id Entry ID to add an editor for/要为其添加编辑的条目ID
             * @return RedirectResponse|View Returns a view or a redirect response in case of errors/在出错的情况下返回视图或重定向响应
             */
            public function addEditor($id)
            {
                try {
                    $entry = Entry::findOrFail($id);
                    // Logic to add an editor goes here / 添加编辑的逻辑在这里
                } catch (\Exception $e) {
                    //\Log::error("Entry not found for adding editor: {$e->getMessage()}");
                    return view('errors.general', ['message' => 'Failed to find entry for adding an editor'], [500]);
                }

                // Placeholder return, adjust according to actual implementation / 占位符返回，根据实际实现调整
                return back()->with('success', 'Editor added successfully.');
            }

            /**
             * Push an application for an entry.
             * 推送一个条目的申请。
             * This method is a placeholder for pushing an application for a specific entry. It includes basic structure and error handling.
             * 此方法是推送特定条目申请的占位符。它包括基本结构和错误处理。
             * @param int $id Entry ID to push application for/要推送申请的条目ID
             * @return RedirectResponse|View Returns a response depending on the implementation/根据实现返回响应
             */
            public function PushApplication($id)
            {
                try {
                    $entry = Entry::findOrFail($id);
                    // Logic for pushing an application goes here / 推送申请的逻辑在这里
                } catch (\Exception $e) {
                    //  \Log::error("Entry not found for pushing application: {$e->getMessage()}");
                    return view('errors.general', ['message' => 'Failed to find entry for pushing application'], [500]);
                }

                // Placeholder return, adjust according to actual implementation / 占位符返回，根据实际实现调整
                return back()->with('success', 'Application pushed successfully.');
            }

            /**
             * Display tasks in process for the current user and a specific entry.
             * 显示当前用户和特定条目的进行中任务。
             * This method retrieves tasks associated with the current user and the specified entry. It includes error handling for entry not found.
             * 此方法检索与当前用户和指定条目相关的任务。它包括条目未找到的错误处理。
             * @param int $id Entry ID to display tasks for/要显示任务的条目ID
             * @return View|RedirectResponse Returns a view with the tasks or a general error page/返回带有任务的视图或常规错误页面
             */
            public function TaskinProcess($id)
            {
                try {
                    $entry = Entry::findOrFail($id);
                } catch (\Exception $e) {
                    \Log::error("Entry not found for tasks in process: {$e->getMessage()}");
                    return view('errors.general', ['message' => 'Failed to find entry for tasks in process'], [500]);
                }

                $userId = Auth::id(); // Get the current logged-in user's ID / 获取当前登录用户的ID

                $tasks = EntryVersionTask::where('author_id', $userId)
                                        ->where('entry_id', $id)
                                        ->get(); // Retrieve tasks related to the current user and entry / 检索与当前用户和条目相关的任务

                $tabname = "entries.show.branch";

                return view('entries.show.branch.taskinprocess', compact('entry', 'tasks', 'tabname'));
            }

            // Show-Branch 方法区 结束

        /**
         * 显示社区页面 / Show the community page
         * 根据提供的ID查询并显示社区页面，包含墙和话题 / Queries and shows the community page based on the provided ID, including walls and topics.
         * @param int $id 社区的ID / ID of the community
         * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory 视图或错误页面 / View or error page
         */
        public function showCommunity($id)
        {
            try {
                $entry = Entry::with('walls.topics')->findOrFail($id);
            } catch (ModelNotFoundException $e) {
                Log::error('Community not found', ['id' => $id, 'error' => $e->getMessage()]);
                return view('errors.general', ['message' => 'Failed to display community details'], [500]);
            }

            // 返回到视图，并传递获取的数据 / Return to the view and pass the retrieved data
            return view('entries.show.show-community', [
                'entry' => $entry,
                'walls' => $entry->walls,
                'tabname' => 'entries.show.community',
            ]);
        }

        /**
         * 显示相册页面 / Show the album page
         * 根据提供的ID查询并显示相册页面，包含媒体内容 / Queries and shows the album page based on the provided ID, including media contents.
         * @param int $id 相册的ID / ID of the album
         * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory 视图或错误页面 / View or error page
         */
        public function showAlbum($id)
        {
            try {
                // Ensure the ID is an string(uuid) to prevent type mismatch.
                // 确保ID是一个uuid，以防止类型不匹配。
                $id = (string) $id;
                $entry = Entry::findOrFail($id);
                $albums = $entry->albums()->with('medias')->get();
            } catch (ModelNotFoundException $e) {
                Log::error('Album not found', ['id' => $id, 'error' => $e->getMessage()]);
                return view('errors.general', ['message' => 'Failed to display album details'], [500]);
            } catch (\Exception $e) {
                Log::error('Error loading albums', ['id' => $id, 'error' => $e->getMessage()]);
                return view('errors.general', ['message' => 'Failed to display album details'],[500]);
            }

            $albumsCover = $albums->mapWithKeys(function ($album) {
                if ($album->medias->isNotEmpty()) {
                    $cover = Arr::random($album->medias->pluck('url')->toArray());
                    return [$album->id => $cover];
                }
                return [$album->id => null]; // 如果相册没有媒体内容，返回null / Return null if the album has no media content
            });

            $entryId = $entry->id;

            $tabname = "entry.show.album";

            return view('entries.show.show-album', compact('entry', 'albums', 'entryId', 'albumsCover', 'tabname'));
        }

        /**
         * 显示详细信息页面 / Show the details page
         * 根据提供的ID查询并显示详细信息页面 / Queries and shows the details page based on the provided ID.
         * @param int $id 详细信息的ID / ID of the details
         * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory 视图或错误页面 / View or error page
         */
        public function showDetails($id)
        {
            try {
                // Ensure the ID is an string(uuid) to prevent type mismatch.
                // 确保ID是一个uuid，以防止类型不匹配。
                $id = (string) $id;

                $entry = Entry::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                Log::error('Details not found', ['id' => $id, 'error' => $e->getMessage()]);
                return view('errors.general', ['message' => 'Failed to display entry details'], [500]);
            }

            $branchesNum = $entry->branches->count();

            $tabname = "entry.show.details";

            return view('entries.show.show-details', compact('entry', 'branchesNum', 'tabname'));
        }

        //show方法区结束

    //继续普通方法

    /**
     * 删除特定词条（硬删除）/ Delete a specific entry (hard delete).
     * 在删除前检查用户认证状态，并进行硬删除操作 / Checks user authentication status before deletion and performs a hard delete.
     * @param int $id 词条的ID / ID of the entry
     * @return \Illuminate\Http\RedirectResponse 重定向响应 / Redirect response
     */
    public function delete($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {

            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;

            Entry::findOrFail($id)->forceDelete();
        } catch (ModelNotFoundException $e) {
            Log::error('Entry not found for hard deletion', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('entry.index')->withErrors('Entry not found for deletion.');
        }

        return redirect()->route('entry.index')->with('success', 'Entry deleted successfully.');
    }

    /**
     * 软删除特定词条 / Soft delete a specific entry.
     * 在删除前检查用户认证状态，并进行软删除操作 / Checks user authentication status before deletion and performs a soft delete.
     * @param int $id 词条的ID / ID of the entry
     * @return \Illuminate\Http\RedirectResponse 重定向响应 / Redirect response
     */
    public function softDelete($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;
            Entry::findOrFail($id)->delete(); // Assuming softDelete() is a typo and should be delete() for soft deletion.
        } catch (ModelNotFoundException $e) {
            Log::error('Entry not found for soft deletion', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('entry.index')->withErrors('Entry not found for deletion.');
        }

        return redirect()->route('entry.index')->with('success', 'Entry soft deleted successfully.');
    }

    /**
     * 恢复软删除的词条 / Restore a soft-deleted entry.
     * 在恢复前检查用户认证状态，并尝试恢复软删除的词条 / Checks user authentication status before restoring and attempts to restore a soft-deleted entry.
     * @param int $id 词条的ID / ID of the entry
     * @return \Illuminate\Http\RedirectResponse 重定向响应 / Redirect response
     */
    public function restore($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            // Ensure the ID is an string(uuid) to prevent type mismatch.
            // 确保ID是一个uuid，以防止类型不匹配。
            $id = (string) $id;

            $entry = Entry::withTrashed()->findOrFail($id);
            $entry->restore();
        } catch (ModelNotFoundException $e) {
            Log::error('Entry not found for restoration', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('entry.index')->withErrors('Entry not found for restoration.');
        }

        return redirect()->route('entry.index')->with('success', 'Entry restored successfully.');
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
            return response()->json(['error' => 'Entry not found'], [404]);
        }

        // 创建链接
        try {
            $wallData = $request->only(['name', 'slug', 'description']);
            $entityWallAssociation = $entry->createEWLink($wallData);

            return response()->json(['message' => 'Link created successfully', 'link' => $entityWallAssociation], [201]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create link', 'errorInfo' => $e], [500]);
        }
    }

}
