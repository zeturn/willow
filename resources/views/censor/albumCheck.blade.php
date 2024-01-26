@extends('censor.check')

@section('censor_content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- 主内容区 -->
        <div class="w-full px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-xl font-bold mb-4">{{ $task->album->title }}</h2>

                <div class="flex flex-col md:flex-row mx-auto bg-white my-6 rounded-lg">
                <div id="image-slider" class="md:w-1/2 rounded-lg relative">
                        {{-- 添加左右切换按钮 --}}
                        <button id="previous-button" aria-label="Previous image" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-30 p-1 rounded-full z-20 backdrop-filter backdrop-blur-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <title>Previous</title>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button id="next-button" aria-label="Next image" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-30 p-1 rounded-full z-20 backdrop-filter backdrop-blur-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <title>Next</title>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>



                        {{-- Fixed-size image container with page number --}}
                        <div class="relative w-full h-64 md:h-96">
                            {{-- Page number display with frosted glass effect --}}
                            <div id="page-number" class="absolute top-0 right-0 bg-gray-300 bg-opacity-30 p-2 rounded-bl-lg z-10 backdrop-filter backdrop-blur-sm">1 / {{ count($album->medias) }}</div>
                            @forelse ($album->medias as $media)
                                <img src="{{ $media->url }}" class="absolute top-0 left-0 w-full h-full object-contain hidden" alt="Album Image">
                            @empty
                                <div class="bg-white w-full h-full"></div>
                            @endforelse

                            {{-- Image indicator dots --}}
                            <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                                @foreach ($album->medias as $index => $media)
                                <span class="dot cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" class="w-3 h-3">
                                        <circle cx="4" cy="4" r="2" class="fill-current opacity-50"/>
                                    </svg>
                                </span>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/2 p-8">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold">{{ $album->title }}</h2>
                        </div>

                        <div class="flex items-center py-4">
                            <a href="{{ route('workstation.index', $album->user->id) }}" class="flex items-center">
                                <img src="{{ $album->user->profile_photo_url }}" alt="{{ $album->user->name }}" class="w-10 h-10 rounded-full">
                                <span class="text-lg ml-2">{{ $album->user->name }}</span>
                            </a>
                        </div>

                        {{-- Other information --}}
                    </div>
                </div>

                <!-- 审核表单 -->
                <form action="{{ route('censor.tasks.update.entry') }}" method="POST" class="space-y-4">
                    @csrf <!-- CSRF 令牌 -->

                    <!-- 加密的任务ID，隐藏字段 -->
                    <input type="hidden" name="encryptedId" value="{{ $encryptedId }}">

                    <!-- 审核操作选择 -->
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="action" value="approve" required class="text-color-primary-500 focus:ring-color-primary-500">
                            <span class="text-gray-700 dark:text-gray-300">同意</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="action" value="reject" class="text-color-danger-500 focus:ring-color-danger-500">
                            <span class="text-gray-700 dark:text-gray-300">拒绝</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="action" value="wait" class="text-color-warning-500 focus:ring-color-warning-500">
                            <span class="text-gray-700 dark:text-gray-300">等待</span>
                        </label>
                    </div>

                    <!-- 提交按钮 -->
                    <button type="submit" class="px-4 py-2 bg-color-primary-500 hover:bg-color-blue-600 text-black rounded-md focus:outline-none focus:ring-2 focus:ring-color-blue-500 focus:ring-opacity-50">
                        提交审核
                    </button>
                </form>
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
<!-- 在这里可以添加更多的侧边栏内容，如果需要 -->
@endsection
