@extends('search.results.result')

@section('filter')

@endsection

@section('result-list')

    @if ($results->isEmpty())
        <p class="text-center text-gray-500 my-4">{{__('basic.No results found')}}</p>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach ($results as $entry_version)
                <li class="py-4">
                    <a href="{{ route('entry.version.show', ['versionId' => $entry_version->id]) }}" class="block text-lg font-semibold text-gray-800">{{ $entry_version->name }}</a>
                    <span class="block text-sm text-gray-500">{{ $entry_version->id }}</span>
                    <!-- Add other fields you want to display -->
                </li>
            @endforeach
        </ul>
    @endif

@endsection


@section('content-bar')

@endsection
