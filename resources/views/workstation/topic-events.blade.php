@extends('workstation.events')

@section('events_content')
<div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
    @foreach($topics as $topic)
        <div class="flex items-center justify-between mb-4">
            <div class="flex flex-col">
                <a href="{{ route('topic.show', $topic->id) }}" class="text-blue-700 dark:text-blue-400">
                    <span class="font-semibold text-lg">{{ $topic->name }}</span>
                </a>
                <span class="text-sm text-gray-500 mt-1">{{ $topic->updated_at->format('M d, Y H:i') }}</span>
            </div>
            <span class="text-gray-500 text-sm">{{ $topic->id }}</span>
        </div>
    @endforeach
    <!-- Pagination -->
    <div class="mt-4">
        {{$topics->links() }}
    </div>
</div>

@endsection