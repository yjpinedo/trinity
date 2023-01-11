@props(['idModal'])

<div>
    <div class="modal fade" id="{{ $idModal }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $title ?? '' }}</h4>
                </div>
                <div class="modal-body">
                    @isset($body)
                    {{ $body }}
                    @endisset
                </div>
                @isset($footer)
                    <div class="modal-footer justify-content-between">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
