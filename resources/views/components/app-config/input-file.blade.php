@props(['for'])

<div class="custom-file">
    <input type="file" {!! $attributes->merge(['class' => 'custom-file-input']) !!} id="{{ $for }}">
    <label class="custom-file-label" for="{{ $for }}">{{ __('Choose file') }}</label>
</div>
