<div>
    <button wire:click="generateToken" class="btn btn-primary">
        Generate Token
    </button>

    @if ($access_token)
        <div class="mt-4">
            <p>Your generated token is: <strong>{{ $access_token }}</strong></p>
        </div>
    @endif
</div>
