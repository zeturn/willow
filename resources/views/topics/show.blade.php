@extends('layouts.page')

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
            <!-- Display Comments -->
            <div class="bg-white rounded-lg mb-6">
                <div class="p-6">
                    @foreach($comments as $comment)
                        <div class="mb-4 border-b pb-4">
                        <x-user-name-and-avatar :user-id="$comment->user->id" />


                            <p class="text-gray-500">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                    {{ $comments->links() }} <!-- Pagination -->
                </div>
            </div>
            
            <!-- Add New Comment Form -->
            <div class="bg-white rounded-lg">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Add New Comment</h2>
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Comment</label>
                            <textarea name="content" id="content" rows="4" class="mt-1 p-2 w-full border rounded-lg" required></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
