@extends('entries.show.entry') {{-- 使用了正确的布局文件 --}}

@section('entry-content')
<div class="container mx-auto p-4 dark:bg-gray-900">
    <div class="flex flex-wrap -mx-4"> <!-- 用于包含主列和侧边栏的容器 -->
        <div class="w-full lg:w-3/4 px-4"> <!-- 主列 -->
            <!-- 显示条目详情的卡片 -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-2xl mb-6 font-bold text-gray-800 dark:text-white">条目详情</h2>

                <!-- ID 字段 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="id">
                        ID
                    </label>
                    <p class="text-gray-700 dark:text-gray-400 leading-tight">{{ $entry->id }}</p>
                </div>

                <!-- 名称 字段 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="name">
                        名称
                    </label>
                    <p class="text-gray-700 dark:text-gray-400 leading-tight">{{ $entry->name }}</p>
                </div>

                <!-- 演示分支 ID 字段 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="demo_branch">
                        演示分支 ID
                    </label>
                    <p class="text-gray-700 dark:text-gray-400 leading-tight">{{ $entry->demo_branch_id }}</p>
                </div>

                <!-- 状态 字段 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="status">
                        状态
                    </label>
                    <p class="text-gray-700 dark:text-gray-400 leading-tight">{{ $entry->status }}</p>
                </div>

                <!-- 分支数量 字段 -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="branch_count">
                        分支数量
                    </label>
                    <p class="text-gray-700 dark:text-gray-400 leading-tight">{{ $branchesNum }}</p>
                </div>
            </div>
        </div>

        <!-- 侧边栏 -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <!-- 可以在这里添加更多信息或功能的卡片 -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">其他信息</h3>
                <!-- 在这里添加额外的信息或组件 -->
            </div>

            <!-- 另一个卡片，例如相关链接或联系信息 -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">相关链接</h3>
                <!-- 在这里添加链接或其他内容 -->
            </div>
        </div>
    </div>
</div>
@endsection
