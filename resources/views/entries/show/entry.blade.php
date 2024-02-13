{{-- entries.show.entry --}}
@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full px-4">
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-6">
                <div class="px-8">

                    {{-- Title and Button --}}
                    
                    <div class="flex justify-between items-center">
                        <h1 class="text-4xl mt-8 dark:text-white">{{ $entry->name }}</h1>
                        @auth
                        <a href="{{ route('entry.editgate', $entry->id) }}" class=" mb-8 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                            </svg>
                            Edit
                        </a>
                        @endauth
                    </div>
                    

                    {{-- Category Tag --}}
                    <div class="flex flex-wrap gap-2 mb-8">
                        @foreach($entry->trees as $tree)
                            <a href="{{ route('trees.show', ['tree' => $tree->id]) }}" class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                {{ $tree->name }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Tabs Navigation --}}
                    @php
                    $currentRouteName = Route::currentRouteName();
                    @endphp

                    <ul class="flex items-center border-b border-slate-200" role="tablist">
                        <li role="presentation">
                            <a href="{{ route('entry.show.explanation', $entry->id) }}" class="{{ $currentRouteName == 'entry.show.explanation' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Explanation</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('entry.show.branch.BranchesList', ['id' => $entry->id]) }}" class="{{ $currentRouteName == 'entry.show.branch.BranchesList' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Branch</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('entry.show.community', $entry->id) }}" class="{{ $currentRouteName == 'entry.show.community' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Community</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('entry.show.album', $entry->id) }}" class="{{ $currentRouteName == 'entry.show.album' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Album</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('entry.show.details', $entry->id) }}" class="{{ $currentRouteName == 'entry.show.details' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Details</a>
                        </li>
                        @auth
                        <li role="presentation">
                            <a href="{{ route('entry.show.control', $entry->id) }}" class="{{ $currentRouteName == 'entry.show.control' ? 'text-green-700 border-b-2 border-green-500 focus:border-green-700 hover:border-green-600 focus:outline-none focus:text-green-700 hover:text-green-600 focus:bg-green-50 hover:bg-green-50' : 'text-slate-700 hover:text-green-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Control</a>
                        </li>
                        @endauth
                    </ul>

                </div>










                
                {{-- Tab Content --}}
                @yield('entry-content')
            </div>
        </div>
    </div>
</div>
@endsection
