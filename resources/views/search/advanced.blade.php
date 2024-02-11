@extends('layouts.blank')

@section('content')
    <div class="container h-screen flex justify-center items-center">
        <div class="max-w-md">
            <x-authentication-card-logo class="mx-auto mt-8" />

            <form action="{{ route('search.result') }}" method="GET" class="mt-8">
                <div class="form-group">
                    <input type="text" name="query" id="query" class="w-full md:w-96 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background placeholder:text-gray-500 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your search query...">
                </div>

                <div class="form-group mt-4">
                    <label for="users">From these users:</label>
                    <select name="users[]" id="users" class="w-full md:w-96 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                        <option value="">Any User</option>
                        <!-- Populate options with users -->
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="dates">Created on the dates:</label>
                    <input type="date" name="start_date" id="start_date" class="w-full md:w-48 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                    <span class="mx-2">to</span>
                    <input type="date" name="end_date" id="end_date" class="w-full md:w-48 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                </div>

                <div class="form-group mt-4">
                    <label for="language">Written in this language:</label>
                    <select name="language" id="language" class="w-full md:w-96 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                        <option value="">Any Language</option>
                        <option value="english">English</option>
                        <option value="french">French</option>
                        <!-- Add more languages as needed -->
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="model_type">Search in:</label>
                    <select name="model_type" id="model_type" class="w-full md:w-96 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                        <option value="entry">Entries</option>
                        <option value="entry_branch">Entry Branches</option>
                        <option value="entry_version">Entry Versions</option>
                        <option value="wall">Walls</option>
                        <option value="topic">Topics</option>
                        <option value="comment">Comments</option>
                        <option value="media">Medias</option>
                        <option value="album">Albums</option>
                        <option value="tree">Trees</option>
                        <option value="node">Nodes</option>
                        <option value="edge">Edges</option>
                    </select>
                </div>

                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Search</button>
            </form>
        </div>
    </div>
@endsection
