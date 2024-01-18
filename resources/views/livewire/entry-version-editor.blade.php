<div class="container mx-auto dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Column -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="p-4">
                <!-- Display IDs -->
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    {{_('edit')}}
                </div>

                <!-- Editing Area -->
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <input type="text" wire:model="name" placeholder="Name" class="w-full p-2 mb-2 border-2 border-gray-300 rounded">
                    <textarea wire:model="description" rows="3" placeholder="Description" class="w-full p-2 mb-2 border-2 border-gray-300 rounded"></textarea>
                    <textarea wire:model="content" rows="10" placeholder="Content" class="w-full p-2 mb-2 border-2 border-gray-300 rounded"></textarea>
                </div>

                <!-- Push Changes Button -->
                <button wire:click="push" class="bg-orange-500 text-white rounded px-4 py-2">Push Changes</button>
                <button wire:click="autoSave" class="bg-green-500 text-white rounded px-4 py-2">Store Version</button>
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

                <!-- Auto Save Indicator -->
                <div wire:poll.24000ms="autoSave" class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    @livewire('network-status')
                </div>

            </div>
        </div>
    </div>
</div>