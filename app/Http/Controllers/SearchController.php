<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryVersion;

use App\Models\Tree;
use App\Models\Node;
use App\Models\Edge;

use App\Models\Wall;
use App\Models\Topic;
use App\Models\Comment;

use App\Models\Album;
use App\Models\Media;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        // 返回首页视图
        return view('search.index');
    }

    public function AdvancedSearchIndex(){
        // 返回首页视图
        return view('search.advanced');
    }

    public function search(Request $request)
    {
        // 获取搜索关键词
        $query = $request->input('query');
    
        // 获取搜索的模型类型
        $modelType = $request->input('model_type');

        $start_date = $request->input('start_date');
        
        $end_date = $request->input('end_date');
    
        // 根据模型类型执行相应的搜索
        switch ($modelType) {
            case 'entry':
                $results = Entry::search($query)->get();
                $view = 'search.results.entry';
                break;
            case 'entry_branch':
                $results = EntryBranch::search($query)->get();
                $view = 'search.results.entry_branch';
                break;
            case 'entry_version':
                $results = EntryVersion::search($query)->get();
                $view = 'search.results.entry_version';
                break;
            case 'wall':
                $results = Wall::search($query)->get();
                $view = 'search.results.wall';
                break;
            case 'topic':
                $results = Topic::search($query)->get();
                $view = 'search.results.topic';
                break;
            case 'comment':
                $results = Comment::search($query)->get();
                $view = 'search.results.comment';
                break;
            case 'media':
                $results = Media::search($query)->get();
                $view = 'search.results.media';
                break;
            case 'album':
                $results = Album::search($query)->get();
                $view = 'search.results.album';
                break;
            case 'tree':
                $results = Tree::search($query)->get();
                $view = 'search.results.tree';
                break;
            case 'node':
                $results = Node::search($query)->get();
                $view = 'search.results.node';
                break;
            case 'edge':
                $results = Edge::search($query)->get();
                $view = 'search.results.edge';
                break;
            default:
                // 默认搜索 Entry
                $results = Entry::search($query)->get();
                $view = 'search.results.entry';
                break;
        }
    
        // 返回搜索结果视图
        return view($view, compact('results', 'modelType', 'query', 'start_date','end_date'));
    }
}
