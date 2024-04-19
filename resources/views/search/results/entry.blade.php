@extends('search.results.result')

@section('filter')

@endsection

@section('result-list')


    @if ($results->isEmpty())
        @if($query == "everything")
            <p class="text-center text-gray-500 my-4">No results found,</p>
            <p class="text-center text-gray-500 my-4">but everything is here.</p>
        @else
            <p class="text-center text-gray-500 my-4">{{__('basic.No results found')}}</p>
        @endif
    @else
        @if($query == "everything")
            <p class="text-center text-gray-500 my-4">{{__('basic.Everything is here')}}</p>
        @endif
        <ul class="divide-y divide-gray-200">
            @foreach ($results as $entry)
                <li class="py-4">
                    <a href="{{ route('entry.show.explanation', ['id' => $entry->id]) }}" class="block text-lg font-semibold text-gray-500">{{ $entry->name }}</a>
                    <span class="block text-sm text-gray-500">{{ $entry->id }}</span>
                    <!-- Add other fields you want to display -->
                </li>
            @endforeach
        </ul>
    @endif

@endsection


@section('content-bar')

@endsection
