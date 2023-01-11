@props(['value'])

<label {{ $attributes->merge(['class' => '']) }}>
    {{ __($value) ?? $slot }}
</label>
