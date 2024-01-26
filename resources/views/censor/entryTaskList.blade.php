@extends('censor.list')

@section('censor_list')

@foreach ($tasks as $task)
    @if($task->entity_type === 'Entry')
        <li class="list-group-item">
            Task ID: {{ $task->id }} - Status: {{ $task->status }}
            {{-- 其他您希望展示的信息 --}}
        </li>
    @endif
@endforeach

@endsection

@section('censor_sidebar')
111111
@endsection
