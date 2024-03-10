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
                        @if($task->entity_type === 'Wall')
                            <div class="mb-4 border-b pb-4">
                                <a href="{{ route('censor.tasks.wall', ['id' => $task->id]) }}" class="text-xl font-bold">
                                    Task ID: {{ $task->id }}
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
    <!-- Button 1: 'censor.tasks.list.wall' -->
    <a href="{{ route('censor.tasks.list.wall') }}" class="my-4 bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded mt-4">
        Wall列表
    </a>

    <!-- Button 2: 'censor.tasks.list.topic' -->
    <a href="{{ route('censor.tasks.list.topic') }}" class="my-4 bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded mt-4">
        Topic列表
    </a>

    <!-- Button 3: 'censor.tasks.list.comment' -->
    <a href="{{ route('censor.tasks.list.comment') }}" class="my-4 bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded mt-4">
        Comment列表
    </a>
</div>
@endsection
