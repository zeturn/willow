@extends('layouts.page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">创建相册</div>

                <div class="card-body">
                    @livewire('album.album-creator')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
