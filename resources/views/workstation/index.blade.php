@extends('layouts.workstation')

@section('title')
{{ __('Workstation') }}
@endsection

@section('content')
<body class="container mx-auto p-4 dark:bg-gray-900 max-w-full min-h-screen">
  <div class="flex-grow flex flex-col lg:flex-row">

    <!-- Middle Column -->
    <div class="w-full lg:w-1/2 px-4 mt-4 lg:mt-0 order-1 lg:order-2">
      <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
        <h3 class="text-xl mb-2">{{ __('欢迎来到workstation！') }}</h3>
        <!-- Replace with your content -->
        <p>看起来没有内容需要检查</p>
      </div>
    </div>

    <!-- Left Column (EntryVersion) -->
    <div class="w-full lg:w-1/4 px-4 py-4 lg:py-0 order-2 lg:order-1">
      <div class="bg-blue-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
        <h3 class="text-xl mb-2">{{ __('Entry Version Tasks') }}</h3>
        @foreach($versionTasks->take(5) as $item)
          <div class="mb-2">
            <span class="font-semibold">{{ $item->name }}</span> - {{ $item->updated_at }}
          </div>
        @endforeach
        @if($versionTasks->count() > 5)
          <div class="text-sm text-gray-600">More...</div>
        @endif
      </div>

      <div class="bg-purple-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
        <h3 class="text-xl mb-2">{{ __('Censor Tasks') }}</h3>
        
      </div>

    </div>

    <!-- Right Column (Branch, Version, Topic, Comment) -->
    <div class="w-full lg:w-1/4 px-4 mt-4 lg:mt-0 order-3 lg:order-3">
        <!-- Branches Section -->
        <div class="bg-orange-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <h3 class="text-xl mb-2">{{ __('Branches') }}</h3>
            @foreach($branches->take(5) as $branch)
                <div class="mb-2">
                    <span class="font-semibold">{{ $branch->id }}</span> - Updated at: {{ $branch->updated_at }}
                </div>
            @endforeach
            @if($branches->count() > 5)
                <div class="text-sm text-gray-600">More...</div>
            @endif
        </div>

        <!-- Versions Section -->
        <div class="bg-yellow-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <h3 class="text-xl mb-2">{{ __('Versions') }}</h3>
            @foreach($versions->take(5) as $version)
                <div class="mb-2">
                    <span class="font-semibold">{{ $version->id }}</span> - Updated at: {{ $version->updated_at }}
                </div>
            @endforeach
            @if($versions->count() > 5)
                <div class="text-sm text-gray-600">More...</div>
            @endif
        </div>

        <!-- Topics Section -->
        <div class="bg-blue-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <h3 class="text-xl mb-2">{{ __('Topics') }}</h3>
            @foreach($topics->take(5) as $topic)
                <div class="mb-2">
                    <span class="font-semibold">{{ $topic->name }}</span> - Updated at: {{ $topic->updated_at }}
                </div>
            @endforeach
            @if($topics->count() > 5)
                <div class="text-sm text-gray-600">More...</div>
            @endif
        </div>

        <!-- Comments Section -->
        <div class="bg-green-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <h3 class="text-xl mb-2">{{ __('Comments') }}</h3>
            @foreach($comments->take(5) as $comment)
            <div class="mb-2">
                <span class="font-semibold">{{ \Illuminate\Support\Str::limit($comment->content, 30) }}</span> - Updated at: {{ $comment->updated_at }}
            </div>
            @endforeach
            @if($comments->count() > 5)
                <div class="text-sm text-gray-600">More...</div>
            @endif
        </div>
    </div>

  </div>

  <script>
    // JavaScript code (if any)
  </script>
</body>
@endsection
