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

                <div class="px-8" x-data="tabList()">
                    <div class="flex border-b border-slate-200">
                        <ul class="flex flex-grow flex-wrap items-center" role="tablist"  name="hor_bar">
                            <li x-show="maxVisibleLi > 0" role="presentation">
                                <a href="{{ route('workstation.entry_branch_events') }}" x-ref="tab1" class="{{ $pagename == 'entry_branch_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Branch</a>
                            </li>
                            <li x-show="maxVisibleLi > 1" role="presentation">
                                <a href="{{ route('workstation.entry_version_events') }}" x-ref="tab2" class="{{ $pagename == 'entry_version_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Version</a>
                            </li>
                            <li x-show="maxVisibleLi > 2" role="presentation">
                                <a href="{{ route('workstation.topic_events')}}" x-ref="tab3" class="{{ $pagename == 'topic_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Topic</a>
                            </li>
                            <li x-show="maxVisibleLi > 3" role="presentation">
                                <a href="{{ route('workstation.comment_events')}}" x-ref="tab4" class="{{ $pagename == 'comment_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Comment</a>
                            </li>
                            <li x-show="maxVisibleLi >4" role="presentation">
                                <a href="{{ route('workstation.entry_version_task_events')}}" x-ref="tab5" class="{{ $pagename == 'entry_version_task_events' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Task</a>
                            </li>
                        </ul>

                        <div class="relative w-12">
                                <button 
                                    x-show="showButton" 
                                    @click="dropdownOpen = true" 
                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white rounded-md hover:bg-neutral-200 active:bg-gray-200 focus:bg-gray-300 focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:hover:bg-neutral-600 dark:active:bg-gray-700 dark:focus:bg-gray-700 dark:focus:ring-neutral-400/60">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                    </svg>
                                </button>
                                <div x-show="dropdownOpen" 
                                    @click.away="dropdownOpen=false"
                                    x-transition:enter="ease-out duration-200"
                                    x-transition:enter-start="-translate-y-2"
                                    x-transition:enter-end="translate-y-0"
                                    class="absolute top-0 z-50 w-56 mt-12 -translate-x-1/2 left-1/2"
                                    x-cloak>
                                    <div class="p-1 mt-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
                                        <a href="{{ route('workstation.entry_branch_events') }}" x-show="maxVisibleLi < 1" class="{{ $pagename == 'entry_branch_events' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1">Branch</a>
                                        <a href="{{ route('workstation.entry_version_events') }}" x-show="maxVisibleLi < 2" class="{{ $pagename == 'entry_version_events' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1">Version</a>
                                        <a href="{{ route('workstation.topic_events') }}" x-show="maxVisibleLi < 3" class="{{ $pagename == 'topic_events' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1">Topic</a>
                                        <a href="{{ route('workstation.comment_events') }}" x-show="maxVisibleLi < 4" class="{{ $pagename == 'comment_events' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1">Comment</a>
                                        <a href="{{ route('workstation.entry_version_task_events') }}" x-show="maxVisibleLi < 5" class="{{ $pagename == 'entry_version_task_events' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1">Task</a>
                                    </div>
                                </div>
                        </div><!--alp-->

                        <script>
                            document.addEventListener('alpine:init', () => {
                                Alpine.data('tabList', () => ({
                                    ulWidth: 0,
                                    liCount: 0,
                                    maxVisibleLi: 5,
                                    // 添加一个属性来控制按钮的显示
                                    showButton: false,
                                    dropdownOpen: false,

                                    init() {
                                        this.maxVisibleLi = 5;
                                        this.updateData();
                                        window.addEventListener('resize', this.debounce(this.updateData, 100).bind(this));
                                    },

                                    debounce(func, wait) {
                                        let timeout;
                                        return function() {
                                            const context = this;
                                            const args = arguments;
                                            clearTimeout(timeout);
                                            timeout = setTimeout(() => func.apply(context, args), wait);
                                        };
                                    },

                                    updateData() {
                                        const ul = document.querySelector('ul[name="hor_bar"]');
                                        if (ul) {
                                            ul.style.display = 'none';
                                            ul.offsetHeight;
                                            ul.style.display = '';
                                            this.ulWidth = ul.offsetWidth;
                                            const lis = ul.querySelectorAll('li');
                                            lis.forEach(li => {
                                                li.style.display = '';
                                            });
                                            this.maxVisibleLi = 0;
                                            let barWidth = 0;
                                            for (let li of lis) {
                                                if (barWidth + li.offsetWidth <= this.ulWidth) {
                                                    barWidth += li.offsetWidth;
                                                    this.maxVisibleLi++;
                                                } else {
                                                    break;
                                                }
                                            }
                                            for (let i = this.maxVisibleLi; i < lis.length; i++) {
                                                lis[i].style.display = 'none';
                                            }

                                            // 更新 showButton 的值
                                            this.showButton = this.maxVisibleLi < 5;
                                        }
                                    }
                                }));
                            });
                        </script>

                    </div>
                </div>
                @yield('events_content')
            </div>
        </div>        
    </div>            
</div>

@endsection
