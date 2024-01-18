@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 overflow-hidden sm:rounded-lg">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Node Details') }}</h1>
                <div class="mt-4">
                    <p class="text-lg text-gray-700">{{ __('Name') }}: <span class="font-medium">{{ $node->name }}</span></p>
                    <p class="text-lg text-gray-700">{{ __('Description') }}: <span class="font-medium">{{ $node->description }}</span></p>
                    <p class="text-lg text-gray-700">{{ __('Status') }}: <span class="font-medium">{{ $node->status }}</span></p>
                    <a href="{{ route('dag.editNode', $node->id) }}" class="text-indigo-600 hover:text-indigo-900 mt-4 inline-block">{{ __('Edit') }}</a>
                    <form action="{{ route('dag.deleteNode', $node->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <x-patrol-button color="yellow" route="dag.index" text1="前往DAG中心" text2="Go to dag"></x-patrol-button>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Sidebar content goes here -->
            </div>
        </div>
    </div>
</div>
@endsection
