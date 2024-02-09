<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Media;
use App\Models\AlbumsMediaAssociation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumsController extends Controller
{

    function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('permission:album-index', ['only' => ['index']]);
        $this->middleware('permission:album-create', ['only' => ['create','store']]);
        $this->middleware('permission:album-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:album-delete-soft-delete', ['only' => ['softDelete']]);//一般用户，仅可以软删除
        $this->middleware('permission:album-delete', ['only' => ['destroy', 'softDelete', 'restore']]);//高级用户，删除、软删除、恢复
    }

    public function index()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $albums = Album::with('medias')->get(); // 获取所有相册及其关联的媒体

        return view('albums.index', compact('albums'));
    }
    
    public function create()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        return view('albums.create');
    }



    public function store(Request $request)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $request->validate([
            'title' => 'required|string',
            'photos' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $album = Album::create([
            'title' => $request->title,
            'user_id' => auth()->id(), // 假设用户已登录
            'status' => 1, // 设置状态或其他必要字段
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $url = $photo->store('photos', 'public');
                $media = Media::create([
                    'url' => $url,
                    'user_id' => auth()->id(),
                    'status' => 1, // 设置状态或其他必要字段
                ]);

                AlbumsMediaAssociation::create([
                    'album_id' => $album->id,
                    'media_id' => $media->id,
                ]);
            }
        }

        $album->createCensorTask();

        return redirect()->route('albums.show', $album->id);
    }

    public function show($id)
    {
        $album = Album::with('medias')->findOrFail($id);

        return view('albums.show', compact('album'));
    }

    public function edit($id)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $album = Album::with('medias')->findOrFail($id);

        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $album = Album::with('medias')->findOrFail($id);

        // 更新相册标题等信息
        $album->update([
            'title' => $request->input('title'),
            'user_id' => auth()->id(), // 或根据实际情况调整
            'status' => 1, // 或根据实际情况调整
        ]);

        $existingPhotos = $request->input('existing_photos', []);
        $newPhotos = $request->file('photos', []);

        // 处理新上传的图片
        foreach ($newPhotos as $photo) {
            $url = $photo->store('photos', 'public');
            $media = Media::create([
                'url' => $url,
                'user_id' => auth()->id(),
                'status' => 1, // 设置状态或其他必要字段
            ]);

            AlbumsMediaAssociation::create([
                'album_id' => $album->id,
                'media_id' => $media->id,
            ]);
        }

        // 处理被删除的图片
        foreach ($album->medias as $media) {
            if (!in_array($media->id, $existingPhotos)) {
                $media->delete(); // 或者根据需要处理删除逻辑
                AlbumsMediaAssociation::where('album_id', $album->id)
                                    ->where('media_id', $media->id)
                                    ->delete();
            }
        }

        return redirect()->route('albums.show', $album->id);
    }

    public function delete($id)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        
        $album = Album::with('medias')->findOrFail($id);

        // 删除与相册关联的所有媒体关联
        foreach ($album->medias as $media) {
            AlbumsMediaAssociation::where('album_id', $album->id)
                                  ->where('media_id', $media->id)
                                  ->delete();
            $media->forceDelete(); // 如果您也想删除相关的媒体记录
        }

        // 永久删除相册
        $album->forceDelete();

        return redirect()->route('albums.index')->with('success', '相册已被删除');
    }

}
