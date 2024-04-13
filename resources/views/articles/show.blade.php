@extends('layouts.page')

@section('title', $article->title)

@section('content')
<div class="container mx-auto px-4 md:w-1/2">
    <div class="flex flex-col justify-center items-center ">
        
        <div class="flex flex-col w-full">
            <h1 class="text-4xl font-bold text-blue-700 mb-6">{{ $article->title }}</h1>
            <x-user-name-and-avatar :user-id="$article->user_id" class="w-12 h-12 rounded-full" />
            <p class="text-gray-500 py-4">{{__('basic.Created')}}: {{ $article->created_at }}, {{__('basic.Updated')}}: {{ $article->updated_at }}</p>
            <div class="mt-12">
                <p class="text-xl text-gray-700 leading-relaxed mx-auto">{!! $content !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection

