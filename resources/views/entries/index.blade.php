@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="mb-6">
                <h1 class="text-3xl dark:text-white">All Entries</h1>
            </div>
            <!-- Entry List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($entries as $entry)
                    <div class=" rounded-lg p-4 dark:border-gray-700 dark:bg-gray-800 bg-white">
                        <h2 class="text-xl dark:text-white">{{ $entry->name }}</h2>
                        <p class="text-gray-700 dark:text-gray-300">{{ $entry->description }}</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Created at: {{ $entry->created_at->format('d M, Y') }}</p>
                        <a href="{{ route('entry.show.explanation', $entry->id) }}" class="mt-2 inline-block text-blue-500 hover:underline">Learn more</a>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $entries->links() }}
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div class="mb-4">
                    <h3 class="text-black font-bold dark:text-white py-2 px-4 rounded-lg">
                        {{ __('Operations') }}
                    </h3>
                </div>
                @auth
                <a href="{{ route('entry.create') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Add New Entry') }}
                </a>
                @endauth
                <!-- You can add other sidebar content here -->
            </div>
        </div>
    </div>
</div>
@endsection
