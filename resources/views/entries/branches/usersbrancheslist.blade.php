@extends('layouts.page')

@section('content')
<div class="container mx-auto mt-10 px-4 flex flex-wrap">
    <!-- 用户信息卡片 & entry信息卡片 -->
    <div class="w-full md:w-1/2 px-4">
        <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <!-- 用户信息 -->
            <div class="mb-6">
                <h2 class="text-3xl font-semibold mb-6 text-gray-700">用户信息</h2>
                <p><strong>姓名：</strong> {{ $user->name }}</p>
                <p><strong>ID：</strong> {{ $user->id }}</p>
            </div>

            <!-- entry信息 -->
            <div class="mb-6">
                <h2 class="text-3xl font-semibold mb-6 text-gray-700">Entry信息</h2>
                <p><strong>Entry ID：</strong> {{ $entry->id }}</p>
                <p><strong>Entry 名称：</strong> {{ $entry->name }}</p>
            </div>
        </div>
    </div>

    <!-- 用户所拥有的分支 -->
    <div class="w-full md:w-1/2 px-4">
        @foreach($userBranches as $branchUser)
        <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
            <h2 class="text-3xl font-semibold mb-6 text-gray-700">{{ $branchUser->id }}</h2>
            <p>Role: {{ $branchUser->getUserRoleByUuid($userID) }}</p>
            <a href="{{ route('entry.branch.show', $branchUser->id) }}" class="text-blue-600 hover:underline mt-4">查看分支详情</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
