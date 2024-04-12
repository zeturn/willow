@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-lg font-bold mb-4">边详情 (Edge Details)</h1>
                <p class="mb-2">
                    <a href="{{ route('nodes.show', $edge->startNode->id) }}" class="text-blue-500 hover:text-blue-600 transition duration-200">
                        <span class="font-medium">起始节点 (Start Node):</span> {{ $edge->startNode->name }} {{ $edge->start_node }}
                    </a>
                </p>
                <p class="mb-4">
                    <a href="{{ route('nodes.show', $edge->endNode->id) }}" class="text-blue-500 hover:text-blue-600 transition duration-200">
                        <span class="font-medium">结束节点 (End Node):</span> {{ $edge->endNode->name }} {{ $edge->end_node }}
                    </a>
                </p>
                <div class="flex">
                    @can('edge-edit')
                    <a href="{{ route('edges.edit', $edge->id) }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md text-white font-medium mr-2">编辑 (Edit)</a>
                    @endcan

                    @can('edge-delete')
                    <form action="{{ route('edges.destroy', $edge->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-md text-white font-medium">删除 (Delete)</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <!-- Related Walls -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                @forelse($walls as $wall)
                    <a href="{{ route('wall.show', $wall->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200 mb-4 block">{{ $wall->name }}</a>
                @empty
                    <p class="text-gray-600">无关联的wall (No Related Walls)</p>
                @endforelse

                <!-- Create Link Form -->
                @can('create-wall-link')
                @if(auth()->check())
                <form action="{{ route('edges.createEWLink', $edge->id) }}" method="POST" class="mt-6">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Wall Name:</label>
                        <input type="text" id="name" name="name" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Wall Description:</label>
                        <textarea id="description" name="description" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <input type="submit" value="Create Link" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                </form>
                @else
                <!-- Not Authenticated User Message -->
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">{{__('basic.Authentication Required')}}</h2>
                    <p class="text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to create new content.</p>
                </div>
                @endif
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
