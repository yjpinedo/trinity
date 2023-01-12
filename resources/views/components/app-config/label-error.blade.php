@props(['for'])

@error($for)
    <small {{ $attributes->merge(['class' => 'text-sm text-danger']) }}>{{ $message }}</small>
@enderror
