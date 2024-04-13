<div class="container mx-auto p-4">
    @if(auth()->check())
        <!-- 返回按钮 -->
        @if($step > 1)
            <button wire:click="goBack" class="bg-gray-300 text-black px-4 py-2 rounded mb-4">{{__('basic.Return')}}</button>
        @endif

        <div class="max-w-2xl mx-auto bg-white shadow rounded p-6">
            <!-- 初始操作选择 -->
            @if($step == 1)
                <div class="text-center mb-6 space-y-3">
                    <h2 class="text-xl font-semibold mb-4">{{__('basic.Choose what you want to do')}}</h2>
                    <label wire:click="chooseBranchAndVersion(false)" class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                        <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                            <span class="font-semibold">{{__('basic.Submit a new version to an existing branch')}}</span>
                            <span class="text-sm opacity-50">{{__('basic.Create a new version and commit')}}</span>
                        </span>
                    </label>
                    <label wire:click="chooseBranchAndVersion(true)" class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                        <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                            <span class="font-semibold">{{__('basic.Create a new Branch')}}</span>
                            <span class="text-sm opacity-50">{{__('basic.You can choose a version and create a branch based on it')}}</span>
                        </span>
                    </label>
                </div>
            @endif

            <!-- 选择目标分支（递交新版本） -->
            @if($step == 2)
                <div class="text-center mb-6 space-y-3">
                    <h2 class="text-xl font-semibold mb-4">{{__('basic.Select a target branch')}}</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($branches as $branch)
                            <div class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                                <button wire:click="selectTargetBranch('{{ $branch->id }}')" class="text-blue-600 hover:text-blue-800">
                                    <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                                        <span class="font-semibold">{{ $branch->name }}</span>
                                        <span class="text-sm opacity-50">{{ $branch->id }}</span>
                                    </span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 创建新分支或选择要继承的分支 -->
            @if($step == 3)
                <div class="text-center mb-6 space-y-3">
                    <h2 class="text-xl font-semibold mb-4">{{__('basic.Select the Branch to inherit')}}</h2>
                    <button wire:click="startFromScratch" class="bg-gray-500 text-white px-4 py-2 rounded mb-4">{{__('basic.Start from blank')}}</button>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($branches as $branch)
                            <div class="p-4 bg-gray-100 rounded">
                                <button wire:click="selectInheritBranch('{{ $branch->id }}')" class="text-blue-600 hover:text-blue-800">
                                    <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                                        <span class="font-semibold">{{ $branch->name }}</span>
                                        <span class="text-sm opacity-50">{{ $branch->id }}</span>
                                    </span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 选择版本 -->
            @if($step == 4)
                <div class="text-center mb-6 space-y-3">
                    <h2 class="text-xl font-semibold mb-4">{{__('basic.Select a Version')}}</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($versions as $version)
                            <div class="p-4 bg-gray-100 rounded">
                                <button wire:click="selectVersion('{{ $version->id }}')" class="text-blue-600 hover:text-blue-800">
                                    <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                                        <span class="font-semibold">{{ $version->name }}</span>
                                        <span class="text-sm opacity-50">{{ $version->id }}</span>
                                    </span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 提交任务按钮 -->
            @if($step == 5)
                <div class="text-center mb-6 space-y-3">
                    <h2 class="text-xl font-semibold mb-4">您的选择</h2>
                    <p class="mb-4">{{__('basic.Target')}}{{__('basic.Entry')}}: {{ $entryId }}</p>
                    <p class="mb-4">{{__('basic.Target')}}{{__('basic.Branch')}}: {{ $branchId }}</p>
                    <p class="mb-4">{{__('basic.Inherited from')}}{{__('basic.Branch')}}: {{ $inheritBranchId }}</p>
                    <p class="mb-4">{{__('basic.Selected')}}{{__('basic.Version')}}: {{ $originalVersionId }}</p>
                    <button wire:click="startTask" class="bg-red-500 text-white px-6 py-2 rounded">{{__('basic.Send')}}</button>
                </div>
            @endif
        </div>

    @else
        <!-- 用户未登录时显示的内容 -->
        <div class="flex justify-center items-center">
            <div class="text-center">
                <p class="text-lg text-gray-800 mb-4">{{__('basic.Selected')}}</p>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-blue-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-blue-100 bg-blue-50 hover:text-blue-600 hover:bg-blue-100">{{ __('Register')}}</a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-green-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-green-100 bg-green-50 hover:text-green-600 hover:bg-green-100">{{ __('Login')}}</a>
            </div>
        </div>
    @endif
</div>
