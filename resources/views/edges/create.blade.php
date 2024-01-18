@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-lg font-bold mb-4">创建新边</h1>
                <form action="{{ route('edges.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="start_node" class="block text-sm font-medium text-gray-700">起始节点:</label>
                        <input type="text" name="start_node" id="start_node" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="end_node" class="block text-sm font-medium text-gray-700">结束节点:</label>
                        <input type="text" name="end_node" id="end_node" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-md text-white font-medium">创建</button>
                </form>
            </div>
        </div>

        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
        <x-patrol-button color="yellow" route="edges.index" text1="前往Edge中心" text2="Go to edge"></x-patrol-button>

            <!-- Sidebar content here -->
        </div>
    </div>
</div>
@endsection
