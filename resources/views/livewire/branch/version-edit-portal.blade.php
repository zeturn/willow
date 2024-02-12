<div>
    @if($versions && $versions->count())
        @foreach($versions as $version)
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 dark:border-gray-700 mb-4 shadow-sm">
                <a href="{{ route('entry.version.show', $version->id) }}">
                    <h3 class="text-xl font-semibold dark:text-white">{{ $version->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">作者：{{ $version->author_id }} | 创建时间：{{ $version->created_at->format('M d, Y') }}</p>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        {{ \Illuminate\Support\Str::limit($version->description, 150, '...') }}
                    </p>
                </a>
                <button wire:click="selectVersion('{{ $version->id }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">开始编辑</button>
            </div>
        @endforeach
    @endif
</div>
