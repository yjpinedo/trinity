@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-info alert-dismissible']) }}>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> {{ __('Alert!') }}</h5>
        {{ $status }}
    </div>
@endif
