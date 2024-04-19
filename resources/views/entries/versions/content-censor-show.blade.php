@extends('layouts.page')

@section('content')
<div class="container mx-auto mt-12 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                    {{ __('Demo Version') }}: {{ $version->name }}
                </h2>

                <div class="border-t border-gray-200 pt-6">
                    <!-- Description -->
                    <div class="bg-gray-50 px-4 py-5 dark:bg-gray-700">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                            {{ __('Description') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                            {{ $version->description }}
                        </dd>
                    </div>
                    <!-- Content -->
                    <div class="bg-white px-4 py-5 dark:bg-gray-800">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                            {{ __('Content') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                            <div class="bg-gray-200 p-4 rounded dark:bg-gray-600">
                                {{ $version->content }}
                            </div>
                        </dd>

                        @if($version->status == 1301111545)
                    <!-- 审核表单 --> 
                    <form action="{{ route('entry.version.handleContentCensor') }}" method="POST">
                        @csrf <!-- CSRF 令牌 -->

                        <!-- 加密的任务ID，隐藏字段 -->
                        <input type="hidden" name="encryptedId" value="{{ $encryptedId }}">

                        <!-- 审核操作选择 -->
                        <div x-data="{
                            radioGroupSelectedValue: null,
                            radioGroupOptions: [
                                {
                                    title: '{{ __('basic.Pass') }}',
                                    description: '{{ __('basic.No problem, pass') }}',
                                    value: 'approve',
                                    color: 'primary'
                                },
                                {
                                    title: '{{ __('basic.Reject') }}',
                                    description: '{{ __('basic.Reject') }}',
                                    value: 'reject',
                                    color: 'danger'
                                },
                                {
                                    title: '{{ __('basic.Wait') }}',
                                    description: '{{ __('basic.Save to waiting area')}}',
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
                    @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">

            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <!-- Author and Created At --> 
                <dl>
                    <div class="mb-4">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Author') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <x-user-name-and-avatar :user-id="$version->author->id" class="w-8 h-8 rounded-full" />
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Created At') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $version->created_at->format('d M, Y') }}
                        </dd>
                    </div>
                </dl>
            </div>



        </div>
    </div>
</div>
@endsection
