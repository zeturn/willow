@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="mb-5">
                <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Version List of {{ $branch->id }}</h1>
            </div>

            <!-- Versions Cards -->
            @foreach($versions as $version)
                <a href="{{ route('entry.version.show', $version->id) }}" class="block bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 transition">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ $version->name }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($version->description, 100) }}</p>
                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        <span>{{ $version->created_at->format('M d, Y') }}</span> · 
                        <span>{{ $version->author->name }}</span>
                    </div>
                </a>
            @endforeach

            <!-- Pagination -->
            <div class="mt-4">
                {{ $versions->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200 mb-4">Branch Info</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Branch ID: {{ $branch->id }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Entry ID: {{ $branch->entry_id }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Demo Version ID: {{ $branch->demo_version_id }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Is PB: {{ $branch->is_pb ? 'Yes' : 'No' }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Is Free: {{ $branch->is_free ? 'Yes' : 'No' }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Status: {{ $branch->status }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
