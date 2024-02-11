@extends('search.results.result')

@section('filter')

@endsection

@section('result-list')

    @if ($results->isEmpty())
        <p class="text-center text-gray-500 my-4">No results found.</p>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach ($results as $media)
                <li class="py-4">
                    <a href="{{ route('medias.show', ['media' => $media->id]) }}" class="block text-lg font-semibold text-gray-800">{{ $media->id }}</a>
                    <span class="block text-sm text-gray-500">{{ $media->description }}</span>
                    <!-- Add other fields you want to display -->
                </li>
            @endforeach
        </ul>
    @endif

@endsection


@section('content-bar')

@endsection
