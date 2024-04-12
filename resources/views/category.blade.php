@extends('layouts.page')

@section('title')
    {{ __('分类') }}
@endsection

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main column -->
        <div class="w-full lg:w-3/4 px-4">
            @if (auth()->check())
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <h1 class="text-2xl font-semibold text-gray-900">{{ __('分类管理') }}</h1>
                    <div class="mt-4 space-y-2">
                        <!-- Tree and DCG buttons in a row -->
                        <div class="flex justify-between">
                            <a href="{{ route('trees.index') }}" class="block text-center bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 flex-grow mr-2">{{ __('Tree 分类首页') }}</a>
                            <a href="{{ route('dcg.index') }}" class="block text-center bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-700 flex-grow ml-2">{{ __('DCG 首页') }}</a>
                        </div>
                        
                        <!-- Node button -->
                        <a href="{{ route('nodes.index') }}" class="block text-center bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">{{ __('Node 节点首页') }}</a>
                        
                        <!-- Edge button -->
                        <a href="{{ route('edges.index') }}" class="block text-center bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">{{ __('Edge 边首页') }}</a>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 text-center">
                    <h1 class="text-xl font-semibold text-gray-900">{{__('basic.Authentication Required')}}</h1>
                    <p class="mt-4 text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to access category management.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-blue-500 text-white rounded-lg p-6 mb-4">
                <div class="flex justify-between items-center">
                    <span>返回分类中心</span>
                    <a href="{{ route('categories.index') }}" class="bg-white text-blue-500 font-bold py-1 px-3 rounded-lg">
                        Go to Category
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Sidebar content goes here -->
            </div>
        </div>
    </div>
</div>
@endsection
