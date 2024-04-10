{{-- albums/index.blade.php --}}

@extends('layouts.page')

@section('title', 'All Albums')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <h1 class="text-xl font-bold mb-4">Album List</h1>
    <div class="flex flex-wrap -mx-4">
    <div class="w-full lg:w-3/4 px-4">
            @foreach ($albums as $album)
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-lg font-semibold dark:text-white">{{ $album->title }}</h2>
                <div class="flex-grow">
                    <p class="text-lg dark:text-white">{{ __('Album Description') }}: {{ $album->description ?? __('No Description') }}</p>
                    @if ($album->user)
                        <p class="dark:text-white">{{ __('Uploader ID') }}: {{ $album->user->id }}</p>
                        <p class="dark:text-white">{{ __('Uploader Name') }}: {{ $album->user->name }}</p>
                        <p class="dark:text-white">{{ __('Creation Time') }}: {{ $album->created_at->format('Y-m-d H:i:s') }}</p>
                    @endif
                    {{-- Other album information --}}
                </div>
                <div class="flex justify-start space-x-2">
                    <a href="{{ route('albums.show', $album->id) }}" class="text-color-primary-500 hover:text-color-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                    @can('album-delete')
                    <form action="{{ route('albums.delete', $album->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-color-danger-500 hover:bg-color-danger-600 text-black" onclick="return confirm('Are you sure you want to delete this album?');">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
            @endforeach
        </div>
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div class="mb-4">
                    <h3 class="text-black font-bold dark:text-white py-2 px-4 rounded-lg">
                        {{ __('Operations') }}
                    </h3>
                </div>
                <a href="{{ route('albums.stableCreate') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Add New Album') }}
                </a>
                <!-- You can add other sidebar content here -->
            </div>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div class="mb-4">
                    <h3 class="text-black font-bold dark:text-white py-2 px-4 rounded-lg">
                        {{ __('links') }}
                    </h3>
                </div>
                <a href="{{ route('medias.index') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Medias') }}
                </a>
                <!-- You can add other sidebar content here -->
            </div>

        </div>
    </div>
</div>
@endsection
