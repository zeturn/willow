<div>
    @if($versions && $versions->count())

            @foreach($versions as $version)
                <a wire:click="selectVersion('{{ $version->id }}')">{{ $version->name }}</a>
            @endforeach

    @endif
</div>
