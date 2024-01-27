@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
                <h1 class="text-2xl font-semibold text-gray-900 mb-4">{{ __('Categories List') }}</h1>                
                <div class="mt-4 grid gap-4">
                    @foreach ($trees as $tree)
                    <div class="bg-gray-100 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-medium">{{ $tree->name }}</span>
                        <div class="flex space-x-2">
                            <a href="{{ route('trees.show', $tree->id) }}" class="text-blue-600 hover:text-blue-800">{{ __('View Details') }}</a>
                            <a href="{{ route('trees.edit', $tree->id) }}" class="text-green-600 hover:text-green-800">{{ __('Edit') }}</a>
                            <form action="{{ route('trees.destroy', $tree->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $trees->links() }}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-blue-500 text-white rounded-lg p-6 mb-4 shadow-lg">
                <div class="flex justify-between items-center">
                    <span>{{ __('Back to Category Center') }}</span>
                    <a href="{{ route('categories.index') }}" class="bg-white text-blue-500 font-bold py-1 px-3 rounded-lg hover:bg-gray-100 transition-colors">
                        {{ __('Go to Category') }}
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div class="mb-4">
                    <h3 class="text-black font-bold dark:text-white py-2 px-4 rounded-lg">
                        {{ __('Operations') }}
                    </h3>
                </div>
                @auth
                <a href="{{ route('trees.create') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Add New Tree') }}
                </a>
                @endauth
                <!-- You can add other sidebar content here -->
            </div>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
                <!-- Sidebar content goes here -->
            </div>
        </div>
    </div>
</div>
@endsection
