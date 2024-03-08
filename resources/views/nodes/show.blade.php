{{-- Display details of a single node --}}
@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div>
                    <div class="flex justify-between">
                    <h1 class="text-4xl font-semibold text-gray-900">{{ $node->name }}</h1>
                    <span class="bg-transparent text-green-500 border border-green-500 text-xs font-semibold px-2.5 py-0.5 mt-1 rounded-full">Node</span>
                    </div>
                    <p class="text-lg text-gray-700 mt-4"><span class="font-medium">{{ $node->description }}</span></p>
                </div>
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

                <div class="flex space-x-4 mt-6">
                    <a href="{{ route('nodes.edit', $node->id) }}" class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">{{ __('Edit Node') }}</a>
                    <form action="{{ route('nodes.destroy', $node->id) }}" method="POST" class="inline-flex items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out">{{ __('Delete Node') }}</button>
                    </form>
                </div>
                
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <x-patrol-button color="yellow" route="nodes.index" text1="前往Node中心" text2="Go to Node Center" class="mb-4"></x-patrol-button>

            @forelse($walls as $wall)
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <a href="{{ route('wall.show', $wall->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200">{{ $wall->name }}</a>
                </div>
            @empty
                <p class="text-gray-600">{{ __('No related walls') }}</p>
            @endforelse

            <!-- Creating link form -->
            <form action="{{ route('nodes.createEWLink', $node->id) }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Wall Name:') }}</label>
                    <input type="text" id="name" name="name" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Wall Slug:') }}</label>
                    <input type="text" id="slug" name="slug" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Wall Description:') }}</label>
                    <textarea id="description" name="description" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <input type="submit" value="{{ __('Create Link') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
            </form>
        </div>
    </div>
</div>
@endsection
