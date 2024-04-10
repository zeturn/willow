<div class="flex flex-col md:flex-row dark:text-gray-400">

    <!-- Left Side: Branches List -->
    <div class="w-full md:w-1/2 p-4">
        <h2 class="text-lg font-semibold">Branches</h2>
        <div class="mt-4 space-y-4 max-h-[750px] overflow-y-auto overscroll-none">
            @foreach($branches as $branch)
                <div class="p-4 space-x-3 border rounded-md shadow-sm dark:hover:bg-gray-400 hover:bg-gray-50  border-neutral-200/70 ">
                    <div class="flex items-center mb-2">
                        <x-user-name-and-avatar :user-id="$branch->owner->id" />
                        <p>/ {{ substr($branch->name, 0, 20) }}</p>
                        <div class="ml-2">
                            @if($branch -> id == $demo_branch_id)
                                <span class="bg-transparent text-purple-500 border border-purple-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Demo Branch</span>
                            @elseif($branch -> status == 1301113745)
                                <span class="bg-transparent text-indigo-500 border border-indigo-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Common Branch</span>
                            @endif
                        </div>

                        <div class="ml-2">
                            @if($is_pb)
                                <span class="bg-transparent text-green-500 border border-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">pb</span>
                            @else
                                <span class="bg-transparent text-blue-500 border border-blue-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">cb</span>
                            @endif
                        </div>

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
    <div class="w-full md:w-1/2 md:p-4 md:border-l md:border-gray-200">
        <h2 class="text-lg font-semibold">Versions</h2>
        <div class="mt-4 space-y-4 max-h-[750px] overflow-y-auto overscroll-none">

        @if($versions && count($versions) > 0)
            <ul class="mt-4 space-y-4">
                <a href="{{ route('entry.branch.show.showDemoVersion', $branch->id) }}" class="block">
                    <li class="p-4 border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                        <div class="text-gray-800 dark:text-gray-400">Visit Branch</div>
                    </li>
                </a>

                @foreach($versions as $version)
                <a href="{{ route('entry.version.show', $version->id) }}" class="block">
                    <li class="p-4 border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                        <div class="text-gray-800 font-medium dark:text-gray-400">{{ substr($version->name, 0, 30) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ substr($version->description, 0, 50) }}</div>
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
