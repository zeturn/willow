@extends('layouts.page')

@section('title','讨论广场')
@section('description', 'memeGit是一个人文条目数据库，你可以在这里了解、创建和分享你的文化基因！这里针对迷因的特性针对设计了版本管理工具，帮助任何人轻松的给任何迷因提出自己的理解。')
@section('keywords', '迷因, meme, HollowData, memeGit')


@section('content')
<div class="container mx-auto px-8 ">

    <div class="mb-10 mt-5 p-4 dark:bg-gray-800 dark:text-white">
        <h1 class="text-4xl font-bold mb-2">讨论广场 💬</h1>
        <p class="text-sm text-gray-600 mt-1 dark:text-gray-400">此页根据近期更新及实时热度推荐，与个人偏好无关</p>
        <p class="text-sm text-gray-600 mt-1 dark:text-gray-400">⚠️本站内容由用户编写或根据互联网内容自动处理而成，不代表本站观点，也不代表运营者观点</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($walls as $wall)
    <div class="rounded-lg shadow-sm bg-white dark:bg-gray-800 dark:text-gray-400">
        <div class="p-4">
            <h5 class="text-xl font-semibold text-gray-900 dark:text-gray-400 mb-2">{{$wall->name}}</h5>
            <p class="text-gray-700 text-base dark:text-gray-400">{{$wall->description}}</p>

            <!-- 显示更新时间 -->
            <p class="text-gray-500 text-sm">Updated at: {{ date('Y-m-d', strtotime($wall->updated_at)) }}</p>

            <a href="{{ route('wall.show', $wall->id) }}" class="inline-block mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                查看详情
            </a>
        </div>
    </div>
    @endforeach
    </div>

</div>
@endsection
