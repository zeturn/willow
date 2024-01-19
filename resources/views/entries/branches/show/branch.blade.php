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

                <div class = "px-6">
                    <h1 class="text-3xl font-semibold dark:text-white">Branch:{{ $branch->id }}</h1>
                    <h2 class="text-2xl font-semibold dark:text-white">From:{{ $branch->entry->name }}</h2>
                </div>
                {{-- Tabs Navigation --}}
                @php
                    $currentRouteName = Route::currentRouteName();
                @endphp

                <ul class="flex border-b dark:border-gray-700">
                    <li class="-mb-px mr-1">
                        <a href="{{ route('entry.branch.show.showDemoVersion', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-demo-version' ? 'text-blue-700 border-l border-t border-r rounded-t' : 'text-blue-500' }} bg-white dark:bg-gray-800 inline-block py-2 px-4 font-semibold">Demo Version</a>
                    </li>
                    <li class="-mb-px mr-1">
                        <a href="{{ route('entry.branch.show.showVersionList', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-version-list' ? 'text-blue-700 border-l border-t border-r rounded-t' : 'text-blue-500' }} bg-white dark:bg-gray-800 inline-block py-2 px-4 font-semibold">Version List</a>
                    </li>
                    <li class="-mb-px mr-1">
                        <a href="{{ route('entry.branch.show.showInfo', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-info' ? 'text-blue-700 border-l border-t border-r rounded-t' : 'text-blue-500' }} bg-white dark:bg-gray-800 inline-block py-2 px-4 font-semibold">Info</a>
                    </li>
                    <li class="-mb-px mr-1">
                        <a href="{{ route('entry.branch.show.showEditors', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-editors' ? 'text-blue-700 border-l border-t border-r rounded-t' : 'text-blue-500' }} bg-white dark:bg-gray-800 inline-block py-2 px-4 font-semibold">Editors</a>
                    </li>
                    @auth
                    <li class="-mb-px mr-1">
                        <a href="{{ route('entry.branch.show.showControl', $branch->id) }}" class="{{ $currentRouteName == 'entries.branches.show.show-control' ? 'text-blue-700 border-l border-t border-r rounded-t' : 'text-green-500' }} bg-white dark:bg-gray-800 inline-block py-2 px-4 font-semibold">Control</a>
                    </li>
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
                <div class="mb-6">
                    <a href="{{ route('entry.show.explanation', $branch->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out">
                        < {{ __('Back to Entry') }}
                    </a>
                </div>
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
