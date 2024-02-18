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
