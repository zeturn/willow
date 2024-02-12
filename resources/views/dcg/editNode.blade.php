@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Edit Node') }}</h1>
                <form action="{{ route('dcg.updateNode', $node->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}:</label>
                        <input type="text" name="name" id="name" value="{{ $node->name }}" required class="border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}:</label>
                        <textarea name="description" id="description" class="border-gray-300 rounded-md">{{ $node->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}:</label>
                        <input type="text" name="status" id="status" value="{{ $node->status }}" required class="border-gray-300 rounded-md">
                    </div>

                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 rounded-md p-2">{{ __('Update') }}</button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <x-patrol-button color="yellow" route="dcg.index" text1="前往DCG中心" text2="Go to dcg"></x-patrol-button>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Sidebar content goes here -->
            </div>
        </div>
    </div>
</div>
@endsection
