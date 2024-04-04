{{-- entries.show.entry --}}
@extends('layouts.page')

@section('title')
{{ $entry->name }} - entry
@endsection

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


                <div class="flex border-b border-slate-200">
                    <ul class="flex flex-grow flex-wrap items-center" role="tablist" x-data="tabList()" name="hor_bar">
                        <li  x-show="maxVisibleLi > 0" role="presentation">
                            <a href="{{ route('entry.show.explanation', $entry->id) }}"  x-ref="tab1" role="tab" aria-controls="tabpanel-explanation" class="{{ $tabname == 'entry.show.explanation' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Explanation</a>
                        </li>
                        <li  x-show="maxVisibleLi > 1" role="presentation">
                            <a href="{{ route('entry.show.branch.BranchesList', ['id' => $entry->id]) }}"  x-ref="tab2" role="tab" aria-controls="tabpanel-brancheslist" class="{{ $tabname == 'entries.show.branch' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Branch</a>
                        </li>
                        <li  x-show="maxVisibleLi > 2" role="presentation">
                            <a href="{{ route('entry.show.community', $entry->id) }}"  x-ref="tab3" role="tab" aria-controls="tabpanel-community" class="{{ $tabname == 'entry.show.community' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Community</a>
                        </li>
                        <li  x-show="maxVisibleLi > 3" role="presentation">
                            <a href="{{ route('entry.show.album', $entry->id) }}"  x-ref="tab4" role="tab" aria-controls="tabpanel-album" class="{{ $tabname == 'entry.show.album' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Album</a>
                        </li>
                        <li  x-show="maxVisibleLi > 4" role="presentation">
                            <a href="{{ route('entry.show.details', $entry->id) }}"  x-ref="tab5" role="tab" aria-controls="tabpanel-details" class="{{ $tabname == 'entry.show.details' ? 'text-emerald-700 border-b-2 border-emerald-500 focus:border-emerald-700 hover:border-emerald-600 focus:outline-none focus:text-emerald-700 hover:text-emerald-600 focus:bg-emerald-50 hover:bg-emerald-50' : 'text-slate-700 hover:text-emerald-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Details</a>
                        </li>
                        @auth
                        <li  x-show="maxVisibleLi > 5" role="presentation">
                            <a href="{{ route('entry.show.control.GeneralSetting', $entry->id) }}"  x-ref="tab6" role="tab" aria-controls="tabpanel-setting" class="{{ $currentRouteName == 'entry.show.control' ? 'text-green-700 border-b-2 border-green-500 focus:border-green-700 hover:border-green-600 focus:outline-none focus:text-green-700 hover:text-green-600 focus:bg-green-50 hover:bg-green-50' : 'text-slate-700 hover:text-green-500' }} inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-md font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none border-transparent">Control</a>
                        </li>
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
                                    <a href="{{ route('entry.show.explanation', $entry->id) }}" x-show="maxVisibleLi < 1" @click="dropdownOpen=false" class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                        <span>Explanation</span>
                                    </a>
                                    <a href="{{ route('entry.show.branch.BranchesList', ['id' => $entry->id]) }}" x-show="maxVisibleLi < 2" @click="dropdownOpen=false" class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                        <span>Branch</span>
                                    </a>
                                    <a href="{{ route('entry.show.community', $entry->id) }}" x-show="maxVisibleLi < 3" @click="dropdownOpen=false" class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                        <span>Community</span>
                                    </a>
                                    <a href="{{ route('entry.show.album', $entry->id) }}" x-show="maxVisibleLi < 4" @click="dropdownOpen=false" class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                        <span>Album</span>
                                    </a>
                                    <a href="{{ route('entry.show.details', $entry->id) }}" x-show="maxVisibleLi < 5" @click="dropdownOpen=false" class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                        <span>Details</span>
                                    </a>
                                    @auth
                                    <a href="{{ route('entry.show.control.GeneralSetting', $entry->id) }}" x-show="maxVisibleLi < 6" @click="dropdownOpen=false" class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                        <span>Control</span>
                                    </a>
                                    @endauth
                                </div>
                            </div>
                    </div><!--alp-->



                        </div>
                        </div>
                            <script>
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('tabList', () => ({
                                        ulWidth: 0,
                                        liCount: 0,
                                        maxVisibleLi: 6,
                                        // 添加一个属性来控制按钮的显示
                                        showButton: false,
                                        dropdownOpen: false,

                                        init() {
                                            this.maxVisibleLi = 6;
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
                                                this.showButton = this.maxVisibleLi < 6;
                                            }
                                        }
                                    }));
                                });
                            </script>

            
            
                        {{-- Tab Content --}}
                        @yield('entry-content')
                    </div>
        </div>
    </div>
</div>
@endsection



