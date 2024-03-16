<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Edge;
use App\Models\DCG;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DCGController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:dcg-index', ['only' => ['index']]);

        $this->middleware('permission:dcg-node-create', ['only' => ['createNode','storeNode']]);
        $this->middleware('permission:dcg-node-edit', ['only' => ['editNode','updateNode']]);
        $this->middleware('permission:dcg-node-soft-delete', ['only' => ['deleteNode']]);//一般用户，仅可以软删除
        $this->middleware('permission:dcg-node-delete', ['only' => ['deleteNode']]);//高级用户，删除、软删除、恢复

        $this->middleware('permission:dcg-edge-create', ['only' => ['createEdge','storeEdge']]);
        $this->middleware('permission:dcg-edge-edit', ['only' => ['editEdge','updateEdge']]);
        $this->middleware('permission:dcg-edge-soft-delete', ['only' => ['deleteEdge']]);//一般用户，仅可以软删除
        $this->middleware('permission:dcg-edge-delete', ['only' => ['deleteEdge']]);//高级用户，删除、软删除、恢复
    }


    /**
     * 显示DCG的所有节点和边的列表。
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $nodes = Node::paginate(30);
        $edges = Edge::paginate(30);

        // 此处返回DCG总览视图
        return view('dcg.index', compact('nodes', 'edges'));
    }


//--------------------------------------------

    /**
     * 显示创建新节点的表单。
     *
     * @return \Illuminate\View\View
     */
    public function createNode()
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        // 此处返回创建节点的视图
        return view('dcg.createNode');
    }

    /**
     * 存储新创建的节点到数据库。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNode(Request $request)
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

        //使用session创建提示
        session()->flash('message','Node：'.$node?->name.'创建成功！');

        return redirect()->route('nodes.show', $node->id); // 重定向到节点详情页
    }

    /**
     * 显示指定节点的详情。
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function showNode($id)
    {
        $node = Node::findOrFail($id);
        $walls = $node->walls;
        $adjacentNodesAndEdges = $node->getAdjacentNodesAndEdges();
        $entries = $node->entries;

        // 此处返回节点详情视图
        return view('dcg.showNode', compact('node','walls', 'adjacentNodesAndEdges', 'entries'));
    }

    /**
     * 显示编辑指定节点的表单。
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function editNode($id)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $node = Node::findOrFail($id);

        // 此处返回节点编辑视图
        return view('dcg.editNode', compact('node'));
    }

    /**
     * 更新指定节点的数据库记录。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function updateNode(Request $request, $id)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $node = Node::findOrFail($id); // 根据ID查找节点

        $node->update($request->all()); // 更新节点信息

        //使用session创建提示
        session()->flash('message','Node：'.$node?->name.'更新成功！');

        return redirect()->route('nodes.show', $node->id); // 重定向到节点详情页
    }

    /**
     * 从数据库中移除指定节点。
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteNode($id)
    {

        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $node = Node::findOrFail($id);
        $node->delete();

        //使用session创建提示
        session()->flash('message','Node：'.$node?->name.'删除成功！');

        // 返回删除成功的响应
        return redirect()->route('nodes.index');
    }

//---------------------------------------------------

    /**
     * 显示创建新边的表单。
     *
     * @return \Illuminate\View\View
     */
    public function createEdge()
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        // 此处返回创建边的视图
        return view('dcg.createEdge');
    }

    /**
     * 存储新创建的边到数据库。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEdge(Request $request)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $validator = Validator::make($request->all(), [
            'start_node' => 'required|exists:nodes,id',
            'end_node' => 'required|exists:nodes,id|different:start_node',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $edgeData = $request->all();

        // 如果未提供status，则默认为5
        if (!isset($edgeData['status'])) {
            $edgeData['status'] = 5;
        }
        
        $edge = Edge::create($edgeData); // 创建边并保存
        //使用session创建提示
        session()->flash('message','Edge删除成功！');
        return redirect()->route('edges.show', $edge->id); // 重定向到边详情页
    }

    /**
     * 显示指定边的详情。
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function showEdge($id)
    {
        $edge = Edge::findOrFail($id);

        // 此处返回边详情视图
        return view('dcg.showEdge', compact('edge'));
    }

    /**
     * 显示编辑指定边的表单。
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function editEdge($id)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $edge = Edge::findOrFail($id);

        // 此处返回边编辑视图
        return view('dcg.editEdge', compact('edge'));
    }

    /**
     * 更新指定边的数据库记录。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEdge(Request $request, $id)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $edge = Edge::findOrFail($id); // 根据ID查找节点

        $edge->update($request->all()); // 更新边信息
        //使用session创建提示
        session()->flash('message','Edge删除成功！');
        return redirect()->route('edges.show', $edge->id); // 重定向到边详情页
    }

    /**
     * 从数据库中移除指定边。
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteEdge($id)
    {
        // 检查用户是否已经登录（如果需要） / Check if the user is authenticated (if required)
        if (!Auth::check()) {
            // 如果用户未登录，重定向到登录页面 / If the user is not authenticated, redirect to the login page
            return redirect()->route('login'); // 确保你的路由文件中定义了 'login' 路由 / Make sure the 'login' route is defined in your routes file
        }

        $edge = Edge::findOrFail($id);
        $edge->delete();
        //使用session创建提示
        session()->flash('message','Edge删除成功！');
        // 返回删除成功的响应
        return redirect()->route('edges.index');
    }

}
