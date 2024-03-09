<div class="container mx-auto dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="p-4">
                <!-- Display IDs -->
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <p class="text-lg">{{_('MemeGit Editor')}}</p>
                </div>

                <!-- Editing Area -->
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <input type="text" wire:model="name" placeholder="Name" class="w-full p-2 mb-2 border-2 border-gray-300 rounded">
                    <input type="text" wire:model="meta" placeholder="Meta" class="w-full p-2 mb-2 border-2 border-gray-300 rounded">
                    <textarea wire:model="description" rows="3" placeholder="Description" class="w-full p-2 mb-2 border-2 border-gray-300 rounded"></textarea>
                    <textarea wire:model="content" rows="10" placeholder="Content" class="w-full p-2 mb-2 border-2 border-gray-300 rounded"></textarea>
                </div>

                <!-- Push Changes Button -->


                <div x-data="{ modalOpen: false }"
                @keydown.escape.window="modalOpen = false"
                class="relative z-50 w-auto h-auto">
                <button wire:click="autoSave" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-green-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-green-100 bg-green-50 hover:text-green-600 hover:bg-green-100">Store Version</button>
                <button wire:click="push" @click="modalOpen=true" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-yellow-600 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-yellow-100 bg-yellow-50 hover:text-yellow-700 hover:bg-yellow-100">Push Changes</button>
                <button wire:click="deletetask" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-red-600 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-red-100 bg-red-50 hover:text-red-700 hover:bg-red-100">Delete Task</button>

                <template x-teleport="body">
                    <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                        <div x-show="modalOpen" 
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-300"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                        <div x-show="modalOpen"
                            x-trap.inert.noscroll="modalOpen"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                            <div class="flex items-center justify-between pb-2">
                                <h3 class="text-lg font-semibold">正在提交</h3>
                                <button @click="modalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                                </button>
                            </div>
                            <div class="relative w-auto">
                                <div x-data="{
                                        progress: 0,
                                        progressInterval: null,
                                    }"
                                    x-init="
                                        progressInterval = setInterval(() => {
                                            progress = progress + 1;
                                            if (progress >= 100) {
                                                clearInterval(progressInterval);
                                            }
                                        }, 100);
                                    "
                                    class="relative w-full h-3 overflow-hidden rounded-full bg-neutral-100">
                                    <span :style="'width:' + progress + '%'" class="absolute w-24 h-full duration-300 ease-linear bg-neutral-900" x-cloak></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>


            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="p-4">

                <!-- Sidebar content here -->
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <!-- Sidebar Widgets or Additional Information -->
                    编辑类型
                    @if($status == 5)
                        <p>5:new branch</p>
                    @elseif($status == 7)
                        <p>7:new pb version</p>
                    @else
                        <p>10:new cb version</p>
                    @endif
                </div>

                <!-- Sidebar content here -->
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <!-- Sidebar Widgets or Additional Information -->
                    <p>Entry ID: {{ $entryId }}</p>
                    <p>Branch ID: {{ $branchId }}</p>
                    <p>Original Version ID: {{ $originalVersionId }}</p>
                </div>

                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <!-- Sidebar Widgets or Additional Information -->
                    <p>ConflictingVersions</p>
                    <p>以下列出了当前task创建后生成的版本，为避免编辑冲突，建议检查以下版本：</p>

                    @if($ConflictingVersions)
                    @foreach($ConflictingVersions as $ConflictingVersion)
                        <a href="{{ route('entry.version.show', $ConflictingVersion->id) }}" class="block">
                            <div class="p-4 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                                <div class="text-gray-800 font-medium">{{ substr($ConflictingVersion->name, 0, 30) }}</div>
                                <div class="text-sm text-gray-600">{{ $ConflictingVersion->created_at->format('M d, Y') }}</div>
                            </div>
                        </a>
                    @endforeach
                    @endif
                </div>


                <!-- Auto Save Indicator -->
                <div wire:poll.24000ms="autoSave" class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    @livewire('network-status')
                </div>

            </div>
        </div>
    </div>
</div>