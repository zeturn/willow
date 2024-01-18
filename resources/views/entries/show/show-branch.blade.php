@extends('entries.show.entry')

@section('entry-content')
<div class="container mx-auto p-4 max-w-7xl">

@livewire('entry.show-branch-version', ['entryId' => $entry->id])


        <div class="flex flex-wrap -mx-4">
            <!-- Left Column for Entry Information -->
            <div class="w-full lg:w-1/2 px-4">
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <h2 class="text-xl font-bold mb-4">Entry Information</h2>
                        <p><strong>ID:</strong> {{ $entry->id }}</p>
                        <p><strong>Name:</strong> {{ $entry->name }}</p>
                        <p><strong>Created At:</strong> {{ $entry->created_at->toFormattedDateString() }}</p>
                    </div>
            </div>

            <!-- Right Column for Branch List -->
            <div class="w-full lg:w-1/2 px-4">
                <h2 class="text-xl font-bold mb-4">Entry Branches</h2>
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <ul>
                        @forelse($branches as $branch)
                            <li class="hover:bg-gray-50">
                                <a href="{{ route('entry.branch.show', $branch->id) }}" class="block">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                {{ $branch->id }}
                                            </p>
                                        </div>
                                        <div class="mt-2 sm:flex sm:justify-between">
                                            <div class="sm:flex">
                                                <p class="flex items-center text-sm text-gray-500">
                                                    {{ $branch->status }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="px-4 py-4 sm:px-6">
                                <p class="text-sm text-gray-500">
                                    No branches found.
                                </p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
