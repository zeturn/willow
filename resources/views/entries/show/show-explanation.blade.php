@extends('entries.show.entry') {{-- 确保使用了正确的布局文件 --}}

@section('entry-content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-6">
                <p class="text-gray-700 dark:text-gray-300 text-">{{ $demoVersion->content }}</p>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">

            <!-- Demo Branch Information -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-4">
                <h2 class="text-2xl mb-2 dark:text-white">Demo Branch</h2>
                <p class="text-gray-700 dark:text-gray-300">Id: {{ $demoBranch->id }}</p>
                <p class="text-gray-700 dark:text-gray-300">Description: {{ $demoBranch->description }}</p>
            </div>


        
        </div>
    </div>
</div>
@endsection
