@extends('layouts.page')

@section('content')
    <div class="container">
        <h1>Search Results</h1>

        @if ($entries->isEmpty())
            <p>No results found.</p>
        @else
            <ul>
                @foreach ($entries as $entry)
                    <li>{{ $entry->name }}</li>
                    <!-- Add other fields you want to display -->
                @endforeach
            </ul>
        @endif
    </div>
@endsection
