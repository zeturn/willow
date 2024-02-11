@extends('layouts.blank')

@section('content')
    <div class="container h-screen flex justify-center mt-10">
        <div class="max-w-md mt-10">
            <div class="flex items-center justify-center mt-10 mb-4">
                <x-authentication-card-logo class="mx-auto mt-12" />
                <span class="ml-4 text-gray-600 font-semibold">|</span>
                <span class="ml-4 text-gray-600 font-semibold">Search</span>
            </div>

            <form action="{{ route('search.result') }}" method="GET" class="mt-4">
                <div class="form-group">
                    <input type="text" name="query" id="query" class="w-full md:w-96 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background placeholder:text-gray-500 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter everything...">
                </div>
            </form>
        </div>
    </div>
@endsection
