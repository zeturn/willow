<?php

namespace App\Http\Controllers;

use App\Models\Node;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NodeController extends Controller
{
    /**
     * 显示节点列表的页面。
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $nodes = Node::paginate(20); // 获取所有节点
        return view('nodes.index', compact('nodes'));
    }

    /**
     * 显示创建新节点的表单。
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        return view('nodes.create'); // 返回创建节点的视图
    }

    /**
     * 存储新创建的节点到数据库。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $nodeData = $request->all();

        // 检查是否提供了status，如果没有，则默认为5
        if (!isset($nodeData['status'])) {
            $nodeData['status'] = 5;
        }
   
        $node = Node::create($nodeData); // 创建节点并保存
 
        $node->createCensorTask();

        return redirect()->route('nodes.show', $node->id); // 重定向到节点详情页
    }

    /**
     * 显示指定节点的详情。
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\View\View
     */
    public function show(Node $node)
    {
        $walls = $node->walls;
        $adjacentNodesAndEdges = $node->getAdjacentNodesAndEdges();
        return view('nodes.show', compact('node','walls', 'adjacentNodesAndEdges')); // 返回节点详情视图
    }

    /**
     * 显示编辑指定节点的表单。
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\View\View
     */
    public function edit(Node $node)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        return view('nodes.edit', compact('node')); // 返回节点编辑视图
    }

    /**
     * 更新指定节点的数据库记录。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {

        $node->update($request->all()); // 更新节点信息

        return redirect()->route('nodes.show', $node->id); // 重定向到节点详情页
    }

    /**
     * 从数据库中移除指定节点。
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $node->delete(); // 删除节点

        return redirect()->route('nodes.index'); // 重定向到节点列表页
    }

    /**
     * 创建 Node 和 Wall 之间的关联。
     *
     * @param Request $request
     * @param string  $nodeUuid Node 实体的 UUID
     * @return \Illuminate\Http\Response
     */
    public function createEWLink(Request $request, $nodeUuid)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        // 验证请求数据
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 查找 Node 实体
        $node = Node::where('id', $nodeUuid)->first();
        if (!$node) {
            return response()->json(['error' => 'Node not found'], 404);
        }

        // 创建 Wall 和 Node 之间的链接
        try {
            $wallData = $request->only(['name', 'slug', 'description']);
            $entityWallAssociation = $node->createEWLink($wallData);

            return response()->json(['message' => 'Link created successfully', 'link' => $entityWallAssociation], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create link'], 500);
        }
    }
}
