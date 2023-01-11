@props(['submit'])
<form wire:submit.prevent="{{ $submit }}">

    {{ $slot }}

    @if (isset($actions))
        <div class="">
            {{ $actions }}
        </div>
    @endif
</form>
