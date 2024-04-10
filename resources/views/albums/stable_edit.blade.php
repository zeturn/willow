@extends('layouts.page')

@section('content')
<div class="container">

    @livewire('album.album-editor',['album_id'=>$albumId])

</div>
@endsection
