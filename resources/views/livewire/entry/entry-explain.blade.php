<!-- resources/views/livewire/entry/entry-explain.blade.php -->
<!--Trans:240412 Finish:All-->
<div class="space-y-6">
 <p class="p-3 m-3 text-lg">{{__('basic.All')}}{{__('basic.Explanation')}}</p>
    @foreach ($branches as $branch)
        @if($branch->getDemoVersion()->isOwnerVisible())
            @if($branch -> id != $entry -> getDemoBranch() -> id)
            <div class="bg-white p-6 dark:bg-gray-800 mb-8 border-b border-gray-200 dark:border-gray-700">

                <div class="flex flex-col md:flex-row justify-between mb-6"> <!-- 修改Flex容器，移除items-center -->
                    <div class="flex items-center md:mb-2"> <!-- 新增一个Flex容器，用于头像和branchname并排 -->
                        <x-user-name-and-avatar :user-id="$branch->owner->id" class="mr-4" />
                        <a href="{{ route('entry.branch.show.showDemoVersion', $branch->id) }}" class="text-left">/ {{ substr($branch->name, 0, 20) }}</a> <!-- 添加text-left类 -->
                    </div>
                    <div class="md:hidden text-left"> <!-- 在小屏幕上显示，在大屏幕上隐藏，并左对齐文本 -->
                        <span class="bg-transparent text-indigo-500 border border-indigo-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Common Branch</span>
                    </div>
                    <div class="text-gray-400 text-sm md:text-right dark:text-gray-300">{{$branch->id}}<p class="md:mr-2">{{$branch->getDemoVersion()->created_at->format('M d, Y') }}</p></div> <!-- id放在右侧 -->
                </div>

                <h2 class="text-2xl font-semibold">{{ $branch->name }}</h2>
                <p class="text-gray-700 dark:text-gray-400">{!! \Illuminate\Support\Str::markdown($branch->getDemoVersion()->content) !!}</p>
            </div>
            @endif
        @endif
    @endforeach

    @if($hasMoreBranches)
        <button wire:click="loadMoreBranches" class="text-center text-gray-500 my-4">{{__('basic.Load More')}} ...</button>

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
        <p class="text-center text-gray-500 my-4">{{__('basic.Thats all')}}</p>
    @endif
</div>
