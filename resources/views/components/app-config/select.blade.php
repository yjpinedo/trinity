@props(['disabled' => false])
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'custom-select']) !!}>
    {{ $slot }}
</select>
