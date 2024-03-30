@extends('layouts.workstation')

@section('title')
{{ __('Workstation') }}
@endsection

@section('content')
<body class="container mx-auto p-4 dark:bg-gray-900 max-w-full min-h-screen">
  <div class="flex-grow flex flex-col lg:flex-row">

    <!-- Middle Column -->
    <div class="w-full lg:w-1/2 px-4 mt-4 lg:mt-0 order-1 lg:order-2">
      <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
        <h3 class="text-2xl font-semibold mb-4">{{ __('欢迎来到workstation！') }}</h3>
        <!-- Replace with your content -->
        <p class="text-gray-600 dark:text-gray-300">看起来没有内容需要检查</p>
      </div>
    </div>

    <!-- Left Column (EntryVersion) -->
    <div class="w-full lg:w-1/4 px-4 py-4 lg:py-0 order-2 lg:order-1">
      <div class="bg-blue-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
        <a href="{{ route('workstation.entry_version_task_events')}}" class="text-2xl font-semibold mb-4">{{ __('Entry Version Tasks') }}</a>
          @foreach($versionTasks->take(5) as $item)
            <div class="mb-2">
              <a href="{{ route('entry.version.editor', $item->id) }}" class="hover:text-blue-500">
                <span class="font-semibold">{{ $item->name }}</span> - <span class="text-sm text-gray-500">{{ $item->updated_at->format('M d, Y H:i') }}</span>
              </a>
            </div>
          @endforeach
        @if($versionTasks->count() > 5)
          <a href="{{ route('workstation.entry_version_task_events')}}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
        @endif
      </div>

      <div class="bg-purple-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
        <h3 class="text-2xl font-semibold mb-4">{{ __('Censor Tasks') }}</h3>
        
      </div>

    </div>

    <!-- Right Column (Branch, Version, Topic, Comment) -->
    <div class="w-full lg:w-1/4 px-4 mt-4 lg:mt-0 order-3 lg:order-3">
        <!-- Branches Section -->
        <div class="bg-orange-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
            <a href="{{ route('workstation.entry_branch_events') }}" class="text-2xl font-semibold mb-4">{{ __('Branches') }}</a>
              @foreach($branches->take(5) as $branch)
                  <div class="mb-2">
                    <a href="{{ route('entry.branch.show', $branch->id) }}" class="hover:text-orange-500">
                      <span class="font-semibold">{{ $branch->id }}</span> - <span class="text-sm text-gray-500">Updated at: {{ $branch->updated_at->format('M d, Y H:i') }}</span>
                    </a>
                  </div>
              @endforeach
            @if($branches->count() > 5)
                <a href="{{ route('workstation.entry_branch_events') }}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
            @endif
        </div>

        <!-- Versions Section -->
        <div class="bg-yellow-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
            <a href="{{ route('workstation.entry_version_events') }}" class="text-2xl font-semibold mb-4">{{ __('Versions') }}</a>
            @foreach($versions->take(5) as $version)
                <div class="mb-2">
                  <a href="{{ route('entry.version.show',$version->id) }}" class="hover:text-yellow-500">
                    <span class="font-semibold">{{ $version->id }}</span> - <span class="text-sm text-gray-500">Updated at: {{ $version->updated_at->format('M d, Y H:i') }}</span>
                  </a>
                </div>
            @endforeach
            @if($versions->count() > 5)
                <a href="{{ route('workstation.entry_version_events') }}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
            @endif
        </div>

        <!-- Topics Section -->
        <div class="bg-blue-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
            <a href="{{ route('workstation.topic_events')}}" class="text-2xl font-semibold mb-4">{{ __('Topics') }}</a>
            @foreach($topics->take(5) as $topic)
                <div class="mb-2">
                  <a href="{{ route('topic.show', $topic->id) }}" class="hover:text-blue-500">
                    <span class="font-semibold">{{ $topic->name }}</span> - <span class="text-sm text-gray-500">Updated at: {{ $topic->updated_at->format('M d, Y H:i') }}</span>
                  </a>
                </div>
            @endforeach
            @if($topics->count() > 5)
                <a a href="{{ route('workstation.topic_events')}}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
            @endif
        </div>

        <!-- Comments Section -->
        <div class="bg-green-100 rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 shadow">
            <a href="{{ route('workstation.comment_events')}}" class="text-2xl font-semibold mb-4">{{ __('Comments') }}</a>
            @foreach($comments->take(5) as $comment)
            <div class="mb-2">
              <a href="{{ route('comment.show', $comment->id) }}" class="hover:text-green-500">
                <span class="font-semibold">{{ \Illuminate\Support\Str::limit($comment->content, 30) }}</span> - <span class="text-sm text-gray-500">Updated at: {{ $comment->updated_at->format('M d, Y H:i') }}</span>
              </a>
            </div>
            @endforeach
            @if($comments->count() > 5)
                <a href="{{ route('workstation.comment_events')}}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
            @endif
        </div>
    </div>

  </div>

  <script>
    // JavaScript code (if any)
  </script>
</body>
@endsection
