{{-- entries/branches/show/branch.blade.php --}}
@extends('layouts.page')

@section('title')
{{ $branch->entry->name }} - branch
@endsection

@section('content')
<!--Trans:240412 Finish:All-->
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 dark:border-gray-700 mb-4">
                {{-- Content Header --}}
                <div class="flex justify-between items-center mb-6">
                    @yield('action-button')
                </div>
 
                <nav class="flex justify-between">
                    <ol class="inline-flex items-center mb-3 space-x-3 text-sm text-neutral-500 [&_.active-breadcrumb]:text-neutral-500/80 sm:mb-0">
                        <li class="flex items-center h-full"><a href="{{ url('/') }}" class="py-1 hover:text-neutral-900"><svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" /><path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" /></svg></a></li>  
                        <span class="mx-2 text-gray-400">/</span>
                        <li><a href="{{ route('entry.show.explanation', $branch->entry->id) }}" class="inline-flex items-center py-1 font-normal hover:text-neutral-900 focus:outline-none">{{ substr($branch->entry?->name, 0, 30) }}</a></li>
                        <span class="mx-2 text-gray-400">/</span>
                        <li><a class="inline-flex items-center py-1 font-normal rounded cursor-default active-breadcrumb focus:outline-none">{{ substr($branch?->name, 0, 30) }}</a></li>
                    </ol>
                </nav>

                <div class = "px-6">
                    <h1 class="text-3xl font-semibold dark:text-white">{{__('basic.Branch')}}:{{ $branch->id }}</h1>
                    <h2 class="text-2xl font-semibold dark:text-white">{{__('basic.From')}}:{{ $branch->entry->name }}</h2>
                </div>
                {{-- Tabs Navigation --}}
                @php
                    $currentRouteName = Route::currentRouteName();
                @endphp

                <div class="flex border-b border-slate-200">

                <ul class="flex flex-grow flex-wrap items-center " role="tablist" x-data="tabList()" name="hor_bar">
                    <li x-show="maxVisibleLi > 0" x-ref="tab1" role="presentation">
                        <a href="{{ route('entry.branch.show.showDemoVersion', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-demo-version' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible : outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="1" tabindex="{{ $currentRouteName == 'entries.branches.show.show-demo-version' ? '0' : '-1' }}" aria-controls="tab-panel-1a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-demo-version' ? 'true' : 'false' }}">
                            <span>{{__('basic.DemoVersion')}}</span>
                        </a>
                    </li>
                    <li x-show="maxVisibleLi > 1" x-ref="tab2" role="presentation">
                        <a href="{{ route('entry.branch.show.showVersionList', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-version-list' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="2" tabindex="{{ $currentRouteName == 'entries.branches.show.show-version-list' ? '0' : '-1' }}" aria-controls="tab-panel-2a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-version-list' ? 'true' : 'false' }}">
                            <span>{{__('basic.VersionList')}}</span>
                        </a>
                    </li>
                    <li x-show="maxVisibleLi > 2" x-ref="tab3" role="presentation">
                        <a href="{{ route('entry.branch.show.showInfo', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-info' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="3" tabindex="{{ $currentRouteName == 'entries.branches.show.show-info' ? '0' : '-1' }}" aria-controls="tab-panel-3a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-info' ? 'true' : 'false' }}">
                            <span>{{__('basic.Info')}}</span>
                        </a>
                    </li>
                    <li x-show="maxVisibleLi > 3" x-ref="tab4" role="presentation">
                        <a href="{{ route('entry.branch.show.showEditors', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-editors' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="4" tabindex="{{ $currentRouteName == 'entries.branches.show.show-editors' ? '0' : '-1' }}" aria-controls="tab-panel-4a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-editors' ? 'true' : 'false' }}">
                            <span>{{__('basic.Editors')}}</span>
                        </a>
                    </li>
                    @auth
                    @if($branch->owner->id == Auth::id())
                    <li x-show="maxVisibleLi > 4" x-ref="tab5" role="presentation">
                        <a href="{{ route('entry.branch.show.showControl', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-control' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="5" tabindex="{{ $currentRouteName == 'entries.branches.show.show-control' ? '0' : '-1' }}" aria-controls="tab-panel-5a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-control' ? 'true' : 'false' }}">
                            <span>{{__('basic.Control')}}</span>
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <div x-data="tabList" class="relative w-12">
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
                                    <a x-show="maxVisibleLi < 1" href="{{ route('entry.branch.show.showDemoVersion', $branch->id) }}" class="{{$currentRouteName == 'entries.branches.show.show-demo-version' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1" id="tab-panel-1a">Demo Version</a>
                                    <a x-show="maxVisibleLi < 2" href="{{ route('entry.branch.show.showVersionList', $branch->id) }}" class="{{$currentRouteName == 'entries.branches.show.show-version-list' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1" id="tab-panel-2a">Version List</a>
                                    <a x-show="maxVisibleLi < 3" href="{{ route('entry.branch.show.showInfo', $branch->id) }}" class="{{$currentRouteName == 'entries.branches.show.show-info' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1" id="tab-panel-3a">Info</a>
                                    <a x-show="maxVisibleLi < 4" href="{{ route('entry.branch.show.showEditors', $branch->id) }}" class="{{$currentRouteName == 'entries.branches.show.show-editors' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1" id="tab-panel-4a">Editors</a>
                                    @auth
                                    @if($branch->owner->id == Auth::id())
                                    <a x-show="maxVisibleLi < 5" href="{{ route('entry.branch.show.showControl', $branch->id) }}" class="{{$currentRouteName == 'entries.branches.show.show-control' ? 'block px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900' : 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}" role="menuitem" tabindex="-1" id="tab-panel-5a">Control</a>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                    </div><!--alp-->

                    </div>

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

                {{-- Tab Content --}}
                <div class="py-4">
                    @yield('entry-content')
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Author and Created At -->
                <dl>
                    <div class="mb-4">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('basic.Owner') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $branch->owner->name }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('basic.Created') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $branch->created_at->format('d M, Y') }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 dark:border-gray-700 mb-4">
                {{-- Sidebar content here --}}
                @yield('sidebar-content')
            </div>
        </div>
    </div>
</div>
@endsection
