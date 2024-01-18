@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Categories List') }}</h1>
                <a href="{{ route('trees.create') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Create New Category') }}</a>
                <ul>
                    @foreach ($trees as $tree)
                    <li>
                        {{ $tree->name }}
                        <a href="{{ route('trees.show', $tree->id) }}" class="text-blue-600 hover:text-blue-900">{{ __('View Details') }}</a>
                        <a href="{{ route('trees.edit', $tree->id) }}" class="text-green-600 hover:text-green-900">{{ __('Edit') }}</a>
                        <form action="{{ route('trees.destroy', $tree->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-blue-500 text-white rounded-lg p-6 mb-4">
                <div class="flex justify-between items-center">
                    <span>返回分类中心</span>
                    <a href="{{ route('categories.index') }}" class="bg-white text-blue-500 font-bold py-1 px-3 rounded-lg">
                        Go to Category
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Sidebar content goes here -->
            </div>
        </div>
    </div>
</div>
@endsection
