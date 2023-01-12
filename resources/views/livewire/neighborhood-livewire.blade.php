<div>
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Neighborhood') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Management Neighborhood') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Neighborhood') }}
    </x-slot>

    <x-slot name="user">
        {{ Auth::user()->name }}
    </x-slot>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-header  text-center p-2">
                    <h6><i class="fas fa-map-marked-alt text-primary"></i>
                        {{ __('Create new sector') }}
                    </h6>
                </div>
                <div class="card-body">
                    <x-app-config.form submit="save">
                        <div class="form-group">
                            <x-app-config.label value="{{ __('Sector') }}" /> <br>
                            <div wire:ignore>
                                <select class="form-control select2bs4" id="selectSectorSave" style="width: 100%;">
                                    <option value="">{{ __('Choose') }}</option>
                                    @foreach ($sectors as $key => $sector)
                                        <option value="{{ $key }}">{{ $sector }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-app-config.label-error for="sector_id" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label value="Name" />
                            <x-app-config.input wire:model.defer="name" />
                            <x-app-config.label-error for="name" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label value="Description" />
                            <textarea class="form-control" rows="5" wire:model.defer="description"></textarea>
                            <x-app-config.label-error for="description" />
                        </div>
                        <div class="form-group">
                            <x-slot name="actions">
                                <div class="d-flex justify-content-between alingn-items-center">
                                    <x-app-config.button type="button" title="Reset" color="secondary"
                                        icon="fas fa-ban" wire:click="resetTo()" />
                                    @if ($btnAction == 'save')
                                        <x-app-config.button type="submit" title="Register" icon="fas fa-plus" />
                                    @else
                                        <x-app-config.button type="submit" title="Update" icon="fas fa-edit"
                                            color="info" />
                                    @endif
                                </div>
                            </x-slot>
                        </div>
                    </x-app-config.form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6><i class="fas fa-table text-primary"></i> {{ __('List of neighborhoods') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="card p-2">
                        <div class="row">
                            <div class="col-6">
                                <x-app-config.input placeholder="{{ __('Search by id, name') }}" wire:model.debounce.500ms="search" />
                            </div>
                            <div class="col-6">
                                <div wire:ignore>
                                    <select class="form-control select2bs4" id="selectSectorId" style="width: 100%">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach ($sectors as $key => $sector)
                                            <option value="{{ $key }}">{{ $sector }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    @foreach ($columns as $key => $column)
                                        @if ($key == 'id')
                                            <th class="align-middle" style="width: 8%; cursor: pointer;"
                                                wire:click="sortBy('{{ $key }}')">
                                                {{ __($column) }}
                                                @if ($sortColumn == $key)
                                                    @if ($sortDirection == 'asc')
                                                        <i class="fas fa-sort-numeric-up text-primary"></i>
                                                    @else
                                                        <i class="fas fa-sort-numeric-down-alt text-primary"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort text-primary"></i>
                                                @endif
                                            </th>
                                        @else
                                            <th style="width: 12%; cursor: pointer;"
                                                wire:click="sortBy('{{ $key }}')">
                                                {{ __($column) }}
                                                @if ($sortColumn == $key)
                                                    @if ($sortDirection == 'asc')
                                                        <i class="fas fa-sort-alpha-up text-primary"></i>
                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt text-primary"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort text-primary"></i>
                                                @endif
                                            </th>
                                        @endif
                                    @endforeach
                                    <th style="width: 10%" class="text-center">
                                        {{ __('Actions') }}
                                        <i class="fas fa-cogs text-primary"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($neighborhoods as $neighborhoodTable)
                                    <tr>
                                        <td>{{ $neighborhoodTable->id }}</td>
                                        <td>{{ $neighborhoodTable->name }}</td>
                                        <td>{{ $neighborhoodTable->created_at }}</td>
                                        <td>{{ $neighborhoodTable->sector->name }}</td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            <x-app-config.button color="outline-light text-danger" icon="fas fa-trash"
                                                class="btn-sm"
                                                wire:click="$emit('deleteNeighborhood', {{ $neighborhoodTable }})" />
                                            <x-app-config.button color="outline-light text-cyan" icon="fas fa-edit"
                                                class="btn-sm" wire:click="edit('{{ $neighborhoodTable->id }}')" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">{{ __('Not neighborhoods lists') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($neighborhoods->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $neighborhoods->firstItem() !!} {{ __('to') }} {!! $neighborhoods->lastItem() !!}
                            {{ __('of') }} {!! $neighborhoods->total() !!} {{ __('entries') }}
                            {!! $neighborhoods->links() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('js')
        <!-- Select2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('livewire:load', function() {
                //Initialize Select2 Elements
                // Filtered
                let select2 = $('#selectSectorId').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('sector_id_search', select2.select2("val"));
                });

                // Save
                let select2Save = $('#selectSectorSave').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('sector_id', select2Save.select2("val"));
                });
            })

            Livewire.on('clear-select', () => {
                $('#selectSectorSave').val('').trigger('change');
            });

            Livewire.on('selected-item', sector_id => {
                $('#selectSectorSave').val(sector_id).trigger('change');
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

            Livewire.on('deleteNeighborhood', neighborhood => {
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

                        Livewire.emit('delete', neighborhood.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Delete neighborhood') }}",
                            text: `{{ __('The neighborhood ${neighborhood.name} has been successfully removed') }}`,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    }
                });
            });
        </script>
    @endpush
</div>
