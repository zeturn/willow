@extends('layouts.page')

@section('content')
    <div class="container">
        <h1>Search Entries</h1>

        <form action="{{ route('search.entry') }}" method="GET">
            <div class="form-group">
                <label for="query">Search:</label>
                <input type="text" name="query" id="query" class="form-control" placeholder="Enter your search query...">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <hr>

        @if (!empty($entries))
            <h2>Search Results</h2>

            @if ($entries->isEmpty())
                <p>No results found.</p>
            @else
                <ul>
                    @foreach ($entries as $entry)
                        <li>{{ $entry->title }}</li>
                        <!-- Add other fields you want to display -->
                    @endforeach
                </ul>
            @endif
        @endif
    </div>
@endsection
