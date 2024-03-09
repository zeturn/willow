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

    EntryController,
    EntryBranchController,
    EntryBranchUserController,
    EntryVersionController,
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/media/upload', [MediasController::class, 'store'])->name('media.upload');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/hi', function (Request $request) {
        return 'hi!!!';
    });
});