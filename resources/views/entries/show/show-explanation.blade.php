@extends('entries.show.entry') {{-- Ensure the correct layout file is used --}}

@section('entry-content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-6">
                <p class="text-gray-700 dark:text-gray-300">{!! \Illuminate\Support\Str::markdown($demoVersion->content) !!}</p>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <!-- Demo Branch Information -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-2xl mb-2 dark:text-white">{{ __('Demo Branch') }}</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ __('Id') }}: {{ $demoBranch->id }}</p>
                <p class="text-gray-700 dark:text-gray-300">{{ __('Description') }}: {{ $demoBranch->description }}</p>
                @auth
                        <a href="{{ route('entry.editgate', $entry->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                            </svg>
                            Edit
                        </a>
                        @endauth
            </div>

            <!-- Related Nodes -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-2xl mb-2 dark:text-white">{{ __('Related Nodes') }}</h2>
                <div class="mt-4">
                    @foreach ($nodes as $node)
                        <div class="bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700 mb-4">
                            <a href="{{ route('nodes.show', $node->id) }}" class="text-lg text-blue-500 hover:text-blue-600 font-semibold">{{ $node->name }}</a>
                            <p class="text-gray-600 dark:text-gray-300">{{ $node->status }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
