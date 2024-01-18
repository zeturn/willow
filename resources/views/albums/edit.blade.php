{{-- albums/edit.blade.php --}}

@extends('layouts.page')

@section('title', 'Edit Album')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <form action="{{ route('albums.update', $album->id) }}" method="post" id="editAlbumForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Album Title Edit --}}
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">相册标题 (Album Title)</label>
                        <input type="text" name="title" value="{{ $album->title }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    {{-- Existing Photos Preview and Delete Option --}}
                    <div id="existing-photos" class="mb-4">
                        @foreach ($album->medias as $media)
                        <div class="photo inline-block p-2">
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                                <img src="{{ $media->url }}" alt="Photo" class="w-full h-32 object-cover">
                                <div class="px-4 py-2">
                                    <input type="checkbox" name="existing_photos[]" value="{{ $media->id }}" checked hidden>
                                    <button type="button" onclick="removePhoto(this, {{ $media->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">删除</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- New Photos Upload --}}
                    <div class="mb-4">
                        <label for="photos" class="block text-gray-700 text-sm font-bold mb-2">新增照片 (Add Photos)</label>
                        <input type="file" name="photos[]" multiple class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100">
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">更新相册 (Update Album)</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function removePhoto(button, mediaId) {
        const photoDiv = button.parentElement.parentElement;
        photoDiv.querySelector(`input[value="${mediaId}"]`).removeAttribute('checked');
        photoDiv.style.display = 'none';
    }
</script>
@endsection
