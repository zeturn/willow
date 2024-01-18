{{-- entries/branches/show/control/push-requests.blade.php --}}
@extends('entries.branches.show.control.control')

@section('entry-branch-control-content')
    <h2 class="text-2xl font-semibold dark:text-white">Push Requests</h2>
    <ul class="mt-4">
        @foreach($versionsforreview as $version)
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
    </ul>
@endsection
