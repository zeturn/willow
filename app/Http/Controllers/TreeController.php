<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TreeController extends Controller
{
    /**
     * Display a listing of the category tree nodes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trees = Tree::all(); // 获取所有分类树节点

        return view('trees.index', compact('trees'));
    }

    /**
     * Show the form for creating a new tree node.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('trees.create'); // 返回创建分类树节点的视图
    }

    /**
     * Store a newly created tree node in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'nullable|max:65535',
            'status' => 'required',
            'parent_id' => 'nullable|exists:trees,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tree = Tree::create($request->all()); // 创建分类树节点并保存

        return redirect()->route('trees.show', $tree->id); // 重定向到分类树节点详情页
    }

    /**
     * Display the specified tree node details.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\View\View
     */
    public function show(Tree $tree)
    {
        $parent = $tree->parent;

        $children = $tree->children;

        $walls = $tree -> walls;

        return view('trees.show', compact('tree', 'parent', 'children', 'walls')); // 返回分类树节点详情视图
    }

    /**
     * Show the form for editing the specified tree node.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\View\View
     */
    public function edit(Tree $tree)
    {
        return view('trees.edit', compact('tree')); // 返回分类树节点编辑视图
    }

    /**
     * Update the specified tree node in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tree $tree)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'nullable|max:65535',
            'status' => 'required',
            'parent_id' => 'nullable|exists:trees,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tree->update($request->all()); // 更新分类树节点信息

        return redirect()->route('trees.show', $tree->id); // 重定向到分类树节点详情页
    }

    /**
     * Remove the specified tree node from the database.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tree $tree)
    {
        $tree->delete(); // 删除分类树节点

        return redirect()->route('trees.index'); // 重定向到分类树节点列表页
    }

    /**
     * 创建 Tree 和 Wall 之间的关联。
     *
     * @param Request $request
     * @param string  $treeUuid Tree 实体的 UUID
     * @return \Illuminate\Http\Response
     */
    public function createEWLink(Request $request, $treeUuid)
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

        // 查找 Tree 实体
        $tree = Tree::where('id', $treeUuid)->first();
        if (!$tree) {
            return response()->json(['error' => 'Tree not found'], 404);
        }

        // 创建链接
        try {
            $wallData = $request->only(['name', 'slug', 'description']);
            $entityWallAssociation = $tree->createEWLink($wallData);

            return response()->json(['message' => 'Link created successfully', 'link' => $entityWallAssociation], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create link'], 500);
        }
    }

}
