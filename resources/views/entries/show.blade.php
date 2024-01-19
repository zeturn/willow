@extends('layouts.page')

@section('content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-6">
                <h1 class="text-4xl mb-8 dark:text-white">{{ $entry->name }}</h1>
                <p class="text-gray-700 dark:text-gray-300 text-lg">{{ $demoVersion->content }}</p>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <!-- Entry Information -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-4">
                <h2 class="text-2xl mb-2 dark:text-white">Entry Details</h2>
                <p class="text-gray-700 dark:text-gray-300">Description: {{ $entry->description }}</p>
            </div>

            <!-- Demo Branch Information -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-4">
                <h2 class="text-2xl mb-2 dark:text-white">Demo Branch</h2>
                <p class="text-gray-700 dark:text-gray-300">Id: {{ $demoBranch->id }}</p>
                <p class="text-gray-700 dark:text-gray-300">Description: {{ $demoBranch->description }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-4">
                @livewire('show-albums-in-entry', ['entryId' => $entryId])
            </div>

            <!-- Control buttons -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded mb-4 space-y-2">
            @auth
                <form action="{{ route('entry.delete', $entry->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="block w-full text-center bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </form>
                <a href="{{ route('entry.branch.create', $entry->id) }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">create new branch</a>
                <a href="{{ route('entry.branch.list', ['entryId' => $entryId ]) }}" class="block w-full text-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">查看该版本的词条分支</a>
                <a href="{{ route('entry.branchUser.brancheslist', ['userId' => $userId, 'branchId' => $demoBranch->id, 'entryId' => $entryId ]) }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">查看该用户的词条分支</a>
                <a href="{{ route('entry.editgate', ['id' => $entryId ]) }}" class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">创建更改</a>
            @endauth
            </div>

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            @forelse($walls as $wall)
                <a href="{{ route('wall.show', $wall->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200 mb-4 block dark:text-blue-300">{{ $wall->name }}</a>
            @empty
                <p class="text-gray-600 dark:text-gray-400">无关联的wall</p>
            @endforelse

            <!-- 创建链接的表单 -->
            @auth
            <form action="{{ route('entry.createEWLink', $entry->id) }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-200">Wall Name:</label>
                    <input type="text" id="name" name="name" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-200">Wall Slug:</label>
                    <input type="text" id="slug" name="slug" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-200">Wall Description:</label>
                    <textarea id="description" name="description" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <input type="submit" value="Create Link" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            </form>
            @endauth
        </div>
    </div>
</div>
@endsection
