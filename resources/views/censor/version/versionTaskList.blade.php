@extends('censor.list')

@section('censor_list')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        {{-- 主列 --}}
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg overflow-hidden mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Task List</h2>
                    @foreach ($tasks as $task)
                        @if($task->entity_type === 'EntryVersion')
                            <div class="mb-4 border-b pb-4">
                                <a href="{{ route('censor.tasks.version', ['id' => $task->id]) }}" class="text-xl font-bold">
                                    Task ID: {{ $task?->version?->name }}
                                </a>
                                <p class="text-gray-600">Status: {{ $task->status }}</p>
                                {{-- 其他您希望展示的信息 --}}
                                <p class="text-sm text-gray-400 mt-2">Updated at: {{ $task->updated_at->format('d M, Y') }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
  
    </div>
</div>
@endsection
 
@section('censor_sidebar')
<div class="flex flex-col mb-4">
    <!-- Button 1: tasks.list.entry -->
    <a href="{{ route('censor.tasks.list.entry') }}" class="my-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4">
        {{ __('basic.Entry')}} {{ __('basic.List')}}
    </a>

    <!-- Button 2: tasks.list.branch -->
    <a href="{{ route('censor.tasks.list.branch') }}" class="my-4 bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded mt-4">
        {{ __('basic.Branch')}} {{ __('basic.List')}}
    </a>

    <!-- Button 3: tasks.list.version -->
    <a href="{{ route('censor.tasks.list.version') }}" class="my-4 bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded mt-4">
        {{ __('basic.Version')}} {{ __('basic.List')}}
    </a>
</div>

@endsection
