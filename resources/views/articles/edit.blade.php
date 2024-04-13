@extends('layouts.page')

@section('title', 'Edit Article')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Edit Article</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ $article->title }}" class="border p-2 w-full rounded" required>
        </div>
        <div class="mb-4">
            <label for="content" class="block text-gray-700">Content</label>
            <textarea name="content" id="content" class="border p-2 w-full rounded" required>{{ $article->content }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Update</button>
    </form>
</div>
@endsection
