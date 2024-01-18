@extends('layouts.page')

@section('content')
<div class="container">
    <form action="{{ route('medias.store') }}" class="dropzone" id="my-awesome-dropzone">
        @csrf
    </form>
    <button id="uploadButton" class="btn btn-primary mt-3">上传文件</button>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script>
    Dropzone.autoDiscover = false; // 防止自动实例化

    var myDropzone = new Dropzone("#my-awesome-dropzone", {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        acceptedFiles: 'image/*',
        autoProcessQueue: false, // 防止文件被自动上传
    });

    document.getElementById('uploadButton').addEventListener("click", function() {
        // 触发文件上传
        myDropzone.processQueue();
    });

    myDropzone.on("addedfile", function(file) {
        // 文件添加后自动上传
        myDropzone.processQueue();
    });
</script>

@endsection
