@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl mt-10">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Column -->
        <div class="w-full lg:w-3/4 px-4">
            <!-- Versions -->
            @if($demoVersion)
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <a href="{{ route('entry.version.show', $demoVersion->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200">{{ $demoVersion->name }}</a>
                    <div class="mb-4">
                        <span class="text-lg font-medium text-gray-600">Name:</span>
                        <span class="text-lg">{{ $demoVersion->name }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-lg font-medium text-gray-600">Description:</span>
                        <span class="text-lg">{{ $demoVersion->description }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-lg font-medium text-gray-600">Content:</span>
                        <span class="text-lg">{{ $demoVersion->content }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-lg font-medium text-gray-600">Author:</span>
                        <span class="text-lg">{{ $demoVersion->author->name }}</span>
                    </div>
                </div>
            @else
                <p class="text-gray-600">没有找到对应的 Demo Version</p>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <!-- Entry Branch Card -->
            <div class="sticky top-10 bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-3xl font-semibold mb-6 text-gray-700">Entry Branch: <span class="text-blue-600">{{ $branch->UUID }}</span></h2>
                <!-- Branch Details -->
                @foreach(['Entry ID' => $branch->entry_id, 'Demo Version ID' => $branch->demo_version_id, 'Is PB' => $branch->is_pb ? 'Yes' : 'No', 'Is Free' => $branch->is_free ? 'Yes' : 'No', 'Status' => $branch->status] as $label => $value)
                    <div class="mb-6 flex items-center space-x-4">
                        <span class="text-lg font-medium text-gray-600">{{ $label }}:</span>
                        <span class="text-lg">{{ $value }}</span>
                    </div>
                @endforeach

                <!-- Wall Links -->
                @forelse($walls as $wall)
                    <a href="{{ route('wall.show', $wall->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200 mb-4 block">{{ $wall->name }}</a>
                @empty
                    <p class="text-gray-600">无关联的wall</p>
                @endforelse

                <form action="{{ route('entry.branch.createEWLink', $branch->id) }}" method="POST" class="mt-6">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Wall Name:</label>
                        <input type="text" id="name" name="name" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Wall Slug:</label>
                        <input type="text" id="slug" name="slug" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Wall Description:</label>
                        <textarea id="description" name="description" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <input type="submit" value="Create Link" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                </form>

                <a href="{{ route('entry.branch.list', ['entryId' => $branch->entry_id ]) }}" class="text-blue-600 hover:underline mt-4 block"> < Back to Branch List</a>
            </div>
        </div>
    </div>
</div>
@endsection
