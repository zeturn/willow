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
                        <span class="bg-transparent text-pink-500 border border-pink-500 text-xs font-semibold mt-9 mr-3 px-2.5 py-0.5 rounded-full">Entry</span>
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

                    <ul class="flex flex-wrap items-center border-b border-slate-200" role="tablist">
                        <li role="presentation">
                            <a href="{{ route('entry.show.explanation', $entry->id) }}" class="{{ $tabname == 'entry.show.explanation' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Explanation</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('entry.show.branch.BranchesList', ['id' => $entry->id]) }}" class="{{ $tabname == 'entries.show.branch' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Branch</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('entry.show.community', $entry->id) }}" class="{{ $tabname == 'entry.show.community' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Community</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('entry.show.album', $entry->id) }}" class="{{ $tabname == 'entry.show.album' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Album</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('entry.show.details', $entry->id) }}" class="{{ $tabname == 'entry.show.details' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Details</a>
                        </li>
                        @auth
                        <li role="presentation">
                            <a href="{{ route('entry.show.control.GeneralSetting', $entry->id) }}" class="{{ $currentRouteName == 'entry.show.control' ? 'text-green-700 border-b-2 border-green-500 focus:border-green-700 hover:border-green-600 focus:outline-none focus:text-green-700 hover:text-green-600 focus:bg-green-50 hover:bg-green-50' : 'text-slate-700 hover:text-green-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Control</a>
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
