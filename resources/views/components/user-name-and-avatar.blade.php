<div class="flex items-center">
    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="flex items-center">
        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full mr-2">
        <span>{{ $user->name }}</span>
    </a>
</div>
