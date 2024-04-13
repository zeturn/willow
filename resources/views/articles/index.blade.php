@extends('layouts.page')

@section('title', 'Article')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">{{__('basic.Article')}}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($articles as $article)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2"><a href="{{ route('articles.show', $article->id) }}" class="text-blue-500 hover:underline">{{$article->title }}</a></h2>
            </div>
        @endforeach
    </div>
</div>
@endsection
