{{-- entries/branches/show/control/general-setting.blade.php --}}
@extends('entries.branches.show.control.control')

@section('entry-branch-control-content')
    <h2 class="text-2xl font-semibold dark:text-white">{{__('basic.General')}}{{__('basic.Setting')}}</h2>
    
    @livewire('branch.switch-is-free', ['entryBranchId' => $branchId])

    @livewire('branch.delete-branch', ['branchId' => $branchId])

    {{-- General setting content here --}}
@endsection
