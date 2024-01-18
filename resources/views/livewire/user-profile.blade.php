<!-- resources/views/livewire/user-profile.blade.php -->

<div style="display: flex; align-items: center;">
    <a href="{{ route('user.profile', $user->id) }}">
        <img src="{{ $user->avatar }}" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
        <span>{{ $user->name }}</span>
    </a>
</div>
