<?php

/**
 * 文件名: web.php
 *
 * 路由定义
 *
 *
 * @package    willow
 * @subpackage null
 * @author     Henry
 * @license    null
 * @version    null
 * @link       null
 * @see        null相关文件或类的链接
 * @since      2023-11 2023-12
 * @deprecated False
 **/

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{

    WorkstationController,
    UserController,

    EntryController,
    EntryBranchController,
    EntryBranchUserController,
    EntryVersionController,
    EntryVersionCensorController,

    WallController,
    TopicController,
    CommentController,

    ReportController,
    CensorTaskController,
    RoleController,

    CategoryController,
    TreeController,
    NodeController,
    EdgeController,
    DAGController,

    MediasController,
    AlbumsController,

};

use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/map', function () {
    return view('map');
});

Route::get('/reactjs', function () {
    return Inertia::render('hello-world');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::group(['middleware' => ['auth']], function() {

    /**
     * 用户工作组
     * Users Working Group
     * 
     * 
     */
    Route::controller(WorkstationController::class)->group(function () {
        Route::get('/workstation', 'index')->name('workstation.index');
    });

    Route::get('/user/{id}', [UserController::class, 'showProfile'])->name('user.profile');

    /**
     * --------------------------------------
     * 词条组路由
     * Entry Group Route
     * 
     * 前缀为 entry
     * 名称为 entry.*.*
     * 
     */

    // 根路由组 - Entry
    Route::prefix('entry')->name('entry.')->group(function () {

        // Entry的基本操作 名称为 entry.*
        Route::get('/', [EntryController::class, 'index'])->name('index');
        Route::get('/create', [EntryController::class, 'create'])->name('create');
        Route::post('/', [EntryController::class, 'store'])->name('store');
        Route::get('/{entryId}', [EntryController::class, 'show'])->name('show');
        Route::delete('/{id}', [EntryController::class, 'delete'])->name('delete');
        Route::patch('/softDelete/{id}', [EntryController::class, 'softDelete'])->name('softDelete');
        Route::patch('/restore/{id}', [EntryController::class, 'restore'])->name('restore');
        Route::post('/createEWLink/{entryUuid}', [EntryController::class, 'createEWLink'])->name('createEWLink');
        Route::get('/editgate/{id}', [EntryController::class, 'editgate'])->name('editgate');

        // 显示路由组
        Route::prefix('show')->name('show.')->group(function () {
            Route::get('/{id}/explanation', [EntryController::class, 'showExplanation'])->name('explanation');
            Route::get('/{id}/branch', [EntryController::class, 'showBranch'])->name('branch');
            Route::get('/{id}/community', [EntryController::class, 'showCommunity'])->name('community');
            Route::get('/{id}/album', [EntryController::class, 'showAlbum'])->name('album');
            Route::get('/{id}/details', [EntryController::class, 'showDetails'])->name('details');
            Route::get('/{id}/control', [EntryController::class, 'showControl'])->name('control');

            

            //entry中branch逻辑区 无误
            Route::prefix('branch')->name('branch.')->group(function () {
                //Route::get('/{id}/', [EntryController::class, ''])->name('');
                Route::get('/{id}/myBranches', [EntryController::class, 'myBranches'])->name('myBranches');
                Route::get('/{id}/BranchesList', [EntryController::class, 'BranchesList'])->name('BranchesList');
                Route::get('/{id}/createBranch', [EntryController::class, 'createBranch'])->name('createBranch');
                Route::get('/{id}/TaskinProcess', [EntryController::class, 'TaskinProcess'])->name('TaskinProcess');

                //Route::get('/{id}/', [EntryController::class, ''])->name('');
            });//for entry show branch

        });//for show

        // 子路由组 - Branch 名称为 entry.branch.*
        Route::prefix('branch')->name('branch.')->group(function () {
            Route::get('/{branchId}', [EntryBranchController::class, 'show'])->name('show');
            Route::get('/{entryId}/list', [EntryBranchController::class, 'branchList'])->name('list');//分支列表
            Route::get('/{entryId}/create', [EntryBranchController::class, 'create'])->name('create');
            Route::post('/{entryId}', [EntryBranchController::class, 'store'])->name('store');
            Route::patch('/', [EntryBranchController::class, 'update'])->name('update');
            Route::post('/createEWLink/{branchUuid}', [EntryBranchController::class, 'createEWLink'])->name('createEWLink');
            //
            Route::get('/addeditor/branch/{branchId}/user/{userId}/', [EntryBranchController::class, 'addeditor'])->name('addeditor');
            Route::get('/deleteeditor/branch/{branchId}/user/{userId}/', [EntryBranchController::class, 'deleteeditor'])->name('deleteeditor');
            Route::get('/deleteversion/branch/{branchId}/version/{versionId}', [EntryBranchController::class, 'deleteversion'])->name('deleteversion');
            Route::get('/changeDemoVersion/branch/{branchId}/version/{newDemoVersionId}', [EntryBranchController::class, 'changeDemoVersion'])->name('changeDemoVersion');
            Route::get('/VersionAccept/branch/{branchId}/version/{newVersionId}', [EntryBranchController::class, 'VersionAccept'])->name('VersionAccept');
            //Route::get('/', [EntryBranchController::class, ''])->name('');
            // 其他 EntryBranchController 的路由
            
            Route::prefix('show')->name('show.')->group(function () {
            //Route::get('/{id}/', [EntryBranchController::class, ''])->name('');
                Route::get('/{id}/showDemoVersion', [EntryBranchController::class, 'showDemoVersion'])->name('showDemoVersion');
                Route::get('/{id}/showVersionList', [EntryBranchController::class, 'showVersionList'])->name('showVersionList');
                Route::get('/{id}/showInfo', [EntryBranchController::class, 'showInfo'])->name('showInfo');
                Route::get('/{id}/showEditors', [EntryBranchController::class, 'showEditors'])->name('showEditors');
                Route::get('/{id}/showControl', [EntryBranchController::class, 'showControl'])->name('showControl');

                Route::prefix('control')->name('control.')->group(function () {

                    Route::get('/{id}/pushRequests', [EntryBranchController::class, 'pushRequests'])->name('pushRequests');
                    Route::get('/{id}/EditorGroup', [EntryBranchController::class, 'EditorGroup'])->name('EditorGroup');
                    Route::get('/{id}/VersionList', [EntryBranchController::class, 'VersionList'])->name('VersionList');
                    Route::get('/{id}/GenreralSetting', [EntryBranchController::class, 'GenreralSetting'])->name('GenreralSetting');
                    Route::get('/{id}/pullRule', [EntryBranchController::class, 'pullRule'])->name('pullRule');
                });// for control
            });// for show
        });//for branch

        // 子路由组 - Branch下的BranchUser 名称为 entry.branchUser.* 
        Route::prefix('branchUser/{branchId}')->name('branchUser.')->group(function () {
            Route::post('/addUser', [EntryBranchUserController::class, 'addUser'])->name('addUser');
            Route::delete('/removeUser/{userId}', [EntryBranchUserController::class, 'removeUser'])->name('removeUser');
            Route::get('/{userId}/user/{entryId}/entry', [EntryBranchUserController::class, 'showUsersBranches'])->name('brancheslist');//展示这个用户所持有的当前词条下的分支
            // 其他 EntryBranchUserController 的路由
        });

        // 子路由组 - Branch下的Version branchUser. 名称为entry.version.*
        Route::prefix('version')->name('version.')->group(function () {
            Route::get('/show/{versionId}', [EntryVersionController::class, 'show'])->name('show');
            Route::get('/{branchId}/list', [EntryVersionController::class, 'versionList'])->name('list'); // 版本列表
            Route::get('/{branchId}/create/from/{versionId}', [EntryVersionController::class, 'create'])->name('create');//创建分支下的版本
            Route::post('/{branchId}', [EntryVersionController::class, 'store'])->name('store');
            Route::patch('/{versionId}', [EntryVersionController::class, 'update'])->name('update');
            Route::post('/createEWLink/{versionUuid}', [EntryVersionController::class, 'createEWLink'])->name('createEWLink');

            Route::get('/editor/{editorId}', [EntryVersionController::class, 'editor'])->name('editor');//entry.version.editor
            Route::get('/contentcensor/id={versionId}', [EntryVersionController::class, 'contentCensorShow'])->name('contentCensorShow');//entry.version.contentCensorShow 内容审核区域
            Route::post('/contentcensor/handleContentCensor', [EntryVersionController::class, 'handleContentCensor'])->name('handleContentCensor');//entry.version.handleContentCensor 内容审核区域

            // 其他 EntryVersionController 的路由
        });


        //审核路由组
        Route::prefix('censor')->name('censor.')->group(function () {
            Route::get('/', [EntryVersionCensorController::class, 'index'])->name('index');

        });
    });//for entry

    /**
     * --------------------------------------
     * 讨论组
     * Discuss Group Route
     * 
     * 
     */


    // Wall routes
    Route::prefix('wall')->name('wall.')->group(function () {
        Route::get('/', [WallController::class, 'index'])->name('index');
        Route::get('/create', [WallController::class, 'create'])->name('create');
        Route::post('/', [WallController::class, 'store'])->name('store');
        Route::get('/{wall}', [WallController::class, 'show'])->name('show');
        Route::get('/{wall}/edit', [WallController::class, 'edit'])->name('edit');
        Route::put('/{wall}', [WallController::class, 'update'])->name('update');
        Route::delete('/{wall}', [WallController::class, 'destroy'])->name('destroy');
    });

    // Topic routes
    Route::prefix('topic')->name('topic.')->group(function () {
        Route::get('/', [TopicController::class, 'index'])->name('index');
        Route::get('/create', [TopicController::class, 'create'])->name('create');
        Route::post('/', [TopicController::class, 'store'])->name('store');
        Route::get('/{topic}', [TopicController::class, 'show'])->name('show');
        Route::get('/{topic}/edit', [TopicController::class, 'edit'])->name('edit');
        Route::put('/{topic}', [TopicController::class, 'update'])->name('update');
        Route::delete('/{topic}', [TopicController::class, 'destroy'])->name('destroy');
    });

    // Comment routes
    Route::prefix('comment')->name('comment.')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('index');
        Route::get('/create', [CommentController::class, 'create'])->name('create');
        Route::post('/', [CommentController::class, 'store'])->name('store');
        Route::get('/{comment}', [CommentController::class, 'show'])->name('show');
        Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('edit');
        Route::put('/{comment}', [CommentController::class, 'update'])->name('update');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });


    /**
     * ---------------------------------------
     * 运营组
     * Execution Group Route
     * 
     * 
     */
    // Report routes
    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/create', [ReportController::class, 'create'])->name('create');
        Route::post('/', [ReportController::class, 'store'])->name('store');
        Route::get('/{report}', [ReportController::class, 'show'])->name('show');
        Route::get('/{report}/edit', [ReportController::class, 'edit'])->name('edit');
        Route::put('/{report}', [ReportController::class, 'update'])->name('update');
        Route::delete('/{report}', [ReportController::class, 'destroy'])->name('destroy');
    }); 

    Route::resource('roles', RoleController::class);

    /**
     * ------------------------
     * 分类组
     * Category Group
     * 
     */
    Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
    // 分类树(Tree)相关路由
    Route::prefix('trees')->name('trees.')->group(function () {
        Route::get('/', [TreeController::class, 'index'])->name('index');
        Route::get('/create', [TreeController::class, 'create'])->name('create');
        Route::post('/', [TreeController::class, 'store'])->name('store');
        Route::get('/{tree}', [TreeController::class, 'show'])->name('show');
        Route::get('/{tree}/edit', [TreeController::class, 'edit'])->name('edit');
        Route::patch('/{tree}', [TreeController::class, 'update'])->name('update');
        Route::delete('/{tree}', [TreeController::class, 'destroy'])->name('destroy');
        Route::post('/createEWLink/{treeUuid}', [TreeController::class, 'createEWLink'])->name('createEWLink');
    });

    // DAG节点(Node)相关路由
    Route::prefix('nodes')->name('nodes.')->group(function () {
        Route::get('/', [NodeController::class, 'index'])->name('index');
        Route::get('/create', [NodeController::class, 'create'])->name('create');
        Route::post('/', [NodeController::class, 'store'])->name('store');
        Route::get('/{node}', [NodeController::class, 'show'])->name('show');
        Route::get('/{node}/edit', [NodeController::class, 'edit'])->name('edit');
        Route::patch('/{node}', [NodeController::class, 'update'])->name('update');
        Route::delete('/{node}', [NodeController::class, 'destroy'])->name('destroy');
        Route::post('/createEWLink/{nodeUuid}', [NodeController::class, 'createEWLink'])->name('createEWLink');
    });

    // DAG边(Edge)相关路由
    Route::prefix('edges')->name('edges.')->group(function () {
        Route::get('/', [EdgeController::class, 'index'])->name('index');
        Route::get('/create', [EdgeController::class, 'create'])->name('create');
        Route::post('/', [EdgeController::class, 'store'])->name('store');
        Route::get('/{edge}', [EdgeController::class, 'show'])->name('show');
        Route::get('/{edge}/edit', [EdgeController::class, 'edit'])->name('edit');
        Route::patch('/{edge}', [EdgeController::class, 'update'])->name('update');
        Route::delete('/{edge}', [EdgeController::class, 'destroy'])->name('destroy');
        Route::post('/createEWLink/{edgeUuid}', [EdgeController::class, 'createEWLink'])->name('createEWLink');
    });

    // 使用'dag'作为前缀
    Route::prefix('dag')->name('dag.')->group(function () {
        Route::get('/index', [DAGController::class, 'index'])->name('index');
        Route::get('/createNode', [DAGController::class, 'createNode'])->name('createNode');
        Route::post('/storeNode', [DAGController::class, 'storeNode'])->name('storeNode');
        Route::get('/Node/{id}', [DAGController::class, 'showNode'])->name('showNode');
        Route::get('/editNode/{id}', [DAGController::class, 'editNode'])->name('editNode');
        Route::patch('/updateNode/{id}', [DAGController::class, 'updateNode'])->name('updateNode');
        Route::delete('/deleteNode/{id}', [DAGController::class, 'deleteNode'])->name('deleteNode');

        Route::get('/createEdge', [DAGController::class, 'createEdge'])->name('createEdge');
        Route::post('/storeEdge', [DAGController::class, 'storeEdge'])->name('storeEdge');
        Route::get('/Edge/{id}', [DAGController::class, 'showEdge'])->name('showEdge');
        Route::get('/editEdge/{id}', [DAGController::class, 'editEdge'])->name('editEdge');
        Route::patch('/updateEdge/{id}', [DAGController::class, 'updateEdge'])->name('updateEdge');
        Route::delete('/deleteEdge/{id}', [DAGController::class, 'deleteEdge'])->name('deleteEdge');

        // 这里可以继续添加其他DAG相关的路由
    });

    /**
     * ----------------------
     * 相册组
     * Albums Group
     * 
     * 
     * 
     */


    // Medias 路由组
    Route::prefix('medias')->name('medias.')->group(function () {
        Route::get('/', [MediasController::class, 'index'])->name('index');
        Route::get('/create', [MediasController::class, 'create'])->name('create');
        Route::post('/', [MediasController::class, 'store'])->name('store');
        Route::get('/{media}', [MediasController::class, 'show'])->name('show');
        Route::delete('/{media}', [MediasController::class, 'delete'])->name('delete');
        Route::get('/{media}/edit', [MediasController::class, 'edit'])->name('edit');
        Route::put('/{media}', [MediasController::class, 'update'])->name('update');
    });

    // Albums 路由组
    Route::prefix('albums')->name('albums.')->group(function () {
        Route::get('/', [AlbumsController::class, 'index'])->name('index');
        Route::get('/create', [AlbumsController::class, 'create'])->name('create');
        Route::post('/', [AlbumsController::class, 'store'])->name('store');
        Route::get('/{id}', [AlbumsController::class, 'show'])->name('show');
        Route::get('/{album}/edit', [AlbumsController::class, 'edit'])->name('edit');
        Route::put('/{album}', [AlbumsController::class, 'update'])->name('update');
        Route::delete('/{album}', [AlbumsController::class, 'delete'])->name('delete');
    });

    /**
     * -----------------------------
     * 审核组
     * censor route group
     * 
     * 
     * 
     */

    // 使用 CensorTaskController 控制器，并为所有路由定义一个共同的前缀 'censor'
    Route::prefix('censor')->name('censor.')->group(function () {
        Route::controller(CensorTaskController::class)->group(function () {
            
            // 获取任务列表的路由
            Route::get('/tasks', 'index')->name('tasks.index');

            // 列出不同类型任务的路由
            Route::get('/tasks/list/entry', 'entryTaskList')->name('tasks.list.entry');
            Route::get('/tasks/list/branch', 'branchTaskList')->name('tasks.list.branch');
            Route::get('/tasks/list/version', 'versionTaskList')->name('tasks.list.version');
            Route::get('/tasks/list/task', 'taskTaskList')->name('tasks.list.task');
            Route::get('/tasks/list/wall', 'wallTaskList')->name('tasks.list.wall');
            Route::get('/tasks/list/topic', 'topicTaskList')->name('tasks.list.topic');
            Route::get('/tasks/list/comment', 'commentTaskList')->name('tasks.list.comment');
            Route::get('/tasks/list/media', 'mediaTaskList')->name('tasks.list.media');
            Route::get('/tasks/list/album', 'albumTaskList')->name('tasks.list.album');
            Route::get('/tasks/list/tree', 'treeTaskList')->name('tasks.list.tree');
            Route::get('/tasks/list/node', 'nodeTaskList')->name('tasks.list.node');
            Route::get('/tasks/list/edge', 'edgeTaskList')->name('tasks.list.edge');

            // 根据 ID 获取特定任务的路由
            Route::get('/tasks/entry/{id}', 'entryTask')->name('tasks.entry');
            Route::get('/tasks/branch/{id}', 'branchTask')->name('tasks.branch');
            Route::get('/tasks/version/{id}', 'versionTask')->name('tasks.version');
            Route::get('/tasks/task/{id}', 'taskTask')->name('tasks.task');
            Route::get('/tasks/wall/{id}', 'wallTask')->name('tasks.wall');
            Route::get('/tasks/topic/{id}', 'topicTask')->name('tasks.topic');
            Route::get('/tasks/comment/{id}', 'commentTask')->name('tasks.comment');
            Route::get('/tasks/media/{id}', 'mediaTask')->name('tasks.media');
            Route::get('/tasks/album/{id}', 'albumTask')->name('tasks.album');
            Route::get('/tasks/tree/{id}', 'treeTask')->name('tasks.tree');
            Route::get('/tasks/edge/{id}', 'edgeTask')->name('tasks.edge');
            Route::get('/tasks/node/{id}', 'nodeTask')->name('tasks.node');

            // 处理更新任务的 POST 路由
            Route::post('/tasks/update/entry', 'handleEntryTask')->name('tasks.update.entry');
            Route::post('/tasks/update/branch', 'handleBranchTask')->name('tasks.update.branch');
            Route::post('/tasks/update/version', 'handleVersionTask')->name('tasks.update.version');
            Route::post('/tasks/update/task', 'handleTaskTask')->name('tasks.update.task');
            Route::post('/tasks/update/wall', 'handleWallTask')->name('tasks.update.wall');
            Route::post('/tasks/update/topic', 'handleTopicTask')->name('tasks.update.topic');
            Route::post('/tasks/update/comment', 'handleCommentTask')->name('tasks.update.comment');
            Route::post('/tasks/update/media', 'handleMediaTask')->name('tasks.update.media');
            Route::post('/tasks/update/album', 'handleAlbumTask')->name('tasks.update.album');
            Route::post('/tasks/update/tree', 'handleTreeTask')->name('tasks.update.tree');
            Route::post('/tasks/update/edge', 'handleEdgeTask')->name('tasks.update.edge');
            Route::post('/tasks/update/node', 'handleNodeTask')->name('tasks.update.node');
        });
    });

});