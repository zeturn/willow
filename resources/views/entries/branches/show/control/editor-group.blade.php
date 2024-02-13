{{-- entries/branches/show/control/editor-group.blade.php --}}
@extends('entries.branches.show.control.control')

@section('entry-branch-control-content')

    @livewire('branch.switch-is-free', ['entryBranchId' => $branchId])

    @livewire('branch.editor-list', ['branchId' => $branchId])

@endsection



