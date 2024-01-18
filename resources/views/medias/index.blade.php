{{-- medias/index.blade.php --}}

@extends('layouts.page')

@section('title', __('Media List'))

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <h1 class="text-2xl font-bold mb-4">{{ __('Media List') }}</h1>

    <div class="flex flex-wrap -mx-4">
        <!-- Main Content Section -->
        <div class="w-full lg:w-3/4 px-4">
            @foreach ($medias as $media)
                <div class="mb-4">
                    <a href="{{ route('medias.show', $media->id) }}" class="block">
                        <div class="flex bg-white rounded-lg p-4 dark:border-gray-700 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="flex-none w-1/4 bg-white p-2">
                                <img src="{{ $media->url }}" alt="{{ __('Media Image') }}" class="object-contain h-32 w-full">
                            </div>
                            <div class="flex-grow pl-4">
                                <p class="text-lg">{{ __('Description') }}: {{ $media->description ?? __('No Description') }}</p>
                                @if ($media->user)
                                    <p>{{ __('Uploader ID') }}: {{ $media->user->id }}</p>
                                    <p>{{ __('Uploader Name') }}: {{ $media->user->name }}</p>
                                    <p>{{ __('Upload Time') }}: {{ $media->created_at->format('Y-m-d H:i:s') }}</p>
                                @endif
                                {{-- Other media information --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            {{-- Pagination links --}}
            <div class="mt-4">
                {{ $medias->links() }}
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h3 class="text-black font-bold dark:text-white py-2 px-4 rounded-lg">
                    {{ __('Operations') }}
                </h3>
                <a href="{{ route('medias.create') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Add New Media') }}
                </a>
                <!-- Other sidebar content -->
            </div>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h3 class="text-black font-bold dark:text-white py-2 px-4 rounded-lg">
                    {{ __('Links') }}
                </h3>
                <a href="{{ route('albums.index') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Albums') }}
                </a>
                <!-- Other sidebar content -->
            </div>
        </div>
    </div>
</div>
@endsection
