<div>
        <div x-data="{ modalOpen: $wire.showModal }"
       @keydown.escape.window="modalOpen = false"
        :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
         <!---->
            <button @click="modalOpen=true" wire:click="openModal" class="inline-flex items-center justify-center px-2 py-2 text-sm text-gray-500 font-medium transition-colors bg-white dark:bg-gray-800 rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="18" height="18" stroke-width="1.8" stroke="black" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <div class="p-1">
                    <p class="text-sm">收藏
                </p>
            </div>
            </button>
        <template x-teleport="body">
        <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
        <div x-show="modalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="modalOpen=false" @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
        <div x-show="modalOpen"
             x-trap.inert.noscroll="modalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
             class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                    <div class="flex items-center justify-between pb-3">
                        <div>
                        <h3 class="text-lg font-semibold ">添加至收藏夹</h3>
                        <p class="text-sm text-green-500">{{ $message }}</p>
                        </div>
                        <button @click="modalOpen=false" wire:click="reset_comp" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                        </button>
                    </div>
                    <div class="relative w-auto pb-8">

                    @if ($showCreateFavorite)
                    <div x-data="{ disableSubmit: false }">
                        <form @submit.prevent="if (!disableSubmit) $wire.createFavorite()">
                            <div class="flex flex-col space-y-2">
                                <label for="newFavoriteName" class="text-sm font-medium">收藏夹名称</label>
                                <input wire:model="newFavoriteName" type="text" id="newFavoriteName" class="w-full px-3 py-2 text-sm border border-neutral-200 rounded-md focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2 focus:outline-none">
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label for="newFavoriteDescription" class="text-sm font-medium">收藏夹描述</label>
                                <textarea wire:model="newFavoriteDescription" id="newFavoriteDescription" class="w-full px-3 py-2 text-sm border border-neutral-200 rounded-md focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2 focus:outline-none"></textarea>
                            </div>
                            <div class="flex justify-start mt-4 space-x-2">
                                <x-button type="submit" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900">Create</x-button>
                                <x-button type="button" @click="disableSubmit = true;" wire:click="closeCreateFavorite" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-gray-700 transition-colors border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2 hover:bg-gray-100">Cancel</x-button>
                            </div>
                        </form>
                    </div>

                    @else
                    <div>
                        <!-- 收藏夹列表 -->
                        <div class="max-h-52 overflow-y-auto mb-4">
                            @foreach ($favorites as $favorite)
                            <div class="m-2 p-2 rounded-md hover:bg-gray-200">
                                <button wire:click="addToFavorite('{{ $favorite->id }}')" class="text-gray-500 block ">{{ $favorite->name ? $favorite->name : 'no name favorites' }}</button>
                            </div>
                            @endforeach
                        </div>
                        <x-button wire:click="openCreateFavorite" class="ml-0">
                            Create
                        </x-button>
                    </div>

                    @endif


                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
