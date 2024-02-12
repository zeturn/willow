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

                        <!-- Adjacent Nodes Display -->
                        <div class="mt-6">
                            <h2 class="text-2xl font-semibold text-gray-900">{{ __('Adjacent Nodes') }}</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                                @foreach ($adjacentNodesAndEdges as $item)
                                    <div class="bg-white rounded-lg p-4 dark:bg-gray-800 dark:border-gray-700">
                                        <a href="{{ route('nodes.show', $item['adjacent_node']->id) }}" class="text-lg text-blue-500 hover:text-blue-600 font-semibold">{{ $item['adjacent_node']->name }}</a>
                                        <p class="text-gray-600">{{ $item['edge_status'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Entries Display -->
                        <div class="mt-6">
                            <h2 class="text-2xl font-semibold text-gray-900">{{ __('Related Entries') }}</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                                @foreach ($entries as $entry)
                                    <div class="bg-white rounded-lg p-4 dark:bg-gray-800 dark:border-gray-700">
                                        <a href="{{ route('entry.show.explanation', $entry->id) }}" class="text-lg text-blue-500 hover:text-blue-600 font-semibold">{{ $entry->name }}</a>
                                        <p class="text-gray-600">{{ $entry->status }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <a href="{{ route('dcg.editNode', $node->id) }}" class="text-indigo-600 hover:text-indigo-900 mt-4 inline-block">{{ __('Edit') }}</a>
                        <form action="{{ route('dcg.deleteNode', $node->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                        </form>

                    </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Sidebar content goes here -->
            </div>
        </div>
    </div>
</div>
@endsection
