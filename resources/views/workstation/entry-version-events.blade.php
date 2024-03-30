@extends('workstation.events')

@section('events_content')
<div class="bg-yellow-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
            <h3 class="text-2xl font-semibold mb-4">{{ __('Versions') }}</h3>
            @foreach($versions as $version)
                <div class="mb-2">
                  <a href="{{ route('entry.version.show',$version->id) }}" class="hover:text-yellow-500">
                    <span class="font-semibold">{{ $version->id }}</span> - <span class="text-sm text-gray-500">Updated at: {{ $version->updated_at->format('M d, Y H:i') }}</span>
                  </a>
                </div>
            @endforeach
        </div>
@endsection