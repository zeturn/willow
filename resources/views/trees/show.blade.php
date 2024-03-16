@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Category Details') }}</h1>
                <div class="mt-4">
                    <p class="text-lg text-gray-700">{{ __('Name') }}: <span class="font-medium">{{ $tree->name }}</span></p>
                    <p class="text-lg text-gray-700">{{ __('Description') }}: <span class="font-medium">{{ $tree->description }}</span></p>
                    <p class="text-lg text-gray-700">{{ __('Status') }}: <span class="font-medium">{{ $tree->status }}</span></p>
                    @if(auth()->check())
                    @can('tree-edit')
                    <a href="{{ route('trees.edit', $tree->id) }}" class="text-indigo-600 hover:text-indigo-900 mt-4 inline-block">{{ __('Edit') }}</a>
                    @endcan
                    @can('tree-delete')
                    <form action="{{ route('trees.destroy', $tree->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                    </form>
                    @endcan
                    @endif
                </div>

                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach($tree->entries as $entry)
                    <a href="{{ route('entry.show.explanation', ['id' => $entry->id]) }}" class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                {{ $entry->name }}
                            </a>
                    @endforeach
                </div>
                
                @if($parent)
                {{ $parent->name }}
                <a href="{{ route('trees.show', $parent->id) }}" class="text-blue-600 hover:text-blue-900">{{ __('View Details') }}</a>
                @endif

                @if($children)
                @foreach ($children as $child)
                        {{ $child->name }}
                        <a href="{{ route('trees.show', $child->id) }}" class="text-blue-600 hover:text-blue-900">{{ __('View Details') }}</a>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Sidebar content goes here -->
            </div>

            @if(auth()->check())
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            @forelse($walls as $wall)
                <a href="{{ route('wall.show', $wall->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200 mb-4 block">{{ $wall->name }}</a>
            @empty
                <p class="text-gray-600">无关联的wall</p>
            @endforelse

            <!-- 创建链接的表单 -->
            <form action="{{ route('trees.createEWLink', $tree->id) }}" method="POST" class="mt-6">
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
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">Authentication Required</h2>
                    <p class="text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to create new content.</p>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
