@extends('layouts.page')

@section('title')
{{ $wall->name }}
@endsection
@section('description', 'memeGit是一个人文条目数据库，你可以在这里了解、创建和分享你的文化基因！这里针对迷因的特性针对设计了版本管理工具，帮助任何人轻松的给任何迷因提出自己的理解。')
@section('keywords', '迷因, meme, HollowData, memeGit')

@section('content')
<div class="container mx-auto mt-5 max-w-7xl">
    <!-- Wall Detail Card -->
    <div class="mb-6 bg-white rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-2">{{ $wall->name }}</h1>
        <p class="text-gray-600 mb-2">{{ $wall->slug }}</p>
        <p class="text-gray-600 mb-2">{{ $wall->description }}</p>
        <p class="text-gray-600 mb-2">Status: {{ $wall->status }}</p>
        @if($wall->eid)
            <p class="text-gray-600">EID: {{ $wall->eid }}</p>
        @endif
    </div>
    
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <!-- Display Topics -->
            <div class="bg-white rounded-lg mb-6">
                <div class="p-6">
                    @foreach($topics as $topic)
                        <div class="mb-4 border-b pb-4">
                            <a href="{{ route('topic.show', $topic) }}" class="text-xl font-bold">{{ $topic->name }}</a>
                            <p class="text-gray-500">{{ $topic->description }}</p>
                        </div>
                    @endforeach
                    {{ $topics->links() }} <!-- Pagination -->
                </div>
            </div>
            
            <!-- Check if user is authenticated -->
            @if (auth()->check())
                <!-- Add New Topic Form -->
                <div class="bg-white rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Add New Topic</h2>
                    <form action="{{ route('topic.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="wall_id" value="{{ $wall->id }}">
                        
                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-lg" required>
                        </div>

                        <!-- Description Field -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 p-2 w-full border rounded-lg"></textarea>
                        </div>

                        <!-- Slug Field -->
                        <div class="mb-4">
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                            <input type="text" name="slug" id="slug" class="mt-1 p-2 w-full border rounded-lg">
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Add Topic
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Not Authenticated User Message -->
                <div class="bg-white rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">Authentication Required</h2>
                    <p class="text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to add a new topic.</p>
                </div>
            @endif

        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            @if($wall->eid)
                <div class="bg-purple-500 text-white rounded-lg p-6 mb-4">
                    <div class="flex justify-between items-center">
                        <span>连接到词条</span>
                        <a href="{{ route('entry.index', ['eid' => $wall->eid]) }}" class="bg-white text-purple-500 font-bold py-1 px-3 rounded-lg">Go</a>
                    </div>
                </div>
            @endif

            <ul>
                @foreach($wall->getEntityLinks() as $link)
                    <li>
                        <a href="{{ $link['link'] }}">{{ $link['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
