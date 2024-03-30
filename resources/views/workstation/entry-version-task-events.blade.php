@extends('workstation.events')

@section('events_content')
<div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
    <h3 class="text-2xl font-semibold mb-2 text-blue-700 dark:text-blue-400">{{ __('Entry Version Tasks') }}</h3>
    @foreach($versionTasks as $item)
    <div class="flex items-start mb-4">
        <div class="w-3/4">
            <a href="{{ route('entry.version.editor', $item->id) }}" class="text-blue-700 dark:text-blue-400 block">
                <h4 class="text-lg font-semibold">{{ $item->name }}</h4>
                <p class="text-sm text-gray-500">{{ $item->updated_at->format('M d, Y H:i') }}</p>
            </a>
        </div>
        <div class="w-1/4 text-right">
            <span class="text-sm font-semibold">{{ $item->id }}</span>
        </div>
    </div>
    @endforeach
    <!-- Pagination -->
    <div class="mt-4">
        {{$versionTasks->links() }}
    </div>
</div>

@endsection