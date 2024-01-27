@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-lg font-bold mb-4">边列表</h1>
                <ul class="list-disc pl-5">
                    @foreach ($edges as $edge)
                    <li class="mb-2">
                        {{ $edge->start_node }} 到 {{ $edge->end_node }}
                        <a href="{{ route('edges.show', $edge->id) }}" class="text-blue-600 hover:underline ml-2">查看详情</a>
                        <a href="{{ route('edges.edit', $edge->id) }}" class="text-green-600 hover:underline ml-2">编辑</a>
                        <form action="{{ route('edges.destroy', $edge->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 hover:bg-red-700 rounded-md text-white font-medium ml-2">删除</button>
                        </form>
                    </li>
                    @endforeach
                </ul>

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
                    <a href="{{ route('categories.index') }}" class="bg-white text-blue-500 font-bold py-1 px-3 rounded-lg">
                        Go to Category
                    </a>
                </div>
            </div>
            <!-- Sidebar content here -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div class="mb-4">
                    <h3 class="text-black font-bold dark:text-white py-2 px-4 rounded-lg">
                        {{ __('Operations') }}
                    </h3>
                </div>
                @auth
                <a href="{{ route('edges.create') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Add New Edge') }}
                </a>
                @endauth
                <!-- You can add other sidebar content here -->
            </div>
        </div>

        </div>
    </div>
</div>
@endsection

