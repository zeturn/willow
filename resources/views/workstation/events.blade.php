@extends('layouts.workstation')

@section('title')
{{ __('Workstation') }}
@endsection

@section('description', 'memeGit是一个人文条目数据库，你可以在这里了解、创建和分享你的文化基因！这里针对迷因的特性针对设计了版本管理工具，帮助任何人轻松的向任何迷因提出自己的理解。')
@section('keywords', '迷因, meme, HollowData, memeGit')

@section('content')

{{-- Tabs Navigation --}}
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full px-4">
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-6">

            <div class="mb-10 mt-5 p-4">
                <h1 class="text-4xl font-bold mb-2">Workstation</h1>
                <p class="text-sm text-gray-600 mt-1">在这里查看账户中的对象</p>
            </div>

                <div class="px-8">

                    <ul class="flex flex-wrap items-center border-b border-slate-200" role="tablist">
                        <li role="presentation">
                            <a href="{{ route('workstation.entry_branch_events') }}" class="{{ $pagename == 'entry_branch_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Branch</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('workstation.entry_version_events') }}" class="{{ $pagename == 'entry_version_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Version</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('workstation.topic_events')}}" class="{{ $pagename == 'topic_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Topic</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('workstation.comment_events')}}" class="{{ $pagename == 'comment_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Comment</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('workstation.entry_version_task_events')}}" class="{{ $pagename == 'entry_version_task_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Task</a>
                        </li>
                    </ul>
                </div>
                @yield('events_content')
            </div>
        </div>        
    </div>            
</div>

@endsection
