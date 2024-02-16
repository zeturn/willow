{{-- entries/branches/show/control/editor-group.blade.php --}}
@extends('entries.branches.show.control.control')

@section('entry-branch-control-content')

    @livewire('branch.editors-list', ['branchId' => $branchId])

    @livewire('branch.teams-list', ['branchId' => $branchId])

@endsection



