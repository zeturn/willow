@extends('layouts.workstation')

@section('title')
工作站
@endsection

@section('content')
<body class="container min-h-screen flex flex-col">
  <div class="flex-grow flex flex-col sm:flex-row items-stretch h-screen">

    <!-- 最左侧列 -->
    <div class="flex flex-grow w-full sm:w-3/12 bg-gray-300 min-h-full">
      Left Column Content
    </div>

    <!-- 中间列 -->
    <div class="flex flex-grow w-full sm:w-6/12 bg-gray-400 min-h-full">
      Middle Column Content
    </div>

    <!-- 最右侧列 -->
    <div class="flex flex-grow w-full sm:w-3/12 bg-gray-500 min-h-full">
      Right Column Content
      <livewire:counter/>
    </div>
  </div>


  <script>
    // 你的JavaScript代码（如果有的话）
  </script>
</body>
@endsection
