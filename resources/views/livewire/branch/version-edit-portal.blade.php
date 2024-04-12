@php
    $isfree = $branch->is_free;//是否自由处理
@endphp

<div>
    @if($versions && $versions->count())
        @foreach($versions as $version)
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 dark:border-gray-700 mb-4 shadow-sm">
                <a href="{{ route('entry.version.show', $version->id) }}">
                    <h3 class="text-xl font-semibold dark:text-white">{{ $version->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{__('basic.Author')}}：{{ $version->author_id }} | {{__('basic.Created')}}：{{ $version->created_at->format('M d, Y') }} |                     
                        @if($version -> id == $demo_version_id)
                            <span class="bg-transparent text-purple-500 border border-purple-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Demo Version</span>
                        @elseif($version -> status == 1301113244)
                            <span class="bg-transparent text-orange-500 border border-orange-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Waiting for Principle Censor</span>
                        @elseif($version -> status == 1301113745)
                            <span class="bg-transparent text-indigo-500 border border-indigo-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Common Version</span>
                        @elseif($version -> status == 1301111545)
                            <span class="bg-transparent text-yellow-500 border border-yellow-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Waiting for Conetent Censor</span>
                        @endif
                
                    </p>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        {{ \Illuminate\Support\Str::limit($version->description, 150, '...') }}
                    </p>

                </a>
                @auth
                    @if($isfree|| $userEditable != 0 )
                    {{__('basic.Status')}}：{{$version -> getCensorStatus()}}
                        @if($version -> getCensorStatus() == 7)
                            <button wire:click="selectVersion('{{ $version->id }}')" class=" text-gray-500 py-2 px-4 rounded mt-2">{{__('basic.Edit')}}</button>
                        @endif
                    @endif
                    @if($author_id == $branch->owner->id )
                        <button wire:click="deleteVersion('{{ $version->id }}')" class=" text-red-500 py-2 px-4 rounded mt-2">{{__('basic.Delete')}}</button>
                    @endif
                @endauth

            </div>
        @endforeach
    @endif
</div>

