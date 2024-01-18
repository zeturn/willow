@extends('entries.show.branch.branch')

@section('entry-branch-content')

@livewire('entry.show-branch-version', ['entryId' => $entry->id])

@endsection
