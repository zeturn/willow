<div>
    <button wire:click="generateToken" class="btn btn-primary">
        Generate Token
    </button>

    @if ($token)
        <div class="mt-4">
            <p>Your generated token is: <strong>{{ $token }}</strong></p>
        </div>
    @endif
</div>
