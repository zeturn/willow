@extends('censor.list')

@section('censor_list')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        {{-- 主列 --}}
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg overflow-hidden mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Task List</h2>
                    @foreach ($tasks as $task)
                        @if($task->entity_type === 'Album')
                            <div class="mb-4 border-b pb-4">
                                <a href="{{ route('censor.tasks.album', ['id' => $task->id]) }}" class="text-xl font-bold">
                                    Task ID: {{ $task->id }}
                                </a>
                                <p class="text-gray-600">Status: {{ $task->status }}</p>
                                {{-- 其他您希望展示的信息 --}}
                                <p class="text-sm text-gray-400 mt-2">Updated at: {{ $task->updated_at->format('d M, Y') }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
 
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('#image-slider img');
        let currentImageIndex = 0;
        const dots = document.querySelectorAll('.dot');
        const pageNumberElement = document.getElementById('page-number');
        const nextButton = document.getElementById('next-button');
        const previousButton = document.getElementById('previous-button');

        // 更新页码和指示器
        function updatePageNumberAndIndicators() {
            pageNumberElement.textContent = (currentImageIndex + 1) + ' / ' + images.length;
            dots.forEach(dot => dot.querySelector('circle').classList.replace('opacity-100', 'opacity-50'));
            dots[currentImageIndex].querySelector('circle').classList.replace('opacity-50', 'opacity-100');
        }

        // 显示指定索引的图片
        function showImage(index) {
            images[currentImageIndex].classList.add('hidden');
            currentImageIndex = index;
            images[currentImageIndex].classList.remove('hidden');
            updatePageNumberAndIndicators();
        }

        // 显示下一张图片
        function showNextImage() {
            let nextIndex = (currentImageIndex + 1) % images.length;
            showImage(nextIndex);
        }

        // 显示上一张图片
        function showPreviousImage() {
            let prevIndex = (currentImageIndex - 1 + images.length) % images.length;
            showImage(prevIndex);
        }

        nextButton.addEventListener('click', showNextImage);
        previousButton.addEventListener('click', showPreviousImage);

        // 绑定键盘左右箭头事件
        document.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowRight') {
                showNextImage();
            } else if (event.key === 'ArrowLeft') {
                showPreviousImage();
            }
        });

        // 绑定点点击事件
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => showImage(index));
        });

        // 初始化显示第一张图片
        images[currentImageIndex].classList.remove('hidden');
        updatePageNumberAndIndicators(); // 初始化页码和指示器
    });
</script>

@endsection
 
@section('censor_sidebar')
{{-- 这里可以添加更多的侧边栏内容，如果需要 --}}
@endsection

