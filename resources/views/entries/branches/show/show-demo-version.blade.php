{{-- entries/branches/show/show-demo-version.blade.php --}}
@extends('entries.branches.show.branch')

@section('action-button')
    {{-- 这里可以添加特定于Demo Version视图的自定义操作按钮 --}}
@endsection

@section('entry-content')
    {{-- 针对Demo Version的具体内容 --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 dark:border-gray-700 mb-4 shadow-sm">
        <h2 class="text-2xl font-semibold dark:text-white">{{__('basic.DemoVersion')}}: {{ $demoversion->name }}</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{__('basic.Author')}}: {{ $demoversion->author_id }} | {{__('basic.Created')}}: {{ $demoversion->created_at->format('M d, Y') }}</p>
        <div class="mt-4">
            <p class="text-gray-600 dark:text-gray-300">{{__('basic.Description')}}:</p>
            <p>{{ $demoversion->description }}</p>
        </div>
        <div class="mt-4">
            <p class="text-gray-600 dark:text-gray-300">{{__('basic.Content')}}:</p>
            <p>{!! \Illuminate\Support\Str::markdown($demoversion->content) !!}</p>
        </div>
    </div>
    {{-- 可以在这里添加其他内容 --}}
@endsection
