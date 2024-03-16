<?php

// app/Http/Controllers/TopicController.php

namespace App\Http\Controllers;


use App\Models\Wall;
use App\Models\Topic;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('permission:topic-index', ['only' => ['index']]);
        $this->middleware('permission:topic-create', ['only' => ['create','store']]);
        $this->middleware('permission:topic-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:topic-delete-soft-delete', ['only' => ['softDelete']]);//一般用户，仅可以软删除
        $this->middleware('permission:topic-delete', ['only' => ['destroy', 'softDelete', 'restore']]);//高级用户，删除、软删除、恢复
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Retrieve all topics from the database
            $topics = Topic::all();

            // Check if topics exist
            if ($topics->isEmpty()) {
                // Log a warning if no topics are found
                Log::warning("No topics found in the database.");

                // Optionally handle this case, e.g., show a message or redirect
                // For now, just return an empty view
            }

            // Pass the topics data to the view
            return view('topics.index', compact('topics'));
        } catch (\Exception $e) {
            // Log the exception details for debugging
            Log::error("Error retrieving topics: " . $e->getMessage());

            // Optionally handle the exception, e.g., show an error page
            // For now, just return a generic error response
            return response()->json(['error' => 'An error occurred while retrieving topics.'], 500);
        }
    }


    /**
     * Create a new view for creating a topic.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            // Fetch all records from the Wall model
            $walls = Wall::all();

            // Check if the query was successful
            if (!$walls->isEmpty()) {
                // Pass the walls data to the view
                return view('topics.create', compact('walls'));
            } else {
                // Log an error if no walls are found
                Log::error('No walls found in the database.');
                // Redirect or handle the error appropriately
                return redirect()->back()->withErrors(['No walls found.']);
            }
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Exception occurred: ' . $e->getMessage());
            // Redirect or handle the exception appropriately
            return redirect()->back()->withErrors(['An error occurred. Please try again later.']);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData =$request->validate([
                'wall_id' => 'required|exists:walls,id',
                'name' => 'required|max:255',
                'description' => 'required',
            ]);

            //slug区域
            $originalSlug = Str::slug($validatedData['name'], '-');
            // 检查slug的唯一性
            $slug =$originalSlug;
            $increment = 1;
            while (Topic::where('slug', $slug)->exists()) {
                $slug =$originalSlug . '-' . $increment++;
            }
            // 创建新主题
            $topic = Topic::create([
                'wall_id' => $validatedData['wall_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'slug' => $slug, // 使用生成的唯一slug
                'user_id' => Auth::id(),
                'status' => 5, // 设置默认状态
            ]);

            // Set a flash message
            session()->flash('message', 'Topic created successfully! Please wait for approval~');

            // Redirect to the show method with the new topic's ID
            return redirect()->route('topic.show', ['topic' => $topic->id]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error creating topic: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the topic. Please try again later.']);
        }
    }
    

    public function edit(Topic $topic)
    {
        $walls = Wall::all();
        return view('topics.edit', compact('topic', 'walls'));
    }

    public function update(Request $request, Topic $topic)
    {
        $topic->update($request->all());
        return redirect()->route('topic.index');
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return back();
    }
}
