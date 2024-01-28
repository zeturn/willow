{{-- resources/views/errors/view.blade.php --}}

@extends('layouts.page')

@section('title', 'Error')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Error / 错误</div>

                    <div class="card-body">
                        @if(isset($exception))
                            <div class="alert alert-danger" role="alert">
                                {{ $exception->getMessage() }} / {{ $exception->getMessage() }}
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                An unknown error occurred. / 发生了未知错误。
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
