
<!-- resources/views/livewire/entry/entry-explain.blade.php -->

<div class="space-y-6">
    @foreach ($branches as $branch)
        @if($branch -> id != $entry -> getDemoBranch() -> id)
        <div class="bg-white p-6 dark:bg-gray-800 mb-8 border-b border-gray-200 dark:border-gray-700">
            <p class="p-3 m-3 text-lg">全部解释</p>
            <div class="flex justify-between items-center mb-6"> <!-- 修改Flex容器，使用justify-between使子元素分布左右两边 -->
                <div class="flex items-center"> <!-- 新增一个Flex容器，用于头像和branchname并排 -->
                    <x-user-name-and-avatar :user-id="$branch->owner->id" class="mr-4" /> <!-- 添加间距，让头像和文字之间有间隔 -->
                    <p>/ {{ substr($branch->name, 0, 20) }}</p>
                    <div class="ml-2">
                            @if($branch -> id == $entry -> getDemoBranch() -> id)
                                <span class="bg-transparent text-purple-500 border border-purple-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Demo Branch</span>
                            @else
                                <span class="bg-transparent text-indigo-500 border border-indigo-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Common Branch</span>
                            @endif
                        </div>
                </div>
                <div class="text-gray-400 text-sm dark:text-gray-300">{{$branch->id}}<p class="md:mr-2">{{ $branch->getDemoVersion()->created_at->format('M d, Y') }}</p></div> <!-- id放在右侧 -->
                
            </div>


            <h2 class="text-2xl font-semibold">{{ $branch->name }}</h2>
            <p class="text-gray-700 dark:text-gray-400">{!! \Illuminate\Support\Str::markdown($branch->getDemoVersion()->content) !!}</p>
        </div>
        @endif
    @endforeach
    @if($hasMoreBranches)
        <button wire:click="loadMoreBranches" class="load-more bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Load More</button>

        <div x-data="{
                    observe () {
                        let observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    @this.call('loadMoreBranches')
                                }
                            })
                        }, {
                            root: null
                        })
                        observer.observe(this.$el)
                    }
                }"
                x-init="observe"
            ></div>
    @else
        <p class="text-center text-gray-500 my-4">That's all 就这些</p>
    @endif
</div>
