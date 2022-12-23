@props(['status'])

@if ($status)
    <div class="callout callout-info">
        <h5>{{ __('Information') }}</h5>
        <p>{{ $status }}</p>
    </div>
@endif
