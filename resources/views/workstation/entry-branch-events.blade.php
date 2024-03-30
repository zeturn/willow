@extends('workstation.events')

@section('events_content')
<!-- Branches Section -->
<div class="p-8 bg-white rounded-md dark:bg-gray-900 dark:border-gray-700 mb-6">
    @foreach($branches as $branch)
        <div class="flex flex-col items-start p-4 mb-6 rounded-lg shadow-sm dark:shadow-none">
            <div class="flex justify-between w-full">
                <a href="{{ route('entry.branch.show', $branch->id) }}" class="text-xl hover:text-orange-600 dark:hover:text-orange-400">
                    <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $branch->name }}</span>
                </a>
                <span class="text-lg text-gray-600 dark:text-gray-300">{{ $branch->id }}</span>
            </div>
            <span class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $branch->updated_at->format('M d, Y H:i') }}</span>
            <p class="text-gray-800 dark:text-gray-200 mt-4">{!! \Illuminate\Support\Str::limit($branch->getdemoversion()->content, 100) !!}</p>
        </div>
    @endforeach
    <!-- Pagination -->
    <div class="mt-4">
      {{ $branches->links() }}
    </div>
    @if($branches->count() > 5)
        <div class="text-lg text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 cursor-pointer">More...</div>
    @endif
</div>

@endsection