{{-- entries/branches/show/show-info.blade.php --}}
@extends('entries.branches.show.branch')

@section('action-button')
    {{-- Custom action button specific to Info view --}}
    {{-- 可以在这里添加针对信息视图的特定操作按钮 --}}
@endsection

@section('entry-content')
<div class="container mx-auto p-4 dark:bg-gray-900">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-3/4 px-4">
            <!-- 分支信息卡片 -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-2xl mb-6 font-bold text-gray-800 dark:text-white">分支信息</h2>

                <!-- 分支名称 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="branch_name">
                        分支ID
                    </label>
                    <p class="text-gray-700 dark:text-gray-400 leading-tight">{{ $branch->id }}</p>
                </div>

                <!-- 演示版本 ID -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="demo_version">
                        演示版本 ID
                    </label>
                    <p class="text-gray-700 dark:text-gray-400 leading-tight">{{ $branch->demo_version_id }}</p>
                </div>

                <!-- 版本数量 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="version_count">
                        版本数量
                    </label>
                    <p class="text-gray-700 dark:text-gray-400 leading-tight">{{ $branch->versions->count() }}</p>
                </div>
            </div>
        </div>

        <!-- 侧边栏 -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <!-- 其他信息卡片 -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white

 mb-4">其他信息</h3>
                <!-- 在这里添加额外的信息或组件 -->
            </div>

            <!-- 相关链接卡片 -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">相关链接</h3>
                <!-- 在这里添加链接或其他内容 -->
            </div>
        </div>
    </div>
</div>
@endsection
