@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-lg font-bold text-gray-900 mb-4">边列表</h1>
                <div class="mt-4">
                    @foreach ($edges as $edge)
                    <div class="bg-gray-100 rounded-lg p-4 flex justify-between items-center mb-2">
                        <span>{{ $edge->startNode->name }} {{__('basic.To')}} {{ $edge->endNode->name }}</span>
                        <div class="flex space-x-2">
                            <a href="{{ route('edges.show', $edge->id) }}" class="text-blue-600 hover:text-blue-800">
                                {{__('basic.ViewDetails')}}
                            </a>
                            <a href="{{ route('edges.edit', $edge->id) }}" class="text-green-600 hover:text-green-800">
                                {{__('basic.Edit')}}
                            </a>
                            <form action="{{ route('edges.destroy', $edge->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    {{__('basic.Delete')}}
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $edges->links() }}
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-blue-500 text-white rounded-lg p-6 mb-4">
                <div class="flex justify-between items-center">
                    <span>返回分类中心</span>
                    <a href="{{ route('categories.index') }}" class="bg-white text-blue-500 font-bold py-1 px-3 rounded-lg hover:bg-gray-100 transition-all">
                        Go to Category
                    </a>
                </div>
            </div>

            <!-- Sidebar content -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div class="mb-4">
                    <h3 class="text-black font-bold dark:text-white py-2 px-4 rounded-lg">
                        {{ __('Operations') }}
                    </h3>
                </div>
                @auth
                <a href="{{ route('edges.create') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-all">
                    {{ __('Add New Edge') }}
                </a>
                @endauth
                <!-- Additional sidebar content can be added here -->
            </div>
        </div>
    </div>
</div>
@endsection
