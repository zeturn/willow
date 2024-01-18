<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <input type="text" wire:model="newalbumId" placeholder="{{ __('Enter New Album ID') }}" class="bg-gray-200 rounded p-2 w-full">
                <button wire:click="addEntityAlbumLink" class="bg-color-success-500 hover:bg-color-success-600 text-white font-bold py-2 px-4 rounded mt-2">
                    {{ __('Add Link To Album') }}
                </button>
            </div>

            @error('newalbumId')
                <span class="text-color-danger-500">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
