@extends('layouts.page')

@section('title')
{{ __('Search') }}
@endsection

@section('content')
<body class="container mx-auto p-4 dark:bg-gray-900 max-w-full min-h-screen">

	<form id="searchForm" action="{{ route('search.result') }}" method="GET">

		<div class="w-full bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4"> <!-- 修改宽度 -->
			<div class="form-group flex justify-center">
				<input type="text" name="query" id="query" class="w-1/2 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background placeholder:text-gray-500 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your search query..." value="{{ $query ?? '' }}">
			</div>
		</div>

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
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="entry">Entry</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="entry_branch">EntryBranch</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="entry_version">EntryVersion</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="wall">Wall</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="topic">Topic</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="comment">Comment</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="media">Media</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="album">Album</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="tree">Tree</button></li>
					<li class="mb-2"><button type="button" class="modelTypeBtn" data-modeltype="node">Node</button></li>
					<li><button type="button" class="modelTypeBtn" data-modeltype="edge">Edge</button></li>
				</ul>
			</div>

			<div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
				<div class="form-group mt-4">
					<label for="dates">Created on the dates:</label>
					<input type="date" name="start_date" id="start_date" class="w-full md:w-48 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400" value="{{ $start_date ?? '' }}">
					<span class="mx-2">to</span>
					<input type="date" name="end_date" id="end_date" class="w-full md:w-48 h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 ring-offset-background focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400" value="{{ $end_date ?? '' }}">
				</div>
			</div>

			<!-- Add a hidden input field to store modelType -->
			<input type="hidden" name="model_type" id="model_type">

		</div>

		<!-- Right Column () -->
		<div class="w-full lg:w-1/4 px-4 mt-4 lg:mt-0 order-3 lg:order-3">
			@yield('content-bar')
		</div>

	</div>

	</form>

  <script>
    // JavaScript code (if any)
	document.getElementById("query").addEventListener("keypress", function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("model_type").value = "{{ $modelType}}";
			document.getElementById("searchForm").submit();
		}
	});

	document.querySelectorAll(".modelTypeBtn").forEach(item => {
		item.addEventListener("click", function() {
			modelType = this.getAttribute("data-modeltype");
			document.getElementById("model_type").value = modelType;
			document.getElementById("searchForm").submit();
		});
	});
  </script>
</body>
@endsection
