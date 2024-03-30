<div>

    <div class="container mx-auto px-4 md:px-8 lg:px-16 xl:px-24">

        <div class="mb-10 mt-5 p-4">
            <h1 class="text-4xl font-bold mb-2">探索</h1>
            <p class="text-sm text-gray-600 mt-1">此页根据近期更新及实时热度推荐，与个人偏好无关</p>
            <p class="text-sm text-gray-600 mt-1">本站内容由用户编写或根据互联网内容自动处理而成，不代表本站观点</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6 lg:gap-8 place-items-start">
            @foreach ($entries as $entry)
                <a href="{{ route('entry.show.explanation', $entry->id) }}" class="bg-white rounded-lg p-6 h-auto">
                    <!-- 显示条目的内容，并加大加粗标题 -->
                    <h2 class="text-xl font-bold">{{ $entry->name }}</h2>
                    <p>{{ $entry->content }}</p>
                    {!! \Illuminate\Support\Str::limit($entry->getDemoBranch()->getDemoVersion()->content) !!}
                </a>
            @endforeach
        </div>

    <button wire:click="loadMoreEntries" class="text-center text-gray-500 my-4">Load More 加载更多 ...</button>
    <div x-data="{
                observe () {
                    let observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                @this.call('loadMoreEntries')
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

    </div>
</div>