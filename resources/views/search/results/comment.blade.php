@extends('search.results.result')

@section('filter')

@endsection

@section('result-list')

    @if ($results->isEmpty())
        <p class="text-center text-gray-500 my-4">{{__('basic.No results found')}}</p>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach ($results as $comment)
                <li class="py-4"><a href="{{ route('comment.show', ['comment' => $comment->id]) }}" class="block text-lg font-semibold text-gray-800">{{ $comment->content }}</a>
                    <span class="block text-sm text-gray-500">{{ $comment->id }}</span>
                    <!-- Add other fields you want to display -->
                </li>
            @endforeach
        </ul>
    @endif

@endsection


@section('content-bar')

@endsection