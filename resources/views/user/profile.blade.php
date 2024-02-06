@extends('layouts.page') {{-- 使用已有布局 --}}

@section('content')
    <div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-3/4 px-4">
                {{-- 用户主要信息区域 --}}
                <div class="mb-4">


                    {{-- 用户头像和名称 --}}
                    <div class="flex items-center space-x-4 mb-4">
                        <x-user-name-and-avatar :user-id="$user->id" class="w-12 h-12 rounded-full" />
                    </div>

                    {{-- 用户branches列表 --}}
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-xl font-semibold mb-4">Branches</h3>
                        @foreach ($user->branches as $branch)
                            <div class="flex justify-between items-center border-b dark:border-gray-600 py-2">
                                <span>Branch ID: {{ $branch->id }}</span>
                                <span>Created At: {{ $branch->created_at->format('M d, Y') }}</span>
                                <span>{{ $branch->entry?->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
                {{-- 侧边栏区域 --}}
                {{-- 可添加更多的侧边栏内容 --}}
            </div>
        </div>
    </div>
@endsection
