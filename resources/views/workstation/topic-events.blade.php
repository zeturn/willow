@extends('workstation.events')

@section('events_content')
<div class="bg-blue-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
    <h3 class="text-2xl font-semibold mb-4">{{ __('Topics') }}</h3>
    @foreach($topics->take(5) as $topic)
        <div class="mb-2">
            <a href="{{ route('topic.show', $topic->id) }}" class="hover:text-blue-500">
            <span class="font-semibold">{{ $topic->name }}</span> - <span class="text-sm text-gray-500">Updated at: {{ $topic->updated_at->format('M d, Y H:i') }}</span>
            </a>
        </div>
    @endforeach
</div>
@endsection