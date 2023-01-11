@props(['title' => null, 'icon' => null, 'color' => 'primary'])

<button {{ $attributes->merge(['class' => "btn btn-$color"]) }}>
    {{ $title }}

    @if ($icon)
        <i class="{{$icon}}"></i>
    @endif
</button>
