{{-- entries/show/control/control.blade.php --}}
@extends('entries.show.entry')

@section('action-button')
    {{-- Custom action button specific to Info view --}}
@endsection

@section('entry-content')
<div class="container mx-auto p-4 max-w-7xl flex flex-col lg:flex-row">
    <!-- Sidebar, 在大屏幕时位于左侧，在小屏幕时位于顶部 -->
    <div class="sticky top-0 flex flex-col w-full lg:w-1/6 h-auto lg:h-screen px-5 py-8 overflow-y-auto border-b lg:border-b-0 lg:border-r rtl:border-r-0 rtl:border-l ">
        <div class="flex flex-col justify-between flex-1">
            <nav class="-mx-3 space-y-6">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">{{__('basic.General')}}</label>

                <a href="{{ route('entry.show.control.GeneralSetting', $entry->id) }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                    </svg>

                    <span class="mx-2 text-sm font-medium">{{__('basic.General')}}{{__('basic.Setting')}}</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- 主视图, 在所有屏幕上占据剩余空间 -->
    <div class="flex-grow p-8 dark:text-gray-400">
        @yield('entry-control-content')
    </div>
</div>


@endsection
