@extends('entries.show.entry')

@section('entry-content')

<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($albums as $album)
                <a href="{{ route('albums.show', ['id' => $album->id]) }}" class="block">
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 transform transition duration-500">
                        <img class="w-full h-48 object-cover rounded-t-lg" src="{{ $albumsCover[$album->id] }}" alt="Album Cover">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2 text-gray-800 dark:text-white">{{ $album->title }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg mb-4">
                @livewire('show-albums-in-entry', ['entryId' => $entryId])
            </div>
        </div>
    </div>
</div>

@endsection
