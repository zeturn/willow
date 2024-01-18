<?php

// app/Http/Controllers/WallController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wall;
use App\Models\Topic;

class WallController extends Controller
{
    public function index()
    {
        $walls = Wall::all();
        return view('walls.index', compact('walls'));
    }

    public function create()
    {
        return view('walls.create');
    }

    public function store(Request $request)
    {
        Wall::create($request->all());
        return redirect()->route('wall.index');
    }

    public function edit(Wall $wall)
    {
        return view('walls.edit', compact('wall'));
    }

    public function update(Request $request, Wall $wall)
    {
        $wall->update($request->all());
        return redirect()->route('wall.index');
    }

    public function show(Wall $wall)
    {
        $topics = $wall->topics()->paginate(10); // 分页显示，每页10条
        return view('walls.show', compact('wall', 'topics'));
    }

    public function destroy(Wall $wall)
    {
        $wall->delete();
        return back();
    }
}
