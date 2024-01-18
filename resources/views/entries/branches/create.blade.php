{{-- resources/views/branch/create.blade.php --}}

@extends('layouts.page')

@section('content')
<div class="container mx-auto mt-5 max-w-5xl">
    <form action="{{ route('entry.branch.store', ['entryId' => $entryId]) }}" method="post" class="flex flex-wrap -mx-4">
    @csrf
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold">{{ __('创建新分支') }}</h2>
                </div>
                <div class="mb-4 border-b">
                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('名称：') }}</label>
                    <input type="text" name="name" id="name" placeholder="Enter name" class="w-full py-2 px-4 bg-gray-100 border-0 focus:outline-none" required>
                </div>
                <div class="mb-4 border-b">
                    <label for="content" class="block text-sm font-medium text-gray-700">{{ __('内容：') }}</label>
                    <textarea name="content" id="content" rows="5" placeholder="Enter content" class="w-full py-2 px-4 bg-gray-100 border-0 focus:outline-none" required></textarea>
                </div>
                <div class="mb-4 border-b">
                    <label for="description" class="block text-sm font-medium text-gray-700">{{ __('描述：') }}</label>
                    <textarea name="description" id="description" rows="3" placeholder="Enter description" class="w-full py-2 px-4 bg-gray-100 border-0 focus:outline-none"></textarea>
                </div>
                <button type="submit" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">{{ __('创建分支') }}</button>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6">
                <div class="mb-4">
                    <label for="version" class="block text-sm font-medium text-gray-700">{{ __('选择基版本：') }}</label>
                    <select name="version_id" id="version" class="w-full py-2 px-4 bg-gray-100 border-0 focus:outline-none rounded-lg">
                        @foreach($versions as $version)
                            <option value="{{ $version->UUID }}">
                                {{ $version->name }} ({{ __('来自') }} {{ $version->branch->name }} {{ __('分支') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="is_pb" class="block text-sm font-medium text-gray-700">{{ __('类型：') }}</label>
                    <select name="is_pb" id="is_pb" class="w-full py-2 px-4 bg-gray-100 border-0 focus:outline-none rounded-lg">
                        <option value="0">{{ __('公共分支 (CB)') }}</option>
                        <option value="1">{{ __('私人分支 (PB)') }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="is_free" class="block text-sm font-medium text-gray-700">{{ __('开放性：') }}</label>
                    <select name="is_free" id="is_free" class="w-full py-2 px-4 bg-gray-100 border-0 focus:outline-none rounded-lg">
                        <option value="1">{{ __('任何人均可参与提交分支') }}</option>
                        <option value="0">{{ __('私有') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
