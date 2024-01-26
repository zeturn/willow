@extends('censor.check')

@section('censor_content')

{{  $task->entry->content }}
@endsection

@yield('censor_sidebar')

@endsection
