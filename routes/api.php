<?php

/**
 * 文件名: api.php
 *
 * api路由定义
 *
 *
 * @package    willow
 * @subpackage null
 * @author     Henry
 * @license    null
 * @version    null
 * @link       null
 * @see        null相关文件或类的链接
 * @since      2023-11
 * @deprecated False
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

use App\Http\Controllers\{

    WorkstationController,

    EntryBranchUserController,
    EntryVersionCensorController,

    WallController,
    TopicController,
    CommentController,

    ReportController,

    CategoryController,
    TreeController,
    NodeController,
    EdgeController,
    DCGController,

    MediasController,
    AlbumsController,

};

use App\Http\Controllers\API\{
    EntryApiController,
    EntryBranchApiController,
    //EntryVerisonApiController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('')->name('api.')->group(function () {
Route::middleware(['throttle:api'])->group(function () {
Route::middleware(['auth:api'])->group(function () {
    
Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});

Route::post('/media/upload', [MediasController::class, 'store'])->name('media.upload');

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
Route::middleware('auth:api')->prefix('entry')->name('entry.')->group(function () {

        // Entry的基本操作 名称为 entry.*
        #Route::get('/', [EntryApiController::class, 'index'])->name('index');
        #Route::get('/create', [EntryApiController::class, 'create'])->name('create');
        #Route::post('/store', [EntryApiController::class, 'store'])->name('store');
        Route::post('/store/force', [EntryApiController::class, 'store_force'])->name('store_force');
        Route::get('/{entryId}', [EntryApiController::class, 'show'])->name('show');
        Route::delete('/{id}', [EntryApiController::class, 'delete'])->name('delete');
        Route::patch('/softDelete/{id}', [EntryApiController::class, 'softDelete'])->name('softDelete');
        Route::patch('/restore/{id}', [EntryApiController::class, 'restore'])->name('restore');
        Route::post('/createEWLink/{entryUuid}', [EntryApiController::class, 'createEWLink'])->name('createEWLink');

        // 显示路由组 名称为 entry.show.*
        /*Route::prefix('show')->name('show.')->group(function () {
            
            Route::get('/{id}/explanation', [EntryApiController::class, 'showExplanation'])->name('explanation');
            Route::get('/{id}/branch', [EntryApiController::class, 'showBranch'])->name('branch');
            Route::get('/{id}/community', [EntryApiController::class, 'showCommunity'])->name('community');
            Route::get('/{id}/album', [EntryApiController::class, 'showAlbum'])->name('album');
            Route::get('/{id}/details', [EntryApiController::class, 'showDetails'])->name('details');

            // 控制路由组 名称为 entry.show.control.*
            Route::prefix('control')->name('control.')->group(function () {

                Route::get('/{id}/generalsetting', [EntryApiController::class, 'GeneralSetting'])->name('GeneralSetting');

            });// for entry control
            

            //entry中 branch逻辑区 无误 名称为 entry.show.branch.*
            Route::prefix('branch')->name('branch.')->group(function () {
                //Route::get('/{id}/', [EntryApiController::class, ''])->name('');
                Route::get('/{id}/myBranches', [EntryApiController::class, 'myBranches'])->name('myBranches');
                Route::get('/{id}/BranchesList', [EntryApiController::class, 'BranchesList'])->name('BranchesList');
                Route::get('/{id}/createBranch', [EntryApiController::class, 'createBranch'])->name('createBranch');
                Route::get('/{id}/TaskinProcess', [EntryApiController::class, 'TaskinProcess'])->name('TaskinProcess');

                //Route::get('/{id}/', [EntryApiController::class, ''])->name('');
            });//for entry show branch

        });//for entry show*/

        // 子路由组 - Branch 名称为 entry.branch.*
        Route::prefix('branch')->name('branch.')->group(function () {
            Route::get('/{branchId}', [EntryBranchApiController::class, 'show'])->name('show');
            Route::get('/{entryId}/list', [EntryBranchApiController::class, 'branchList'])->name('list');//分支列表
            Route::get('/{entryId}/create', [EntryBranchApiController::class, 'create'])->name('create');
            Route::post('/{entryId}', [EntryBranchApiController::class, 'store'])->name('store');
            Route::patch('/', [EntryBranchApiController::class, 'update'])->name('update');
            Route::post('/createEWLink/{branchUuid}', [EntryBranchApiController::class, 'createEWLink'])->name('createEWLink');
            //
            Route::get('/addeditor/branch/{branchId}/user/{userId}/', [EntryBranchApiController::class, 'addeditor'])->name('addeditor');
            Route::get('/deleteeditor/branch/{branchId}/user/{userId}/', [EntryBranchApiController::class, 'deleteeditor'])->name('deleteeditor');
            Route::get('/deleteversion/branch/{branchId}/version/{versionId}', [EntryBranchApiController::class, 'deleteversion'])->name('deleteversion');
            Route::get('/changeDemoVersion/branch/{branchId}/version/{newDemoVersionId}', [EntryBranchApiController::class, 'changeDemoVersion'])->name('changeDemoVersion');
            Route::get('/VersionAccept/branch/{branchId}/version/{newVersionId}', [EntryBranchApiController::class, 'VersionAccept'])->name('VersionAccept');
            //Route::get('/', [EntryBranchApiController::class, ''])->name('');
            
            /*Route::prefix('show')->name('show.')->group(function () {
                //Route::get('/{id}/', [EntryBranchApiController::class, ''])->name('');
                Route::get('/{id}/showDemoVersion', [EntryBranchApiController::class, 'showDemoVersion'])->name('showDemoVersion');
                Route::get('/{id}/showVersionList', [EntryBranchApiController::class, 'showVersionList'])->name('showVersionList');
                Route::get('/{id}/showInfo', [EntryBranchApiController::class, 'showInfo'])->name('showInfo');
                Route::get('/{id}/showEditors', [EntryBranchApiController::class, 'showEditors'])->name('showEditors');
                Route::get('/{id}/showControl', [EntryBranchApiController::class, 'showControl'])->name('showControl');

                Route::prefix('control')->name('control.')->group(function () {

                    Route::get('/{id}/pushRequests', [EntryBranchApiController::class, 'pushRequests'])->name('pushRequests');
                    Route::get('/{id}/EditorGroup', [EntryBranchApiController::class, 'EditorGroup'])->name('EditorGroup');
                    Route::get('/{id}/VersionList', [EntryBranchApiController::class, 'VersionList'])->name('VersionList');
                    Route::get('/{id}/GenreralSetting', [EntryBranchApiController::class, 'GenreralSetting'])->name('GenreralSetting');
                    Route::get('/{id}/pullRule', [EntryBranchApiController::class, 'pullRule'])->name('pullRule');
                });// for branch control
            });// for show*/
        });//for branch

        // 子路由组 - Branch下的BranchUser 名称为 entry.branchUser.* 
        Route::prefix('branchUser/{branchId}')->name('branchUser.')->group(function () {
            Route::post('/addUser', [EntryBranchUserController::class, 'addUser'])->name('addUser');
            Route::delete('/removeUser/{userId}', [EntryBranchUserController::class, 'removeUser'])->name('removeUser');
            Route::get('/{userId}/user/{entryId}/entry', [EntryBranchUserController::class, 'showUsersBranches'])->name('brancheslist');//展示这个用户所持有的当前词条下的分支
            // 其他 EntryBranchUserController 的路由
        });

        // 子路由组 - Branch下的Version branchUser. 名称为entry.version.*
        /*Route::prefix('version')->name('version.')->group(function () {
            Route::get('/show/{versionId}', [EntryVersionApiController::class, 'show'])->name('show');
            Route::get('/{branchId}/list', [EntryVersionApiController::class, 'versionList'])->name('list'); // 版本列表
            Route::get('/{branchId}/create/from/{versionId}', [EntryVersionApiController::class, 'create'])->name('create');//创建分支下的版本
            Route::post('/{branchId}', [EntryVersionApiController::class, 'store'])->name('store');
            Route::patch('/{versionId}', [EntryVersionApiController::class, 'update'])->name('update');
            Route::post('/createEWLink/{versionUuid}', [EntryVersionApiController::class, 'createEWLink'])->name('createEWLink');

            Route::get('/editor/{editorId}', [EntryVersionApiController::class, 'editor'])->name('editor');//entry.version.editor
            Route::get('/contentcensor/id={versionId}', [EntryVersionApiController::class, 'contentCensorShow'])->name('contentCensorShow');//entry.version.contentCensorShow 内容审核区域
            Route::post('/contentcensor/handleContentCensor', [EntryVersionApiController::class, 'handleContentCensor'])->name('handleContentCensor');//entry.version.handleContentCensor 内容审核区域
        });
*/

        //审核路由组
        /*Route::prefix('censor')->name('censor.')->group(function () {
            Route::get('/', [EntryVersionCensorController::class, 'index'])->name('index');
        });*/
    });//for entry

});//middleware(['throttle:api'])
});//middleware(['auth:api'])
});//route api