<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full px-4">
            @if (auth()->check())
                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                    <input type="text" wire:model="newalbumId" placeholder="{{ __('Enter New Album ID') }}" class="bg-gray-200 rounded p-2 w-full">
                    <button wire:click="addEntityAlbumLink" class="bg-{{ $colorSystem['color-success-500'] }} hover:bg-{{ $colorSystem['color-success-600'] }} text-white font-bold py-2 px-4 rounded mt-2">
                        {{ __('Add Link To Album') }}
                    </button>
                </div>

                @error('newalbumId')
                    <span class="text-{{ $colorSystem['color-danger-500'] }}">{{ $message }}</span>
                @enderror
            @else
                <div class="text-center py-4">
                    <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to add new album links.</p>
                </div>
            @endif
        </div>
    </div>
</div>
