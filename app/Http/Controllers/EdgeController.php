<?php

namespace App\Http\Controllers;

use App\Models\Edge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EdgeController extends Controller
{
    /**
     * 显示边列表的页面。
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edges = Edge::paginate(20); // 获取所有边
        return view('edges.index', compact('edges'));
    }

    /**
     * 显示创建新边的表单。
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // 此处返回创建边的视图
        return view('edges.create');
    }

    /**
     * 存储新创建的边到数据库。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        $edge->createCensorTask();

        return redirect()->route('edges.show', $edge->id); // 重定向到边详情页
    }

    /**
     * 显示指定边的详情。
     *
     * @param  \App\Models\Edge  $edge
     * @return \Illuminate\View\View
     */
    public function show(Edge $edge)
    {
        $walls = $edge -> walls;
        // 此处返回边详情视图
        return view('edges.show', compact('edge', 'walls'));
    }

    /**
     * 显示编辑指定边的表单。
     *
     * @param  \App\Models\Edge  $edge
     * @return \Illuminate\View\View
     */
    public function edit(Edge $edge)
    {
        // 此处返回边编辑视图
        return view('edges.edit', compact('edge'));
    }

    /**
     * 更新指定边的数据库记录。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Edge  $edge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Edge $edge)
    {
        $edge->update($request->all()); // 更新边信息

        return redirect()->route('edges.show', $edge->id); // 重定向到边详情页
    }

    /**
     * 从数据库中移除指定边。
     *
     * @param  \App\Models\Edge  $edge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Edge $edge)
    {
        $edge->delete(); // 删除边

        return redirect()->route('edges.index'); // 重定向到边列表页
    }

    /**
     * 创建 Edge 和 Wall 之间的关联。
     *
     * @param Request $request
     * @param string  $edgeUuid Edge 实体的 UUID
     * @return \Illuminate\Http\Response
     */
    public function createEWLink(Request $request, $edgeUuid)
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

        // 查找 Edge 实体
        $edge = Edge::where('id', $edgeUuid)->first();
        if (!$edge) {
            return response()->json(['error' => 'Edge not found'], 404);
        }

        // 创建链接
        try {
            $wallData = $request->only(['name', 'slug', 'description']);
            $entityWallAssociation = $edge->createEWLink($wallData);

            return response()->json(['message' => 'Link created successfully', 'link' => $entityWallAssociation], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create link'], 500);
        }
    }

}
