@extends('censor.check')

@section('censor_content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- 主内容区 -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-xl font-bold mb-4">{{ $task->Topic->name }}</h2>

                <!-- 审核表单 -->
                <form action="{{ route('censor.tasks.update.topic') }}" method="POST" class="space-y-4">
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
                    <button type="submit" class="px-4 py-2 bg-color-primary-500 hover:bg-color-blue-600 text- rounded-md focus:outline-none focus:ring-2 focus:ring-color-blue-500 focus:ring-opacity-50">
                        提交审核
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('censor_sidebar')
<!-- 在这里可以添加更多的侧边栏内容，如果需要 -->
@endsection
