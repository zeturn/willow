<!-- resources/views/livewire/album/album-creator.blade.php -->
<div class="max-w-md mx-auto p-4">
    <form class="flex flex-col space-y-4" wire:submit.prevent="saveAlbum">
        <input type="text" wire:model="album.title" placeholder="相册标题" required class="p-2 border rounded shadow">
        <input type="file" multiple wire:model="photos" accept="image/*" class="p-2 border rounded shadow">
        <button type="submit" wire:click="saveAlbum()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">创建相册</button>
    </form>

    @if ($photo_list)
    <div class="gallery grid md:grid-cols-3 gap-4 mt-4">
        @foreach ($photo_list as $index => $photo)
            <div class="image-container relative">
                <img class="w-full h-auto object-cover rounded shadow" src="{{ $photo['url'] }}" alt="Image {{$index }}">
                <a href="#" class="absolute bottom-0 right-0 text-white bg-gray-800 rounded p-1">{{$index+1}}</a>
                @if($index != 0)
                <button wire:click="moveUp('{{ $index }}')" wire:click="$refresh" class="absolute top-0 left-0 bg-green-500 text-white px-2 py-1 rounded shadow">上移</button>
                @endif
                @if($index != count($photo_list) - 1)
                <button wire:click="moveDown('{{ $index }}')" wire:click="$refresh" class="absolute bottom-0 left-0 bg-yellow-500 text-white px-2 py-1 rounded shadow">下移</button>
                @endif
                <button wire:click="removePhoto('{{ $index }}')" wire:click="$refresh" class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1 rounded shadow">删除</button>
            </div>
        @endforeach
    </div>
    @endif

</div>
