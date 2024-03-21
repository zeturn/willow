@extends('layouts.page')

@section('title')
    {{ __('Entry Trend') }}
@endsection

@section('description', 'memeGit是一个人文条目数据库，你可以在这里了解、创建和分享你的文化基因！这里针对迷因的特性针对设计了版本管理工具，帮助任何人轻松的向任何迷因提出自己的理解。')
@section('keywords', '迷因, meme, HollowData, memeGit')


@section('content')
<div class="max-w-md mx-auto p-4 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Entry Trend</h1>
    <h1 class="text-xl text-gray-500 mb-6">Entry的访问排行，刷新频率：10分钟</h1>
    <ul class="space-y-4">
        @foreach ($entries as $entry)
        <li class="flex items-center space-x-4">
            <a href="{{ route('entry.show.explanation', $entry->id) }}" class="text-blue-500 hover:underline hover:text-blue-600">
                <span class="text-xl font-semibold text-gray-700">{{ $entry->name }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>


@endsection
