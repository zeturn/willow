{{-- entries/branches/show/branch.blade.php --}}
@extends('layouts.page')

@section('content')
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
                        <li><a href="{{ route('entry.show.explanation', $branch->entry->id) }}" class="inline-flex items-center py-1 font-normal hover:text-neutral-900 focus:outline-none">{{ $branch->entry?->name }}</a></li>
                        <span class="mx-2 text-gray-400">/</span>
                        <li><a class="inline-flex items-center py-1 font-normal rounded cursor-default active-breadcrumb focus:outline-none"> {{ $branch?->name }}</a></li>
                    </ol>
                </nav>

                <div class = "px-6">
                    <h1 class="text-3xl font-semibold dark:text-white">Branch:{{ $branch->id }}</h1>
                    <h2 class="text-2xl font-semibold dark:text-white">From:{{ $branch->entry->name }}</h2>
                </div>
                {{-- Tabs Navigation --}}
                @php
                    $currentRouteName = Route::currentRouteName();
                @endphp

                <ul class="flex items-center border-b border-slate-200">
                    <li role="presentation">
                        <a href="{{ route('entry.branch.show.showDemoVersion', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-demo-version' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible : outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="1" tabindex="{{ $currentRouteName == 'entries.branches.show.show-demo-version' ? '0' : '-1' }}" aria-controls="tab-panel-1a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-demo-version' ? 'true' : 'false' }}">
                            <span>Demo Version</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="{{ route('entry.branch.show.showVersionList', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-version-list' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="2" tabindex="{{ $currentRouteName == 'entries.branches.show.show-version-list' ? '0' : '-1' }}" aria-controls="tab-panel-2a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-version-list' ? 'true' : 'false' }}">
                            <span>Version List</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="{{ route('entry.branch.show.showInfo', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-info' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="3" tabindex="{{ $currentRouteName == 'entries.branches.show.show-info' ? '0' : '-1' }}" aria-controls="tab-panel-3a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-info' ? 'true' : 'false' }}">
                            <span>Info</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="{{ route('entry.branch.show.showEditors', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-editors' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="4" tabindex="{{ $currentRouteName == 'entries.branches.show.show-editors' ? '0' : '-1' }}" aria-controls="tab-panel-4a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-editors' ? 'true' : 'false' }}">
                            <span>Editors</span>
                        </a>
                    </li>
                    @auth
                    @if($branch->owner->id == Auth::id())
                    <li role="presentation">
                        <a href="{{ route('entry.branch.show.showControl', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-control' ? 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-emerald-500 hover:border-emerald-600 focus:border-emerald-700 text-emerald-500 hover:text-emerald-600 focus:text-emerald-700 hover:bg-emerald-50 focus:bg-emerald-50' : 'inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-emerald-500 focus:border-emerald-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-emerald-50 hover:text-emerald-500 focus:stroke-emerald-600 focus:bg-emerald-50 focus:text-emerald-600 hover:stroke-emerald-600' }}" role="tab" aria-setsize="3" aria-posinset="5" tabindex="{{ $currentRouteName == 'entries.branches.show.show-control' ? '0' : '-1' }}" aria-controls="tab-panel-5a" aria-selected="{{ $currentRouteName == 'entries.branches.show.show-control' ? 'true' : 'false' }}">
                            <span>Control</span>
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>

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
                            {{ __('Owner') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $branch->owner->name }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Created At') }}
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
