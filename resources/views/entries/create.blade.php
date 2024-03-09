@extends('layouts.page')

@section('title')
    {{ __('Create New Entry') }}
@endsection

@section('content')
  <div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
      <div class="w-full px-4">
        <h1 class="text-3xl mb-4 dark:text-white">Create New Entry</h1>
        <h2 class="text-2xl mb-4 dark:text-white">{{ __('Create new entry, branch, version') }}</h2>

        <!-- Form -->
        <form id='createEntryForm'action="{{ route('entry.store') }}" method="POST">
          @csrf
          
          <!-- Entry name -->
          <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-white">Entry name</label>
            <input type="text" id="name" name="name" class="p-2 w-full border rounded dark:bg-gray-800 dark:border-gray-700" required>
          </div>

          <!-- Entry description -->
          <div class="mb-4">
            <label for="description" class="block text-gray-700 dark:text-white">Entry description</label>
            <textarea id="description" name="description" rows="4" class="p-2 w-full border rounded dark:bg-gray-800 dark:border-gray-700" required></textarea>
          </div>

          <!-- Entry description -->
          <div class="mb-4">
            <label for="meta" class="block text-gray-700 dark:text-white">Entry meta</label>
            <textarea id="meta" name="meta" rows="4" class="p-2 w-full border rounded dark:bg-gray-800 dark:border-gray-700"></textarea>
          </div>

          <!-- Entry content -->
          <div class="mb-4">
            <div class="flex flex-col space-y-2">
                <label for="editor" class="text-gray-600 font-semibold">Content</label>
                <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><div>
            </div>
          </div>

          <input type="hidden" name="content" id="content">

          <!-- Submit Button -->
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Create Entry') }}
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
