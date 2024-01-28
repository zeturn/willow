{{-- Display details of a single node --}}
@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-4xl font-semibold text-gray-900">{{ $node->name }}</h1>
                <div class="mt-4">
                    <p class="text-lg text-gray-700">{{ __('Description') }}: <span class="font-medium">{{ $node->description }}</span></p>

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 p-4 text-left">Adjacent Node</th>
                                    <th class="border border-gray-300 p-4 text-left">Edge Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adjacentNodesAndEdges as $item)
                                    <tr>
                                        <td class="border border-gray-300 p-4"><a href="{{ route('nodes.show', $item['adjacent_node']->id) }}">{{ $item['adjacent_node']->name }}</a></td>
                                        <td class="border border-gray-300 p-4">{{ $item['edge_status'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('nodes.edit', $node->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">{{ __('Edit') }}</a>
                    <form action="{{ route('nodes.destroy', $node->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out">{{ __('Delete') }}</button>
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
</div>
@endsection
