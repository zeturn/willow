@extends('workstation.events')

@section('events_content')
<div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
    @foreach($versions as $version)
        <div class="flex flex-col items-start p-4 mb-6 rounded-lg shadow-sm dark:shadow-none">
            <div class="flex justify-between w-full">
                <a href="{{ route('entry.version.show', $version->id) }}" class="text-xl hover:text-orange-600 dark:hover:text-orange-400">
                    <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $version->name }}</span>
                </a>
                <span class="text-lg text-gray-600 dark:text-gray-300">{{ $version->id }}</span>
            </div>
            <span class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $version->updated_at->format('M d, Y H:i') }}</span>
            <p class="text-gray-800 dark:text-gray-200 mt-4">{!! \Illuminate\Support\Str::limit($version->content, 100) !!}</p>
        </div>
    @endforeach
    <!-- Pagination -->
    <div class="mt-4">
        {{$versions->links() }}
    </div>
</div>

@endsection