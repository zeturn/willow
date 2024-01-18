{{-- layouts/page.blade.php 中的内容 --}}

@extends('layouts.page')

@section('title')
Albums
@endsection

@section('content')
<div class="container mx-auto max-w-7xl p-4">
    <form action="{{ route('albums.store') }}" method="post" id="createAlbumForm" enctype="multipart/form-data">
        @csrf
        {{-- Album Title Input --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="title">Album Title</label>
            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" type="text" name="title" id="title" placeholder="Enter album title" required>
        </div>

        {{-- Image Upload --}}
        <div class="mb-4">
            <label for="photos" class="block text-gray-700 font-bold mb-2">Photos:</label>
            <input type="file" name="photos[]" id="photos" multiple required class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100">
        </div>
        <div id="preview-container" class="flex flex-wrap -mx-2"></div>

        <div class="flex items-center justify-start mt-4">
            <button type="submit" class="px-6 py-2 text-sm font-semibold rounded-md bg-blue-500 text-white">
                Create Album
            </button>
        </div>
    </form>
</div>


<script>
    // 预览上传的图片
    function previewPhotos(event) {
        const container = document.getElementById('preview-container');
        container.innerHTML = '';

        const files = event.target.files;
        const fileList = Array.from(files); // 将文件列表转换为数组

        fileList.forEach((file) => {
            const reader = new FileReader();

            reader.onload = (function (currentFile) {
                return function (e) {
                    const preview = document.createElement('div');
                    preview.classList.add('photo-preview', 'w-32', 'h-32', 'm-2', 'relative', 'overflow-hidden');

                    const image = document.createElement('img');
                    image.src = e.target.result;
                    image.alt = 'Image Preview';
                    image.classList.add('w-full', 'h-full', 'object-cover');

                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '删除';
                    removeBtn.classList.add('remove-photo', 'absolute', 'bottom-0', 'right-0', 'bg-red-500', 'text-white', 'px-2', 'py-1', 'text-sm', 'rounded');
                    removeBtn.addEventListener('click', function () {
                        preview.remove();
                        const index = fileList.indexOf(currentFile);
                        if (index !== -1) {
                            fileList.splice(index, 1); // 从文件列表中移除被删除的文件
                            updateFileInput();
                        }
                    });

                    preview.appendChild(image);
                    preview.appendChild(removeBtn);
                    container.appendChild(preview);
                };
            })(file);

            reader.readAsDataURL(file);
        });

        // 更新文件输入框的文件列表
        function updateFileInput() {
            const updatedFiles = new DataTransfer();
            fileList.forEach(function (file) {
                updatedFiles.items.add(file);
            });
            photoInput.files = updatedFiles.files;
        }
    }

    const photoInput = document.getElementById('photos');
    photoInput.addEventListener('change', previewPhotos);

    // 获取富文本编辑器的内容并设置到隐藏的content字段中
    const editor = new EditorJS({
        holder: 'editor',
        onChange: (api) => {
            api.saver.save().then((outputData) => {
                const contentInput = document.getElementById('content');
                contentInput.value = JSON.stringify(outputData);
            });
        },
        // 配置其他参数
    });

    // 在表单提交时，销毁编辑器实例
    const createPostForm = document.getElementById('createPostForm');
    createPostForm.addEventListener('submit', () => {
        editor.destroy();
    });
</script>
@endsection
