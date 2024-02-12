<div class="flex">

    <!-- Left Side: Branches List -->
    <div class="w-1/2 p-4">
        <h2 class="text-lg font-semibold">Branches</h2>
        <div class="mt-4 space-y-4 max-h-[750px] overflow-y-auto overscroll-none">
            @foreach($branches as $branch)
                <div class="p-4 bg-white rounded-lg shadow flex flex-col">
                    <div class="flex items-center mb-2">
                    <x-user-name-and-avatar :user-id="$branch->owner->id" />
                    </div>
                    <div class="flex items-center justify-between">
                        <button wire:click="loadVersions('{{ $branch->id }}')" class="text-blue-600 hover:text-blue-800 text-sm">
                            {{ $branch->id }}
                        </button>
                        <span class="text-xs text-gray-600">版本数量: {{ $branch->versions->count() }}个</span>
                        <span class="text-xs text-gray-600">Updated: {{ $branch->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Right Side: Versions List -->
    <div class="w-1/2 p-4 border-l border-gray-200">
        <div class="mt-4 space-y-4 max-h-[750px] overflow-y-auto overscroll-none">
        <h2 class="text-lg font-semibold">Versions</h2>
        @if($versions && count($versions) > 0)
            <ul class="mt-4 space-y-4">
                <a href="{{ route('entry.branch.show.showDemoVersion', $branch->id) }}" class="block">
                    <li class="p-4 bg-white rounded-lg shadow">
                        <div class="text-gray-800">Visit Branch</div>
                    </li>
                </a>

                @foreach($versions as $version)
                <a href="{{ route('entry.version.show', $version->id) }}" class="block">
                    <li class="p-4 bg-white rounded-lg shadow">
                        <div class="text-gray-800 font-medium">{{ $version->name }}</div>
                        <div class="text-sm text-gray-600">{{ $version->description }}</div>
                    </li>
                </a>
                @endforeach
            </ul>
        @else
            <div class="text-gray-400 text-center mt-10">
                @if($selectedBranchId)
                    当前分支中没有版本
                @else
                    在左边分支列表中选择分支
                @endif
            </div>
        @endif
        </div>
    </div>
</div>
