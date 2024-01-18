{{-- Display details of a single node --}}
@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Node Details') }}</h1>
                <div class="mt-4">
                    <p class="text-lg text-gray-700">{{ __('Name') }}: <span class="font-medium">{{ $node->name }}</span></p>
                    <p class="text-lg text-gray-700">{{ __('Description') }}: <span class="font-medium">{{ $node->description }}</span></p>
                    <a href="{{ route('nodes.edit', $node->id) }}" class="text-indigo-600 hover:text-indigo-900 mt-4 inline-block">{{ __('Edit') }}</a>
                    <form action="{{ route('nodes.destroy', $node->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <x-patrol-button color="yellow" route="nodes.index" text1="前往Node中心" text2="Go to node"></x-patrol-button>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            @forelse($walls as $wall)
                <a href="{{ route('wall.show', $wall->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200 mb-4 block">{{ $wall->name }}</a>
            @empty
                <p class="text-gray-600">无关联的wall</p>
            @endforelse

            <!-- 创建链接的表单 -->
            <form action="{{ route('nodes.createEWLink', $node->id) }}" method="POST" class="mt-6">
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
