@extends('layouts.page')

@section('content')
<div class="container">
    <h1>编辑媒体</h1>
    <form action="{{ route('medias.update', $media->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" id="description" name="description" required>{{ $media->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
