@extends('layouts.page')

@section('title')
    {{ __('Entry Trend') }}
@endsection

@section('description', 'memeGit是一个人文条目数据库，你可以在这里了解、创建和分享你的文化基因！这里针对迷因的特性针对设计了版本管理工具，帮助任何人轻松的向任何迷因提出自己的理解。')
@section('keywords', '迷因, meme, HollowData, memeGit')


@section('content')
<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Entry Trend</h1>
    <p class="text-lg text-gray-600 mb-8">Entry的访问排行，刷新频率：10分钟</p>
    <ul class="space-y-4">
        @foreach ($entries as $entry)
        <li class="flex items-center space-x-4 border-b border-gray-200 last:border-b-0 py-2">
            <a href="{{ route('entry.show.explanation', $entry->id) }}" class="text-blue-500 hover:underline hover:text-blue-600">
                <span class="text-xl font-semibold text-gray-700">{{ $entry->name }}</span>
                <span class="text-lg text-gray-500 ml-4">{{ $entry->updated_at }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>


@endsection
