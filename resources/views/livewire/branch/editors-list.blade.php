<div>
    @if (Auth::check()) <!-- Check if user is logged in -->
    <div class="pb-4 mb-4 border-b dark:border-gray-700">
        <div class="font-bold">{{ _('Create New Editor') }}</div>
        <input type="text" class="mt-2 p-2 border rounded" wire:model.live.debounce.500ms="newUserId">
        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700" wire:click="addEditor()">{{ _('Add User') }}</button>
        @if($searchResult)
            <div class="ml-4 mt-2">
                @if ($searchResult['type'] === 'user')
                    <x-user-name-and-avatar :user-id="$searchResult['detail']" class="w-8 h-8 rounded-full" />
                @else
                    <span>{{ $searchResult['detail'] }}</span>
                @endif
            </div>
        @endif
    </div>

    <div id="user" class="font-bold">{{ _('Editor List') }}</div>
    @foreach ($users as $user)
        <div class="{{ $user->status == 1 ? 'bg-blue-100' : ($user->status == 2 ? 'bg-green-100' : '') }} mt-5">
            <x-user-name-and-avatar :user-id="$user->id" class="w-8 h-8 rounded-full" />
            @if (Auth::id() == $owner->user) <!-- Check if the logged-in user is the same as the current user in the loop -->
                <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700" wire:click="deleteEditor('{{ $user->id }}')">{{ _('Delete User') }}</button>
            @endif
        </div>
    @endforeach

    @else
        <div class="text-center py-4">{{ _('Please Log In First.') }}</div> <!-- Message to show if the user is not logged in -->
    @endif
</div>
