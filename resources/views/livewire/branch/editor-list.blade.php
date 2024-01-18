
<div>
    @if (Auth::check()) <!-- Check if user is logged in -->
        @foreach ($users as $user)
        <div class="{{ $user->status == 1 ? 'bg-blue-100' : ($user->status == 2 ? 'bg-green-100' : '') }}">
            <div class="p-4 border-b">{{ $user->user_id }}</div>
            @if (Auth::id() == $owner->user_id) <!-- Check if the logged-in user is the same as the current user in the loop -->
                <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700" wire:click="deleteEditor('{{ $user->user_id }}')">{{ _('Delete User') }}</button>
            @endif
        </div>
        @endforeach
        <div class="mt-4">
            <!-- Implement the interface for adding a user, such as an input box and an add button -->
            <div class="font-bold">{{ _('Create New Editor') }}</div>
            <input type="text" class="mt-2 p-2 border rounded" wire:model="newUserId">
            <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700" wire:click="addEditor()">{{ _('Add User') }}</button>
        </div>
    @else
        <div class="text-center py-4">{{ _('Please Log In First.') }}</div> <!-- Message to show if the user is not logged in -->
    @endif
</div>

