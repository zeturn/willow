<?php

// app/Http/Controllers/WallController.php

namespace App\Http\Controllers;

use App\Models\Wall;
use App\Models\Topic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WallController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:wall-index', ['only' => ['index']]);
        $this->middleware('permission:wall-create', ['only' => ['create','store']]);
        $this->middleware('permission:wall-editt', ['only' => ['edit','update']]);
        $this->middleware('permission:wall-delete-soft-delete', ['only' => ['softDelete']]);//一般用户，仅可以软删除
        $this->middleware('permission:wall-delete', ['only' => ['destroy', 'softDelete', 'restore']]);//高级用户，删除、软删除、恢复
    }
    
    /**
     * Display a listing of the resource.
     * 显示资源的列表。
     *
     * This method retrieves all Wall instances from the database.
     * It includes error handling for potential database query failures.
     * 此方法从数据库中检索所有 Wall 实例。
     * 它包括对潜在数据库查询失败的错误处理。
     * 
     * @return \Illuminate\Http\Response Response object with the Wall data or an error message.
     * @return \Illuminate\Http\Response 包含 Wall 数据或错误消息的响应对象。
     */
    public function index()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        try {
            // Retrieve all Wall instances from the database / 从数据库中检索所有 Wall 实例
            $walls = Wall::all();

            // Return the view with the Wall data / 返回带有 Wall 数据的视图
            return view('walls.index', compact('walls'));
        } catch (QueryException $e) {
            // Handle database query failure / 处理数据库查询失败
            // Log the error and return a custom error view or message / 记录错误并返回自定义错误视图或消息
            // Use a logging mechanism here / 在此使用日志记录机制
            return response()->view('errors.database', [], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     * 显示创建新资源的表单。
     *
     * This method returns the view for creating a new Wall instance.
     * It includes error handling for scenarios where the view might not be accessible or found.
     * 此方法返回用于创建新 Wall 实例的视图。
     * 它包括对视图可能无法访问或找不到的情况的错误处理。
     * 
     * @return View|Factory|Application|Illuminate\Http\RedirectResponse View object for creating a Wall or a redirection on error.
     * @return View|Factory|Application|Illuminate\Http\RedirectResponse 创建 Wall 的视图对象或发生错误时的重定向。
     */
    public function create()
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }
        
        try {
            // Return the view for creating a new Wall / 返回创建新 Wall 的视图
            return view('walls.create');
        } catch (\Exception $e) {
            // Handle the case where the view cannot be loaded / 处理无法加载视图的情况
            // Log the error and redirect to a suitable error page or display an error message / 记录错误并重定向到适当的错误页面或显示错误消息
            // Use a logging mechanism here / 在此使用日志记录机制
            return response()->view('errors.view', [], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * 在存储中创建并保存一个新资源。
     *
     * This method handles the creation of a new Wall record. It includes validation
     * to ensure that the incoming request contains valid data, and error handling to
     * deal with potential database write failures.
     * 此方法用于创建一个新的 Wall 记录。它包括验证以确保传入请求包含有效数据，
     * 并处理可能的数据库写入失败的错误。
     * 
     * @param Request $request The incoming request object.
     * @param Request $request 传入的请求对象。
     * @return \Illuminate\Http\RedirectResponse Redirect response on success or failure.
     * @return \Illuminate\Http\RedirectResponse 成功或失败时的重定向响应。
     */
    public function store(Request $request)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        // Validate the request data / 验证请求数据
        $validatedData =$request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        //slug区域
        $originalSlug = Str::slug($validatedData['name'], '-');
        // 检查slug的唯一性
        $slug =$originalSlug;
        $increment = 1;
        while (Wall::where('slug', $slug)->exists()) {
            $slug =$originalSlug . '-' . $increment++;
        }

        try {
            // Attempt to create a new Wall record / 尝试创建新的 Wall 记录
            Wall::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'slug' => $slug, // 使用生成的唯一slug
                'status' => 5, // 设置默认状态
                'eid' => $request->eid,
            ]);

            // 使用 session() 辅助函数设置 session 数据
            session()->flash('message','Wall创建成功！');
            // Redirect to the wall index route on success / 成功时重定向到 wall 索引路由
            return redirect()->route('wall.index');
        } catch (QueryException $exception) {
            // Handle database write failure / 处理数据库写入失败
            // Log the error and redirect back with a custom error message / 记录错误并重定向回去，并显示自定义错误消息
            // Use a logging mechanism here / 在此使用日志记录机制
            return redirect()->back()->with('error', 'Database write failed.')->withInput();
        }
    }

    public function edit(Wall $wall)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        return view('walls.edit', compact('wall'));
    }

    public function update(Request $request, Wall $wall)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $wall->update($request->all());
        return redirect()->route('wall.index');
    }

    /**
     * Display the specified resource.
     * 显示指定的资源。
     *
     * This method retrieves and shows a specific Wall instance along with its related topics.
     * The method includes handling for cases where the Wall instance might not be found.
     * 此方法检索并显示特定的 Wall 实例及其相关话题。
     * 该方法包括处理找不到 Wall 实例的情况。
     * 
     * @param Wall $wall The Wall instance to be displayed.
     * @param Wall $wall 要显示的 Wall 实例。
     * @return \Illuminate\Http\Response Response object with the Wall data and its topics or a not found message.
     * @return \Illuminate\Http\Response 包含 Wall 数据及其话题或未找到消息的响应对象。
     */
    public function show(Wall $wall)
    {
        try {
            // Retrieve topics related to the Wall instance, with pagination / 检索与 Wall 实例相关的话题，使用分页
            $topics = $wall->topics()->paginate(10); // Pagination, 10 items per page / 分页显示，每页10条

            // Return the view with the Wall instance and its topics / 返回视图和 Wall 实例及其话题
            return view('walls.show', compact('wall', 'topics'));
        } catch (ModelNotFoundException $e) {
            // Handle the case where the Wall instance is not found / 处理找不到 Wall 实例的情况
            // Redirect to a suitable error page or display an error message / 重定向到适当的错误页面或显示错误消息
            return response()->view('errors.not-found', [], 404);
        }
    }
    /**
     * 删除指定的墙实例。
     * Delete the specified Wall instance.
     * 此方法增加了权限检查以确保用户有权进行删除操作，并对删除过程进行异常处理。
     * This method includes a permission check to ensure the user has the right to perform the deletion and handles exceptions that might occur during the deletion process.
     *
     * @param  Wall  $wall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wall $wall)
    {
        // 检查用户是否已经登录 / Check if the user is authenticated
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        // TODO: 检查当前用户是否有权限删除此墙实例 / Check if the current user has permission to delete this Wall instance
        // 这里应当根据应用的业务逻辑来实现具体的权限检查逻辑 / The specific permission checking logic should be implemented based on the application's business logic
        
        try {
            $wall->delete();
            // 删除成功，返回成功消息 / Deletion successful, return with a success message
            return back()->with('success', 'Wall deleted successfully.');
        } catch (\Exception $e) {
            // 删除失败，返回错误消息 / Deletion failed, return with an error message
            return back()->with('error', 'Failed to delete the wall.');
        }
    }
}
