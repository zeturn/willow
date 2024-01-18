@extends('layouts.page')

@section('content')
<div class="container mx-auto mt-10 p-5">
    <div class="bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-5">创建新版本</h1>

        <form action="{{ route('entry.version.store', $branch->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-600">版本名称:</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-md outline-none focus:border-indigo-500" placeholder="输入版本名称" value="{{ old('$version->name') }}" required>
                @error('name')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-600">版本描述:</label>
                <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border rounded-md outline-none focus:border-indigo-500" placeholder="输入版本描述">{{ old('$version -> description') }}</textarea>
                @error('description')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block mb-2 text-sm font-medium text-gray-600">版本内容:</label>
                <textarea name="content" id="content" rows="8" class="w-full px-3 py-2 border rounded-md outline-none focus:border-indigo-500" placeholder="输入版本内容" required>{{ old('$version -> content') }}</textarea>
                @error('content')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">创建版本</button>
        </form>
    </div>
</div>
@endsection
