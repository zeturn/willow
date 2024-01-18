@extends('layouts.page')

@section('content')
<div class="container mx-auto p-5">


@livewire('entry-version-editor', ['eveid' => $eveId])


</div>
@endsection
