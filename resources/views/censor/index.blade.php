@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
        <div class="flex flex-wrap -mx-4">
            {{-- 主列 --}}
            <div class="w-full lg:w-3/4 px-4">
                <div class="p-4">
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.entry') }}" class="btn btn-primary mb-2">Entry Task List</a>
                    </div>
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.branch') }}" class="btn btn-primary mb-2">Branch Task List</a>
                    </div>
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.version') }}" class="btn btn-primary mb-2">Version Task List</a>
                    </div>
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.task') }}" class="btn btn-primary mb-2">Task Task List</a>
                    </div>
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.wall') }}" class="btn btn-primary mb-2">Wall Task List</a>
                    </div>
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.topic') }}" class="btn btn-primary mb-2">Topic Task List</a>
                    </div>
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.comment') }}" class="btn btn-primary mb-2">Comment Task List</a>
                    </div>
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.media') }}" class="btn btn-primary mb-2">Media Task List</a>
                    </div>
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <a href="{{ route('censor.tasks.list.album') }}" class="btn btn-primary mb-2">Album Task List</a>
                    </div>
                </div>
            </div>

            {{-- 侧边栏 --}}
            <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    {{-- 侧边栏内容 --}}
                </div>
            </div>
        </div>
    </div>
@endsection