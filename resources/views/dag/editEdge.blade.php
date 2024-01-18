@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Edit Edge') }}</h1>
                <form action="{{ route('edges.update', $edge->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="start_node" class="block text-sm font-medium text-gray-700">{{ __('Start Node') }}:</label>
                        <input type="text" name="start_node" id="start_node" value="{{ $edge->start_node }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="end_node" class="block text-sm font-medium text-gray-700">{{ __('End Node') }}:</label>
                        <input type="text" name="end_node" id="end_node" value="{{ $edge->end_node }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">{{ __('Update') }}</button>
                </form>
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
