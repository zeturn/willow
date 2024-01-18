@extends('entries.show.branch.branch')

@section('entry-branch-content')

@livewire('entry.edit-portal', ['entryId' => $entry->id])

@endsection
