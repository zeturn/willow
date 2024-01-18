@extends('entries.show.entry')

@section('entry-content')
    <div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
        <div class="flex flex-wrap -mx-4">
            <!-- Main Column -->
            <div class="w-full lg:w-3/4 px-4">
                <div class="space-y-6">
                    @foreach ($walls as $wall)
                        <!-- Wall Display -->
                        <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-blue-600 hover:text-blue-700">
                                    <a href="{{ route('wall.show', $wall->id) }}">{{ $wall->name }}</a>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">{{ $wall->description }}</p>
                            </div>
                            
                            <!-- Topics Display -->
                            <div class="bg-gray-100 dark:bg-gray-800 p-4">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Topics:</h4>
                                @forelse ($wall->topics as $topic)
                                    <div class="mt-3">
                                        <h5 class="text-md font-semibold text-blue-500 hover:text-blue-600">
                                            <a href="{{ route('topic.show', $topic->id) }}">{{ $topic->name }}</a>
                                        </h5>
                                        <p class="text-gray-500 dark:text-gray-400">{{ $topic->description }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500 dark:text-gray-400">No topics available.</p>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow mb-4">
                    <div class="space-y-4">
                        @forelse($walls as $wall)
                            <a href="{{ route('wall.show', $wall->id) }}" class="text-lg font-semibold text-blue-500 hover:text-blue-600 transition duration-200">{{ $wall->name }}</a>
                        @empty
                            <p class="text-gray-600 dark:text-gray-300">No related walls.</p>
                        @endforelse
                    </div>

                    <!-- Form for creating link -->
                    @if(auth()->check())
                        <form action="{{ route('entry.createEWLink', $entry->id) }}" method="POST" class="mt-6">
                            @csrf
                            <div class="space-y-4">
                                <!-- Wall Name Input -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wall Name:</label>
                                    <input type="text" id="name" name="name" required class="bg-white border border-gray-300 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>

                                <!-- Wall Slug Input -->
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wall Slug:</label>
                                    <input type="text" id="slug" name="slug" required class="bg-white border border-gray-300 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>

                                <!-- Wall Description Input -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wall Description:</label>
                                    <textarea id="description" name="description" required class="bg-white border border-gray-300 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <input type="submit" value="Create Link" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        </form>
                    @else
                        <p class="mt-6 text-gray-700 dark:text-gray-400">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to create a link.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
