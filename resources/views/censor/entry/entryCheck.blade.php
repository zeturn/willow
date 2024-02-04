@extends('censor.check')

@section('censor_content')
<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- 主内容区 -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-xl font-bold mb-4">{{ $task->entry->name }}</h2>
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
                    <button type="submit" class="px-4 py-2 bg-color-primary-500 hover:bg-color-blue-600 text- rounded-md focus:outline-none focus:ring-2 focus:ring-color-blue-500 focus:ring-opacity-50">
                        提交审核
                    </button>
                </form>
    </div>
</div>
@endsection

@section('censor_sidebar')
    <!-- 审核表单 -->
    <form action="{{ route('censor.tasks.update.entry') }}" method="POST">
        @csrf <!-- CSRF 令牌 -->

        <!-- 加密的任务ID，隐藏字段 -->
        <input type="hidden" name="encryptedId" value="{{ $encryptedId }}">

        <!-- 审核操作选择 -->
        <div x-data="{
            radioGroupSelectedValue: null,
            radioGroupOptions: [
                {
                    title: '同意',
                    description: '没有问题，通过',
                    value: 'approve',
                    color: 'primary'
                },
                {
                    title: '拒绝',
                    description: '打回',
                    value: 'reject',
                    color: 'danger'
                },
                {
                    title: '等待',
                    description: '存入等待区',
                    value: 'wait',
                    color: 'warning'
                }
            ]
        }" class="space-y-3">
        <template x-for="(option, index) in radioGroupOptions" :key="index">
            <label @click="radioGroupSelectedValue=option.value" class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                <input type="radio" name="action" :value="option.value" class="text-gray-900 translate-y-px focus:ring-gray-700" />
                <span class="relative flex flex-col text-left space-y-2 px-5 leading-none">
                    <span x-text="option.title" class="font-semibold"></span>
                    <span x-text="option.description" class="text-sm opacity-50"></span>
                </span>
            </label>
        </template>
        </div>


        <!-- 提交按钮 -->
        <button type="submit" class="mt-5 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
            提交审核
        </button>
    </form>
@endsection
