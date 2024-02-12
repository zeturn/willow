@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-lg font-bold mb-4">{{ __('Create New Edge') }}</h1>
                <form action="{{ route('edges.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="start_node" class="block text-sm font-medium text-gray-700">{{ __('Start Node') }}:</label>
                        <input type="text" name="start_node" id="start_node" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="end_node" class="block text-sm font-medium text-gray-700">{{ __('End Node') }}:</label>
                        <input type="text" name="end_node" id="end_node" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Create') }}</button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">


            <x-patrol-button color="yellow" route="dcg.index" text1="前往DCG中心" text2="Go to dcg"></x-patrol-button>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Sidebar content goes here -->
            </div>
        </div>
    </div>
</div>
@endsection
