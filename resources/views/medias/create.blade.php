@extends('layouts.page')

@section('content')
<div class="container mx-auto p-6">
    <form action="{{ route('medias.store') }}" class="dropzone border-dashed border-2 border-gray-300 rounded-md" id="my-awesome-dropzone">
        @csrf
        <div class="flex justify-center items-center h-32">
            <p class="text-gray-400">{{__('basic.File size should not exceed 8MB')}}</p>
        </div>
    </form>
    <x-button id="uploadButton" class="mt-3">{{__('basic.Upload')}}</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script>
    Dropzone.autoDiscover = false; // 防止自动实例化

    var myDropzone = new Dropzone("#my-awesome-dropzone", {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 8, // MB
        acceptedFiles: 'image/*',
        autoProcessQueue: false, // 防止文件被自动上传
        dictDefaultMessage: "<span class='text-gray-400'>将文件拖放到此处或点击上传</span>",
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
