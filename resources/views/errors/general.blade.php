{{-- resources/views/errors/general.blade.php --}}

@extends('layouts.page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Error') }}</div>

                <div class="card-body">
                    @if(isset($message))
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            {{ __('An unknown error occurred.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
