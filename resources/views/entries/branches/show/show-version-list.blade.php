{{-- entries/branches/show/show-version-list.blade.php --}}
@extends('entries.branches.show.branch')

@section('action-button')
    {{-- Custom action button can be added here if needed --}}
@endsection

@section('entry-content')
    {{-- Content specific to Version List --}}
    <div class="space-y-4">
        @livewire('branch.version-edit-portal', ['branchId' => $branch->id])
    </div>
    {{-- Additional content can be added here --}}
@endsection
