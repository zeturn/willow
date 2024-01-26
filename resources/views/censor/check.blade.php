@extends('layouts.page')

@section('content')

<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-6">
            @yield('censor_content')
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <!-- Entry Information -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-4">
            @yield('censor_sidebar')
            </div>
        </div>
    </div>
</div>


@endsection