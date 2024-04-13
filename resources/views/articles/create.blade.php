@extends('layouts.page')

@section('title', 'Create Article')

@section('content')
<div class="container mx-auto px-4">
    <form action="{{ route('articles.store') }}" method="POST">
    <h1 class="text-3xl font-bold mb-6">{{__('basic.Create')}} {{__('basic.Article')}}</h1>
    <div class="max-w-md mx-auto md:max-w-6xl md:w-3/4 md:mx-auto">
        <div class="bg-white rounded p-6 md:p-8">

                @csrf
                <div class="mb-4">
                    <input type="text" name="title" id="title" class="w-full p-2 rounded border-none placeholder:text-gray-500" placeholder="标题" required>
                </div>
                <div class="mb-6">
                    <textarea name="content" id="content" class="w-full p-2 rounded border-none placeholder:text-gray-500" placeholder="内容" required></textarea>
                </div>

        </div>
    </div>
    <div class="fixed inset-x-0 bottom-0 md:relative md:mx-auto md:max-w-md md:mt-6">
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">{{__('basic.Create')}}</button>
    </div>
    </form>
</div>
@endsection
