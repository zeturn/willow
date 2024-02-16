<div>

<div x-data="{ ConfirmModalOpen: false, NightModalOpen: false, confirmMessage: ''  }"
    @keydown.escape.window="ConfirmModalOpen = false"
    @keydown.escape.window="NightModalOpen = false"
    :class="{ 'z-40': ConfirmModalOpen }" class="relative w-auto h-auto">
    <button @click="ConfirmModalOpen=true" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">删除分支</button>
    <template x-teleport="body">
        <div x-show="ConfirmModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
            <div x-show="ConfirmModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="ConfirmModalOpen=false" class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
            <div x-show="ConfirmModalOpen"
                x-trap.inert.noscroll="ConfirmModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg font-semibold">删除分支</h3>
                    <button @click="ConfirmModalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                    </button>
                </div>
                <div class="relative w-full pb-8 bg-gray-100 rounded-lg p-6 mb-6">
                    <p class="text-sm text-gray-600">❓ Are you sure you want to delete?</p>
                </div>
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                    <button @click="ConfirmModalOpen=false" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">取消</button>
                    <button @click="ConfirmModalOpen=false;NightModalOpen = true" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900">继续</button>
                </div>
            </div>
        </div>
    </template>

    <template x-teleport="body">
        <div x-show="NightModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
            <div x-show="NightModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="NightModalOpen=false" class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
            <div x-show="NightModalOpen"
                x-trap.inert.noscroll="NightModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg font-semibold">删除分支</h3>
                    <button @click="NightModalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                    </button>
                </div>
                <div class="relative w-full pb-8 bg-gray-100 rounded-lg p-6 mb-6">
                    <p class="text-sm text-gray-600 mb-2">🌟 Hey there, just a heads up! This is the final prompt. After you click the button, the deletion action will be executed.</p>
                    <p class="text-sm text-gray-600 mb-2">✍️ Please enter the following in the input box: <span class="font-medium">{{$confirmMessage}}</span></p>
                    <div class="w-full max-w-xs mx-auto">
                        <input x-model="confirmMessage" type="text" placeholder="Branch Name" class="w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 disabled:cursor-not-allowed disabled:opacity-50" />
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                    <button @click="NightModalOpen=false" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">Cancel</button>
                    <button
                            @click="NightModalOpen=false"
                            type="button"
                            :class="{ 'bg-red-600 rounded-md hover:bg-red-700': confirmMessage === '{{$confirmMessage}}', 'bg-gray-300 rounded-md cursor-not-allowed': confirmMessage !== '{{$confirmMessage}}' }"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none"
                            :disabled="confirmMessage !== '{{$confirmMessage}}'"
                            >
                            删除
                            </button>

                </div>
            </div>
        </div>
    </template>
</div>


</div>
