<?php

namespace App\Http\Controllers;

use App\Models\Media;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediasController extends Controller
{

    function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('permission:media-index', ['only' => ['index']]);
        $this->middleware('permission:media-create', ['only' => ['create','store']]);
        $this->middleware('permission:media-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:media-delete-soft-delete', ['only' => ['softDelete']]);//一般用户，仅可以软删除
        $this->middleware('permission:media-delete', ['only' => ['destroy', 'softDelete', 'restore']]);//高级用户，删除、软删除、恢复
    }
    public function index()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $medias = Media::with('user')->paginate(10); // 假设存在 user() 关联
        return view('medias.index', compact('medias'));
    }
    

    public function create()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        return view('medias.create');
    }

    public function store(Request $request)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $validatedData = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,bmp,gif,svg|max:10240', // 确保文件为图片且大小不超过10MB
        ]);
    
        try {
            $file = $validatedData['file'];
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension(); // 生成唯一文件名
            $url = $file->storeAs('medias', $filename, 'public'); // 存储文件并获取存储路径
    
            $media = new Media();
            $media->url = $url; // 获取可访问的URL
            $media->status = 1;
    
            // 如果用户未登录，使用特定的UUID
            $media->user_id = auth()->check() ? auth()->id() : '2c2ee009-7956-4e7d-b613-387e2d411cd1';
    
            // 其他字段设置
            $media->save();

            $media->createCensorTask();
    
            return response()->json(['id' => $media->id, 'url' => $media->url]); // 返回媒体文件的ID和URL
        } catch (\Exception $e) {
            return response()->json(['error' => '文件上传失败'.$e], 500);
        }
    }
    
    public function show($id)
    {
        $media = Media::findOrFail($id); // 查找媒体文件，如果不存在则抛出404异常

        return view('medias.show', compact('media'));
    }

    public function delete($id)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $media = Media::findOrFail($id);
        $media->deleteWithFile(); // 使用模型中的 deleteWithFile 方法

        return redirect()->route('medias.create')->with('success', '媒体文件已删除');
    }

    public function edit($id)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $media = Media::findOrFail($id);
        return view('medias.edit', compact('media'));
    }

    public function update(Request $request, $id)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        
        $request->validate([
            'description' => 'required|string', // 根据需要调整验证规则
        ]);

        $media = Media::findOrFail($id);
        $media->description = $request->description;
        // 更新其他字段
        $media->save();

        return redirect()->route('medias.show', $media->id)->with('success', '媒体文件已更新');
    }
}
