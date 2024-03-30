@extends('workstation.events')

@section('events_content')
<div class="bg-blue-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
        <h3 class="text-2xl font-semibold mb-4">{{ __('Entry Version Tasks') }}</h3>
          @foreach($versionTasks as $item)

            <div class="mb-2">
              <a href="{{ route('entry.version.editor', $item->id) }}" class="hover:text-blue-500">
                <span class="font-semibold">{{ $item->name }}</span> - <span class="text-sm text-gray-500">{{ $item->updated_at->format('M d, Y H:i') }}</span>
              </a>
            </div>
          @endforeach
        <!-- Pagination -->
        <div class="mt-4">
      {{ $versionTasks->links() }}
    </div>
      </div>
@endsection