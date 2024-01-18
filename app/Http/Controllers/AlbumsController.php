<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Media;
use App\Models\AlbumsMediaAssociation;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{

    public function index()
    {
        $albums = Album::with('medias')->get(); // 获取所有相册及其关联的媒体

        return view('albums.index', compact('albums'));
    }
    
    public function create()
    {
        return view('albums.create');
    }



    public function store(Request $request)
    {
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

        return redirect()->route('albums.show', $album->id);
    }

    public function show($id)
    {
        $album = Album::with('medias')->findOrFail($id);

        return view('albums.show', compact('album'));
    }

    public function edit($id)
    {
        $album = Album::with('medias')->findOrFail($id);

        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
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
