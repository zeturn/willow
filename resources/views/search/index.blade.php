@extends('layouts.blank')

@section('title')
{{ __('Search') }}
@endsection

@section('content')
    <div class="container h-screen flex justify-center mt-10">
        <div class="max-w-md mt-10">
            <div class="flex items-center justify-center mt-10 mb-4">
                <x-authentication-card-logo class="mx-auto mt-12" />
                <span class="ml-4 text-gray-300 font-semibold">|</span>
                <span class="ml-4 text-gray-300 font-semibold">{{__('actions.search')}}</span>
            </div>

            <form action="{{ route('search.result') }}" method="GET" class="mt-4">
                <div class="form-group">
                    <input type="text" name="query" id="query" class="w-full md:w-96 h-12 px-4 py-3 text-md text-slate-600 rounded-md dark:bg-gray-800 dark:border-gray-600 ring-offset-background placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 dark:focus:border-blue-300 dark:focus:ring-blue-800 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter everything...">
                </div>
            </form>
        </div>
    </div>
@endsection
