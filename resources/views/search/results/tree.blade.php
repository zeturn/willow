@extends('search.results.result')

@section('filter')

@endsection

@section('result-list')

    @if ($results->isEmpty())
        <p class="text-center text-gray-500 my-4">{{__('basic.No results found')}}</p>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach ($results as $tree)
                <li class="py-4">
                    <a href="{{ route('trees.show', ['tree' => $tree->id]) }}" class="block text-lg font-semibold text-gray-800">{{ $tree->name }}</a>
                    <span class="block text-sm text-gray-500">{{ $tree->id }}</span>
                    <!-- Add other fields you want to display -->
                </li>
            @endforeach
        </ul>
    @endif

@endsection
