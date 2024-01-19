@extends('layouts.workstation')

@section('title')
{{ __('Workstation') }}
@endsection

@section('content')
<body class="container mx-auto p-4 dark:bg-gray-900 max-w-full min-h-screen flex flex-col">
  <div class="flex-grow flex flex-col lg:flex-row flex-wrap h-screen">

    <!-- 最左侧列 Left Column -->
    <div class="w-full lg:w-1/4 px-4 min-h-full py-4 overflow-auto">
      @for ($i = 0; $i < 3; $i++)
      <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
        Left Column Card Content {{ $i + 1 }}
      </div>
      @endfor
    </div>

    <!-- 中间列 Middle Column -->
    <div class="w-full lg:w-1/2 px-4 min-h-full py-4 overflow-auto">
      @for ($i = 0; $i < 3; $i++)
      <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
        Middle Column Card Content {{ $i + 1 }}
      </div>
      @endfor
    </div>

    <!-- 最右侧列 Right Column -->
    <div class="w-full lg:w-1/4 px-4 min-h-full py-4 overflow-auto">
      @for ($i = 0; $i < 3; $i++)
      <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
        Right Column Card Content {{ $i + 1 }}
        <livewire:counter/>
      </div>
      @endfor
    </div>
  </div>

  <script>
    // JavaScript code (if any)
  </script>
</body>
@endsection
