<!-- initialization/index.blade.php -->

@extends('layouts.page')

@section('title')
初始化及注册
@endsection

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="w-1/3 p-6 bg-white rounded shadow">
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('initialization.run') }}" class="space-y-4">
                @csrf

                <h1 class="text-3xl font-bold mb-4 text-indigo-500">墙初始化控制器</h1>
                <h1 class="text-1xl font-bold mb-4 text-red-500">没事别碰，能干爆数据库，还能抹磁盘</h1>
                <label for="password" class="block font-semibold">请输入密钥：</label>
                <input type="password" id="password" name="password" class="w-full border-gray-300 rounded focus:border-indigo-500 focus:ring-indigo-500">

                <button type="submit" class="bg-indigo-700 text-white font-semibold px-4 py-2 rounded mt-4 hover:bg-indigo-600">运行初始化</button>
            </form>
        </div>

        <div class="w-1/3 p-6 bg-white rounded shadow">
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('ArtificialData.run') }}" class="space-y-4">
                @csrf

                <h1 class="text-3xl font-bold mb-4 text-green-500">模拟数据控制器</h1>
                <h1 class="text-1xl font-bold mb-4 text-red-500">开发专用</h1>
                <label for="password" class="block font-semibold">请输入密钥：</label>
                <input type="password" id="password" name="password" class="w-full border-gray-300 rounded focus:border-green-500 focus:ring-green-500">

                <button type="submit" class="bg-green-700 text-white font-semibold px-4 py-2 rounded mt-4 hover:bg-green-600">运行初始化</button>
            </form>
        </div>

    </div>
@endsection
