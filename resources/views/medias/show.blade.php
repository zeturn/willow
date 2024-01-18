{{-- medias/show.blade.php --}}

@extends('layouts.page')

@section('content')
<div class="container mx-auto max-w-9xl p-4">
    <div class="flex flex-col md:flex-row md:w-10/12 mx-auto bg-white my-6 rounded-lg">
        <div id="media-image-container" class="md:w-1/2 rounded-lg">
            <div class="relative w-full h-64 md:h-96">
                <img src="{{ $media->url }}" class="absolute top-0 left-0 w-full h-full object-contain" alt="{{ __('Media Image') }}">
            </div>
        </div>
        <div class="md:w-1/2 p-8">
            <h1 class="text-2xl font-bold">{{ __('Media Details') }}</h1>
            <div class="overflow-hidden text-ellipsis">
                <p><strong>{{ __('URL') }}:</strong> <a href="{{ $media->url }}" class="text-blue-600 hover:text-blue-800" target="_blank">{{ $media->url }}</a></p>
            </div>
            <p><strong>{{ __('Description') }}:</strong> {{ $media->description }}</p>
            <!-- Additional media details can be added here -->

            <!-- Delete media form -->
            <form action="{{ route('medias.delete', $media->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete this media?') }}');">{{ __('Delete Media') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
