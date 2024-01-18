@extends('layouts.page')

@section('content')
<div class="container mx-auto mt-5 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg overflow-hidden mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Wall List</h2>
                    @foreach($walls as $wall)
                        <div class="mb-4 border-b pb-4">
                            <a href="{{ route('wall.show', $wall) }}" class="text-xl font-bold">{{ $wall->name }}</a>
                            <p class="text-gray-600">{{ $wall->description }}</p>
                            <p class="text-sm text-gray-400 mt-2">Created at: {{ $wall->created_at->format('d M, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">

            <div class="bg-white rounded-lg p-6 mb-4">
                <div class="mb-4">
                    <h3 class="text-black font-bold py-2 px-4 rounded-lg">
                        讨论：index
                    </h3>
                </div>
                <!-- You can add other sidebar content here -->
            </div>

            <div class="bg-white rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('wall.create') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Create New Wall
                    </a>
                </div>
                <!-- You can add other sidebar content here -->
            </div>

        </div>
    </div>
</div>
@endsection
