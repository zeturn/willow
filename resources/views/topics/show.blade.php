@extends('layouts.page')

@section('title')
{{ $topic->name }}
@endsection
@section('description', 'memeGit是一个人文条目数据库，你可以在这里了解、创建和分享你的文化基因！这里针对迷因的特性针对设计了版本管理工具，帮助任何人轻松的给任何迷因提出自己的理解。')
@section('keywords', '迷因, meme, HollowData, memeGit')


@section('content')
<div class="container mx-auto mt-5 max-w-7xl">
    <!-- Topic Detail Card -->
    <div class="mb-6 bg-white rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-2">{{ $topic->name }}</h1>
        <p class="text-gray-600 mb-2">{{ $topic->slug }}</p>
        <p class="text-gray-600 mb-2">{{ $topic->description }}</p>
        <p class="text-gray-600 mb-2">Status: {{ $topic->status }}</p>
        <p class="text-gray-600">Wall ID: {{ $topic->wall_id }}</p>
    </div>
    
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
        <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div class="mb-6">
                    <!-- Display Comments -->
                    @forelse($comments as $comment)
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                            <x-user-name-and-avatar :user-id="$comment->user->id" class="flex items-center space-x-3 mb-2" />
                            <p class="text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
                            <div class="text-xs text-gray-600 dark:text-gray-400">
                                <span>Created: {{ $comment->created_at->diffForHumans() }}</span>
                                <span>Updated: {{ $comment->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">No comments yet.</p>
                    @endforelse
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
            
            <!-- Check if user is authenticated -->
            @if (auth()->check())
                <!-- Add New Comment Form -->
                <div class="bg-white rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Add New Comment</h2>
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        
                        <!-- Comment Field -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Comment</label>
                            <textarea name="content" id="content" rows="4" class="mt-1 p-2 w-full border rounded-lg" required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Not Authenticated User Message -->
                <div class="bg-white rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">Authentication Required</h2>
                    <p class="text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to post a comment.</p>
                </div>
            @endif

        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-green-500 text-white rounded-lg p-6 mb-4">
                <div class="flex justify-between items-center">
                    <span>连接到wall</span>
                    <a href="{{ route('wall.show', ['wall' => $topic->wall_id]) }}" class="bg-white text-green-500 font-bold py-1 px-3 rounded-lg">
                        Go to Wall
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
