{{-- entries/branches/show/show-version-list.blade.php --}}
@extends('entries.branches.show.branch')

@section('action-button')
    {{-- Custom action button can be added here if needed --}}
@endsection

@section('entry-content')
    {{-- Content specific to Version List --}}
    <div class="space-y-4">
        @foreach($versions as $version)
            <a href="{{ route('entry.version.show', $version->id) }}" >
                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 dark:border-gray-700 mb-4 shadow-sm">
                    <h3 class="text-xl font-semibold dark:text-white">{{ $version->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Author: {{ $version->author_id }} | Created: {{ $version->created_at->format('M d, Y') }}</p>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        {{ \Illuminate\Support\Str::limit($version->description, 150, '...') }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
    {{-- Additional content can be added here --}}
@endsection
