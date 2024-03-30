@extends('workstation.events')

@section('events_content')
        <!-- Branches Section -->
        <div class="bg-orange-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
            <h3 class="text-2xl font-semibold mb-4">{{ __('Branches') }}</h3>
              @foreach($branches as $branch)
                  <div class="mb-2">
                    <a href="{{ route('entry.branch.show', $branch->id) }}" class="hover:text-orange-500">
                      <span class="font-semibold">{{ $branch->id }}</span> - <span class="text-sm text-gray-500">Updated at: {{ $branch->updated_at->format('M d, Y H:i') }}</span>
                    </a>
                  </div>
              @endforeach
            @if($branches->count() > 5)
                <div class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</div>
            @endif
        </div>
@endsection