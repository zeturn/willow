{{-- albums/show.blade.php --}}

@extends('layouts.page')

@section('title', $album->title)

@section('content')
<div class="container mx-auto max-w-9xl p-4">
    <div class="flex flex-col md:flex-row md:w-10/12 mx-auto bg-white my-6 rounded-lg">
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
                @forelse ($medias as $media)
                    <img src="{{ '/storage/photos/' .$media['name'] }}" class="absolute top-0 left-0 w-full h-full object-contain hidden" alt="Album Image">
                @empty
                    <div class="bg-white w-full h-full"></div>
                @endforelse

                {{-- Image indicator dots --}}
                <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    @foreach ($medias as $order => $media)
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
                <span class="text-lg ml-2">{{ __('访问量') }}: {{ $Visits }}</span>
                <a href="{{ route('albums.edit', $album->id) }}" class="text-primary-500 hover:text-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </a>
             @livewire('show-entries-in-album', ['albumId' => $album->id])
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
