<!--Trans:240412 Finish:90%-->
<div>
    <div class="container mx-auto px-4 md:px-8 lg:px-16 xl:px-24">

        <div class="mb-10 mt-5 p-4 dark:bg-gray-800 dark:text-white">
            <h1 class="text-4xl font-bold mb-2">{{ __('basic.Explore')}} 🔭</h1>
            <p class="text-sm text-gray-600 mt-1 dark:text-gray-400">{{ __('This page is recommended based on recent updates and real-time popularity, and has nothing to do with personal preferences👍')}}</p>
            <p class="text-sm text-gray-600 mt-1 dark:text-gray-400">{{ __(    '⚠️The content of this site is written by users or automatically processed based on Internet content. It does not represent the views of this site or the views of the operator.')}}</p>
        </div>


        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6 lg:gap-8 place-items-start">
            @foreach ($entries as $entry)
                <a href="{{ route('entry.show.explanation', $entry->id) }}" class="bg-white rounded-lg p-6 h-auto dark:bg-gray-700 dark:text-white">
                    <!-- 显示条目的内容，并加大加粗标题 -->
                    <h2 class="text-xl font-bold mb-4">{{ $entry->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{!! \Illuminate\Support\Str::limit($entry->getDemoBranch()->getDemoVersion()->content, 50) !!}</p>
                </a>
            @endforeach
        </div>

        <div class="flex justify-center">
            <button wire:click="loadMoreEntries" class=" text-gray-500 font-bold px-2">
            {{__('basic.Load More')}}
            </button>
            <div wire:loading class=" text-gray-500 font-bold py-2 px-2"> 
                <!-- Component: Square horizontal sm sized spinner  -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-live="polite" aria-busy="true">
                <path d="M7 10H3V14H7V10Z" class="fill-emerald-500 animate animate-bounce " />
                <path d="M14 10H10V14H14V10Z" class="fill-emerald-500 animate animate-bounce  [animation-delay:.2s]" />
                <path d="M21 10H17V14H21V10Z" class="fill-emerald-500 animate animate-bounce  [animation-delay:.4s]" />
                </svg>
                <!-- End Square horizontal sm sized spinner  -->
            </div>
        </div>

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