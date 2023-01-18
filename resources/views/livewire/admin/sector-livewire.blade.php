<div>

    @push('css')
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Sectors') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Management Sectors') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Sectors') }}
    </x-slot>

    <x-slot name="user">
        {{ Auth::user()->name }}
    </x-slot>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6><i class="fas fa-sitemap text-primary"></i> {{ __('Create new sector') }}</h6>
                </div>
                <div class="card-body">
                    <div class="ml-4 tab-content" wire:loading wire:target="image">
                        <div class="tab-loading">
                            <div>
                                <h1 class=""><i class="fa fa-sync fa-spin text-primary mr-2"></i>
                                    {{ __('Loading image') }}</h1>
                            </div>
                        </div>
                    </div>

                    @if ($image)
                        <img id="idImageSector" class="img-fluid" src="{{ $image->temporaryUrl() }}">
                    @elseif($imageFind)
                        <img id="idImageSector" class="img-fluid" src="{{ Storage::url($imageFind) }}">
                    @endif

                    <x-app-config.form submit="save">
                        <div class="form-group">
                            <x-app-config.label value="Name" />
                            <x-app-config.input wire:model.defer="name" id="idNameSector" />
                            <x-app-config.label-error for="name" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label value="Description" />
                            <textarea class="form-control" rows="5" wire:model.defer="description" id="idDescriptionSector"></textarea>
                            <x-app-config.label-error for="description" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label value="Image" /> <br>
                            <input type="file" wire:model="image" id="{{ $identificationImage }}">
                            <br>
                            <x-app-config.label-error for="image" />
                            <div class="form-group">
                                <x-slot name="actions">
                                    @include('partials.actions', ['idButtonReset' => 'Sectors'])
                                </x-slot>
                            </div>
                        </div>
                    </x-app-config.form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6 class=""><i class="fas fa-table text-primary"></i> {{ __('List of sectors') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="card p-2">
                        <div class="row">
                            <div class="col-12">
                                <x-app-config.input wire:model.debounce.500ms="search"
                                    placeholder="{{ __('Search by id, title, description') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    @include('partials.columns-table', [
                                        'percentage' => [
                                            'id' => '6%',
                                            'column' => '15%',
                                            'action' => '15%',
                                        ],
                                    ])
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sectors as $sector)
                                    <tr>
                                        <td>{{ $sector->id }}</td>
                                        <td>{{ $sector->name }}</td>
                                        <td>{{ $sector->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center align-middle">
                                            <span
                                                class="badge badge-{{ $sector->state == 'Activo' ? 'success' : 'danger' }}">{{ $sector->state }}</span>
                                        </td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            @if ($sector->state == 'Activo')
                                                <x-app-config.button color="link text-danger" icon="fas fa-power-off"
                                                    class="btn-sm"
                                                    wire:click="$emit('changeStateSector', {{ $sector }})" />
                                            @else
                                                <x-app-config.button color="link text-success" icon="fas fa-power-off"
                                                    class="btn-sm"
                                                    wire:click="$emit('changeStateSector', {{ $sector }})" />
                                            @endif

                                            {{-- <x-app-config.button title="Delete" color="outline-light text-danger"
                                                icon="fas fa-trash" class="btn-sm"
                                                wire:click="$emit('deleteSector', {{ $sector }})" /> --}}
                                            <x-app-config.button color="link text-cyan" icon="fas fa-edit"
                                                class="btn-sm" wire:click="edit('{{ $sector->id }}')" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">{{ __('Not sectors lists') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($sectors->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $sectors->firstItem() !!} {{ __('to') }} {!! $sectors->lastItem() !!}
                            {{ __('of') }} {!! $sectors->total() !!} {{ __('entries') }}
                            {!! $sectors->links() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('js')
        <!-- SweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('livewire:load', function() {
                $('#btnResetSectors').hide();

                hideShowBtn('input', '#idNameSector', '#btnResetSectors');
                hideShowBtn('input', '#idDescriptionSector', '#btnResetSectors');
                hideShowBtn('input', '#{{ $identificationImage }}', '#btnResetSectors');
            });

            /* Livewire.on('deleteSector', sector => {
                Swal.fire({
                    title: "{{ __('Are you sure you want to delete') }}",
                    toast: true,
                    text: `{{ __('There is no way back') }}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    position: 'top-end',
                    confirmButtonText: "{{ __('Yes, delete it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emit('delete', sector.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Delete sector') }}",
                            text: `{{ __('The sector ${sector.name} has been successfully removed') }}`,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    }
                });
            }); */

            Livewire.on('changeStateSector', sector => {
                Swal.fire({
                    title: "{{ __('Are you sure you want to change state') }}",
                    toast: true,
                    text: `{{ __('There is no way back') }}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    position: 'top-end',
                    confirmButtonText: "{{ __('Yes, change state it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emit('changeState', sector.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Change state sector') }}",
                            text: `{{ __('The state of the sector ${sector.name} was successfully updated') }}`,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    }
                });
            });

            Livewire.on('alert', (data) => {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: data.icon,
                    title: "{{ __('Your work has been saved') }}",
                    text: data.message,
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
            });

            Livewire.on('show-btn', () => $('#btnResetSectors').show());

            Livewire.on('hide-btn', () => $('#btnResetSectors').hide());

            function hideShowBtn(event, field, button) {
                $(field).on(event, () => {
                    if ($(field).val() !== '') {
                        $(button).show();
                    } else {
                        $(button).hide();
                    }
                });
            }
        </script>
    @endpush
</div>
