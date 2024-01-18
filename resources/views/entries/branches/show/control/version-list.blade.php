{{-- entries/branches/show/control/version-list.blade.php --}}
@extends('entries.branches.show.control.control')

@section('entry-branch-control-content')
    <div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
        <h2 class="text-2xl font-semibold dark:text-white mb-6">Version List</h2>
        <ul class="mt-4 bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            @forelse($versions as $version)
                <li class="border-b border-gray-300 dark:border-gray-600 last:border-b-0 py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    {{ $version->name }}
                </li>
            @empty
                <li class="py-2 px-4 text-gray-500 dark:text-gray-400">
                    No versions available.
                </li>
            @endforelse
        </ul>
    </div>
@endsection
