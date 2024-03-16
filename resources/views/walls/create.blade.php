@extends('layouts.page')

@section('content')
<div class="container mx-auto mt-5 max-w-5xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full px-4">
            <div class="bg-white rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Create New Wall</h2>
                    <form action="{{ route('wall.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-lg" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 p-2 w-full border rounded-lg"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="eid" class="block text-sm font-medium text-gray-700">EID (Optional)</label>
                            <input type="text" name="eid" id="eid" class="mt-1 p-2 w-full border rounded-lg">
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Create Wall
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
