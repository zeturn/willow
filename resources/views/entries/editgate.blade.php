
@extends('layouts.page')

@section('content')

@livewire('branch-edit', ['entryId' => $entryId])

@endsection