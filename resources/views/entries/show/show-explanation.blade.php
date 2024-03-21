@extends('entries.show.entry') {{-- Ensure the correct layout file is used --}}

@section('entry-content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-6">
            @if($demoBranch->getDemoVersion()->isOwnerVisible())
            <div class="p-6 border-b">

            <div class="flex flex-col md:flex-row justify-between mb-6"> <!-- 修改Flex容器，移除items-center -->
                <div class="flex items-center md:mb-2"> <!-- 新增一个Flex容器，用于头像和branchname并排 -->
                    <x-user-name-and-avatar :user-id="$demoBranch->owner->id" class="mr-4" />
                    <a href="{{ route('entry.branch.show.showDemoVersion', $demoBranch->id) }}" class="text-left">/ {{ substr($demoBranch->name, 0, 20) }}</a> <!-- 添加text-left类 -->
                </div>
                <div class="md:hidden text-left"> <!-- 在小屏幕上显示，在大屏幕上隐藏，并左对齐文本 -->
                    <span class="bg-transparent text-purple-500 border border-purple-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Demo Branch</span>
                </div>
                <div class="text-gray-400 text-sm md:text-right dark:text-gray-300">{{$demoBranch->id}}<p class="md:mr-2">{{$demoBranch->getDemoVersion()->created_at->format('M d, Y') }}</p></div> <!-- id放在右侧 -->
            </div>

                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-6">
                    <p class="text-gray-700 dark:text-gray-300">{!! \Illuminate\Support\Str::markdown($demoVersion->content) !!}</p>
                </div>
            </div>
            @else
            <div class="flex flex-col items-center max-w-lg mx-auto text-center">
                <p class="text-sm font-medium text-blue-500 dark:text-blue-400">{{ __('Demo Version 不可用') }}</p>
            </div>
            @endif
            <livewire:entry.entry-explain :entryId="$entryId" />

        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">

            <!-- Demo Branch Information -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-2xl mb-2 dark:text-white">{{ __('访问量') }}</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ __('全部') }}: {{ $Visits }}</p>
            </div>

            <!-- Demo Branch Information -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-2xl mb-2 dark:text-white">{{ __('Demo Branch') }}</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ __('Id') }}: {{ $demoBranch->id }}</p>
            </div>

            <!-- Related Nodes -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-2xl mb-2 dark:text-white">{{ __('Related Nodes') }}</h2>
                <div class="mt-4">
                    @foreach ($nodes as $node)
                        <div class="bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700 mb-4">
                            <a href="{{ route('nodes.show', $node->id) }}" class="text-lg text-blue-500 hover:text-blue-600 font-semibold">{{ $node->name }}</a>
                            <p class="text-gray-600 dark:text-gray-300">{{ $node->status }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
