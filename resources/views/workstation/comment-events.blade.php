@extends('workstation.events')

@section('events_content')
<div class="bg-green-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
    <h3 class="text-2xl font-semibold mb-4">{{ __('Comments') }}</h3>
    @foreach($comments as $comment)
    <div class="mb-2">
        <a href="{{ route('comment.show', $comment->id) }}" class="hover:text-green-500">
        <span class="font-semibold">{{ \Illuminate\Support\Str::limit($comment->content, 30) }}</span> - <span class="text-sm text-gray-500">Updated at: {{ $comment->updated_at->format('M d, Y H:i') }}</span>
        </a>
    </div>
    @endforeach
</div>
@endsection