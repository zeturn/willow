@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">DAG Overview</h1>
                
                <!-- Nodes section -->
                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Nodes</h2>
                    <a href="{{ route('dag.createNode') }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400">Create New Node</a>
                    <ul class="mt-4 space-y-3">
                        @foreach ($nodes as $node)
                            <li class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                                {{ $node->name }}
                                <a href="{{ route('dag.showNode', $node->id) }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400 ml-2">View Details</a>
                                <a href="{{ route('dag.editNode', $node->id) }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400 ml-2">Edit</a>
                                <form action="{{ route('dag.deleteNode', $node->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-500 ml-2">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $nodes->links() }}
                </div>

                <!-- Edges section -->
                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Edges</h2>
                    <a href="{{ route('dag.createEdge') }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400">Create New Edge</a>
                    <ul class="mt-4 space-y-3">
                        @foreach ($edges as $edge)
                            <li class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                                {{ $edge->id }}
                                <a href="{{ route('dag.showEdge', $edge->id) }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400 ml-2">View Details</a>
                                <a href="{{ route('dag.editEdge', $edge->id) }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400 ml-2">Edit</a>
                                <form action="{{ route('dag.deleteEdge', $edge->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-500 ml-2">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $edges->links() }}
                </div>

            </div>
        </div><!-- Main column -->

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <x-patrol-button color="blue" route="categories.index" text1="返回分类中心" text2="Go to Category"></x-patrol-button>
            <x-patrol-button color="yellow" route="nodes.index" text1="前往Node中心" text2="Go to node"></x-patrol-button>
            <x-patrol-button color="yellow" route="edges.index" text1="前往Edge中心" text2="Go to edge"></x-patrol-button>
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Sidebar content goes here -->
            </div>
        </div><!-- Sidebar -->
        
    </div>
</div>
@endsection
