@extends('workstation.events')

@section('events_content')
<div class="bg-white rounded-lg p-8 dark:border-gray-700 dark:bg-gray-800 mb-4">
    @foreach($comments as $comment)
    <div class="flex items-start mb-6">
        <div class="flex-1">
            <a href="{{ route('comment.show', $comment->id) }}" class="hover:text-blue-500">
                <h4 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($comment->content, 30) }}</h4>
            </a>
            <p class="text-sm text-gray-500">{{ $comment->updated_at->format('M d, Y H:i') }}</p>
        </div>
        <span class="text-gray-500 text-sm ml-4">{{ $comment->id }}</span>
    </div>
    @endforeach
    <!-- Pagination -->
    <div class="mt-4">
        {{ $comments->links() }}
    </div>
</div>

@endsection