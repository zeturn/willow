@extends('layouts.page')

@section('title')
{{ __('Search') }}
@endsection

@section('content')
<body class="container mx-auto p-4 dark:bg-gray-900 max-w-full min-h-screen">
  <div class="flex-grow flex flex-col lg:flex-row">

    <!-- Middle Column (Result) -->
    <div class="w-full lg:w-1/2 px-4 mt-4 lg:mt-0 order-1 lg:order-2">
      <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
        @yield('result-list')

      </div>
    </div>

    <!-- Left Column (select model) -->
    <div class="w-full lg:w-1/4 px-4 py-4 lg:py-0 order-2 lg:order-1">

        <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <ul>
                <li class="mb-2 @if($modelType === 'entry') font-bold @endif">Entry</li>
                <li class="mb-2 @if($modelType === 'entry_branch') font-bold @endif">EntryBranch</li>
                <li class="mb-2 @if($modelType === 'entry_version') font-bold @endif">EntryVersion</li>
                <li class="mb-2 @if($modelType === 'entry_version_task') font-bold @endif">EntryVersionTask</li>
                <li class="mb-2 @if($modelType === 'wall') font-bold @endif">Wall</li>
                <li class="mb-2 @if($modelType === 'topic') font-bold @endif">Topic</li>
                <li class="mb-2 @if($modelType === 'comment') font-bold @endif">Comment</li>
                <li class="mb-2 @if($modelType === 'version') font-bold @endif">Version</li>
                <li class="mb-2 @if($modelType === 'media') font-bold @endif">Media</li>
                <li class="mb-2 @if($modelType === 'album') font-bold @endif">Album</li>
                <li class="mb-2 @if($modelType === 'tree') font-bold @endif">Tree</li>
                <li class="@if($modelType === 'node') font-bold @endif">Node</li>
                <li class="@if($modelType === 'edge') font-bold @endif">Edge</li>
            </ul>
        </div>

        @yield('filter')
        
    </div>

    <!-- Right Column () -->
    <div class="w-full lg:w-1/4 px-4 mt-4 lg:mt-0 order-3 lg:order-3">
        @yield('content-bar')
    </div>

  </div>

  <script>
    // JavaScript code (if any)
  </script>
</body>
@endsection
