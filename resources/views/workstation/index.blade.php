@extends('layouts.workstation')

@section('title')
{{ __('Workstation') }}
@endsection

@section('content')
<body class="container mx-auto p-4 dark:bg-gray-900 max-w-full min-h-screen">
  <div class="flex-grow flex flex-col lg:flex-row">

    <!-- Middle Column -->
    <div class="w-full lg:w-1/2 px-4 mt-4 lg:mt-0 order-1 lg:order-2">
      <div class="rounded p-6 dark:bg-gray-800 mb-4 border border-gray-400">
        <h3 class="text-xl font-normal mb-4">{{ __('欢迎来到workstation！') }}</h3>
        <!-- Replace with your content -->
        <p class="text-gray-600 dark:text-gray-300">看起来没有内容需要检查</p>
      </div>
    </div>

    <!-- Left Column (EntryVersion) -->
    <div class="w-full lg:w-1/4 px-4 py-4 lg:py-0 order-2 lg:order-1 border-r border-gray-400 dark:border-gray-700">
      <div class="p-6  dark:bg-gray-800 mb-4">
        <a href="{{ route('workstation.entry_version_task_events')}}" class="text-xl font-normal mb-4">{{ __('Entry Version Tasks') }}</a>
          @foreach($versionTasks->take(5) as $item)
            <div class="mb-2">
              <a href="{{ route('entry.version.editor', $item->id) }}" class="hover:text-blue-500">
                <span class="font-normal">{{ $item->name }}</span> - <span class="text-sm text-gray-500">{{$item->updated_at->format('M d, Y H:i') }}</span>
              </a>
            </div>
          @endforeach
        @if($versionTasks->count() > 5)
          <a href="{{ route('workstation.entry_version_task_events')}}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
        @endif
      </div>

      <div class="rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
        <h3 class="text-xl font-normal mb-4">{{ __('Censor Tasks') }}</h3>
        
      </div>

	          <!-- Branches Section -->
			  <div class="rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <a href="{{ route('workstation.entry_branch_events') }}" class="text-xl font-normal mb-4">{{ __('Branches') }}</a>
              @foreach($branches->take(5) as $branch)
                  <div class="mb-2">
                    <a href="{{ route('entry.branch.show', $branch->id) }}" class="hover:text-orange-500">
                      <span class="font-normal">{{ $branch->name }}</span> - <span class="text-sm text-gray-500">Updated at: {{$branch->updated_at->format('M d, Y H:i') }}</span>
                    </a>
                  </div>
              @endforeach
            @if($branches->count() > 5)
                <a href="{{ route('workstation.entry_branch_events') }}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
            @endif
        </div>

        <!-- Versions Section -->
        <div class="rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <a href="{{ route('workstation.entry_version_events') }}" class="text-xl font-normal mb-4">{{ __('Versions') }}</a>
            @foreach($versions->take(5) as $version)
                <div class="mb-2">
                  <a href="{{ route('entry.version.show',$version->id) }}" class="hover:text-yellow-500">
                    <span class="font-normal">{{ $version->name }}</span> - <span class="text-sm text-gray-500">Updated at: {{$version->updated_at->format('M d, Y H:i') }}</span>
                  </a>
                </div>
            @endforeach
            @if($versions->count() > 5)
                <a href="{{ route('workstation.entry_version_events') }}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
            @endif
        </div>

        <!-- Topics Section -->
        <div class="rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <a href="{{ route('workstation.topic_events')}}" class="text-xl font-normal mb-4">{{ __('Topics') }}</a>
            @foreach($topics->take(5) as $topic)
                <div class="mb-2">
				<a href="{{ route('topic.show', $topic->id) }}" class="hover:text-blue-500">
                    <span class="font-normal">{{ $topic->name }}</span> - <span class="text-sm text-gray-500">Updated at: {{$topic->updated_at->format('M d, Y H:i') }}</span>
                  </a>
                </div>
            @endforeach
            @if($topics->count() > 5)
                <a a href="{{ route('workstation.topic_events')}}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
            @endif
        </div>

        <!-- Comments Section -->
        <div class="rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <a href="{{ route('workstation.comment_events')}}" class="text-xl font-normal mb-4">{{ __('Comments') }}</a>
            @foreach($comments->take(5) as $comment)
            <div class="mb-2">
              <a href="{{ route('comment.show', $comment->id) }}" class="hover:text-green-500">
                <span class="font-normal">{{ \Illuminate\Support\Str::limit($comment->content, 30) }}</span> - <span class="text-sm text-gray-500">Updated at: {{$comment->updated_at->format('M d, Y H:i') }}</span>
              </a>
            </div>
            @endforeach
            @if($comments->count() > 5)
                <a href="{{ route('workstation.comment_events')}}" class="text-sm text-gray-600 hover:text-gray-700 cursor-pointer">More...</a>
            @endif
        </div>

    </div>

    <!-- Right Column (Branch, Version, Topic, Comment) -->
    <div class="w-full lg:w-1/4 px-4 mt-4 lg:mt-0 order-3 lg:order-3">

		<div class="rounded-sm p-4 border border-gray-400 dark:border-gray-700 dark:bg-gray-900 mb-6">
			<a class="text-xl font-normal mb-8">{{ __('New') }}</a>
			<div class="p-4">
			@if (Auth::user()->can('entry-create'))
				<a href="{{ route('entry.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
					创建条目
				</a>
			@endif

			@if (Auth::user()->can('album-create'))
				<a href="{{ route('albums.stableCreate') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
					创建相册
				</a>
			@endif
			</div>
		</div>

	<div class="rounded-sm p-4 border border-gray-400 dark:border-gray-700 dark:bg-gray-900 mb-6">
		<a href="{{ route('trend.entry') }}" class="text-xl font-normal mb-4">{{ __('Trend') }}</a>
		<ul class="space-y-2">
			@foreach ($trend_entries as $entry)
			<li class="flex items-center space-x-2">
				<a href="{{ route('entry.show.explanation', $entry->id) }}" class="text-gray-700 dark:text-gray-400 hover:underline hover:text-blue-600">
					<span class="text-base">{{ $entry->name }}</span>
				</a>
			</li>
			@endforeach
		</ul>
	</div>


  </div>

  <script>
    // JavaScript code (if any)
  </script>
</body>
@endsection