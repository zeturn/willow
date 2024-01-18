@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-lg font-bold mb-4">边详情</h1>
                <p class="mb-2"><span class="font-medium">起始节点:</span> {{ $edge->start_node }}</p>
                <p class="mb-4"><span class="font-medium">结束节点:</span> {{ $edge->end_node }}</p>
                <a href="{{ route('edges.edit', $edge->id) }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md text-white font-medium mr-2">编辑</a>
                <form action="{{ route('edges.destroy', $edge->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-md text-white font-medium">删除</button>
                </form>
            </div>
        </div>

        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
        <x-patrol-button color="yellow" route="edges.index" text1="前往Edge中心" text2="Go to edge"></x-patrol-button>

            <!-- Sidebar content here -->

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            @forelse($walls as $wall)
                <a href="{{ route('wall.show', $wall->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200 mb-4 block">{{ $wall->name }}</a>
            @empty
                <p class="text-gray-600">无关联的wall</p>
            @endforelse

            <!-- 创建链接的表单 -->
            <form action="{{ route('edges.createEWLink', $edge->id) }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Wall Name:</label>
                    <input type="text" id="name" name="name" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Wall Slug:</label>
                    <input type="text" id="slug" name="slug" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Wall Description:</label>
                    <textarea id="description" name="description" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <input type="submit" value="Create Link" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
