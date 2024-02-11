@extends('layouts.blank')

@section('content')
    <div class="container h-screen flex justify-center items-center">
        <div class="max-w-md">
            <x-authentication-card-logo class="mx-auto mt-8" />

            <form action="{{ route('search.result') }}" method="GET" class="mt-8">
                <div class="form-group">
                    <input type="text" name="query" id="query" class="w-full md:w-96 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background placeholder:text-gray-500 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your search query...">
                </div>
            </form>
        </div>
    </div>
@endsection
