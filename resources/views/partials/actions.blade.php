<div class="d-flex justify-content-between alingn-items-center">
    <div wire:ignore>
        <x-app-config.button type="button" title="Reset" color="default" icon="far fa-minus-square text-orange" wire:click="resetTo()"
            id="btnReset{{ $idButtonReset }}" />
    </div>
    @if ($btnAction == 'save')
        <x-app-config.button type="sumit" title="Register" icon="fas fa-save text-indigo" color="default"/>
    @else
        <x-app-config.button type="sumit" title="Update" icon="fas fa-save text-indigo" color="default" />
    @endif
</div>
