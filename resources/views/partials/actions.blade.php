<div class="d-flex justify-content-between alingn-items-center">
    <div wire:ignore>
        <x-app-config.button type="button" title="Reset" color="default" icon="far fa-minus-square text-cyan" wire:click="resetTo()"
            id="btnReset{{ $idButtonReset }}" />
    </div>
    @if ($btnAction == 'save')
        <x-app-config.button type="sumit" title="Register" icon="fas fa-save text-primary" color="default"/>
    @else
        <x-app-config.button type="sumit" title="Edit" icon="fas fa-edit text-cyan" color="default" />
    @endif
</div>
