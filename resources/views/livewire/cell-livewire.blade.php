<div>
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Cells') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Management Cells') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Cells') }}
    </x-slot>

    <x-slot name="user">
        {{ Auth::user()->name }}
    </x-slot>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-header  text-center p-2">
                    <h6><i class="fas fa-map-marked-alt text-primary"></i>
                        {{ __('Create new cells') }}
                    </h6>
                </div>
                <div class="card-body">
                    <x-app-config.form submit="save">
                        <div class="form-group">
                            <x-app-config.label value="{{ __('Neighborhood') }}" /> <br>
                            <div wire:ignore>
                                <select class="form-control select2bs4" id="selectNeighborhoodSave"
                                    style="width: 100%;">
                                    <option value="">{{ __('Choose') }}</option>
                                    @foreach ($neighborhoods as $key => $neighborhood)
                                        <option value="{{ $key }}">{{ $neighborhood }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-app-config.label-error for="neighborhood_id" />
                        </div>
                        @if (count($leaders) > 0)
                            <div class="form-group">
                                <x-app-config.label value="{{ __('Neighborhood') }}" /> <br>
                                <div wire:ignore>
                                    <select class="form-control select2bs4" id="selectLeaderSave" style="width: 100%;">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach ($leaders as $key => $leader)
                                            <option value="{{ $key }}">{{ $leader }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-app-config.label-error for="neighborhood_id" />
                            </div>
                        @endif
                        <div class="form-group">
                            <x-app-config.label value="Name" />
                            <x-app-config.input wire:model.defer="name" id="idNameCell" />
                            <x-app-config.label-error for="name" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label value="Description" />
                            <textarea class="form-control" rows="5" wire:model.defer="description" id="idDescriptionCell"></textarea>
                            <x-app-config.label-error for="description" />
                        </div>
                        <div class="form-group">
                            <x-slot name="actions">
                                <div class="d-flex justify-content-between alingn-items-center">
                                    <div wire:ignore>
                                        <x-app-config.button type="button" title="Reset" color="secondary"
                                            icon="fas fa-ban" wire:click="resetTo()" id="btnResetCell" />
                                    </div>
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
                    <h6><i class="fas fa-table text-primary"></i> {{ __('List of cells') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="card p-2">
                        <div class="row">
                            <div class="col-6">
                                <x-app-config.input placeholder="{{ __('Search by id, name') }}"
                                    wire:model.debounce.500ms="search" />
                            </div>
                            <div class="col-6">
                                <div wire:ignore>
                                    <select class="form-control select2bs4" id="selectCellId" style="width: 100%">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach ($neighborhoods as $key => $neighborhood)
                                            <option value="{{ $key }}">{{ $neighborhood }}</option>
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
                                @forelse ($cells as $cellTable)
                                    <tr>
                                        <td>{{ $cellTable->id }}</td>
                                        <td>{{ $cellTable->name }}</td>
                                        <td>{{ $cellTable->created_at }}</td>
                                        <td>{{ $cellTable->neighborhood->name }}</td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            <x-app-config.button color="outline-light text-danger" icon="fas fa-trash"
                                                class="btn-sm" wire:click="$emit('deleteCell', {{ $cellTable }})" />
                                            <x-app-config.button color="outline-light text-cyan" icon="fas fa-edit"
                                                class="btn-sm" wire:click="edit('{{ $cellTable->id }}')" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('Not cells lists') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($cells->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $cells->firstItem() !!} {{ __('to') }} {!! $cells->lastItem() !!}
                            {{ __('of') }} {!! $cells->total() !!} {{ __('entries') }}
                            {!! $cells->links() !!}
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

                // Hide - Show btn
                $('#btnResetCell').hide();
                hideShowBtn('input', '#idNameCell', '#btnResetCell');
                hideShowBtn('input', '#idDescriptionCell', '#btnResetCell');
                hideShowBtn('change', '#selectNeighborhoodSave', '#btnResetCell');

                //Initialize Select2 Elements
                // Filtered
                let select2 = $('#selectCellId').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('neighborhood_id_serach', select2.select2("val"));
                });

                // Save
                let select2NeighborhoodSave = $('#selectNeighborhoodSave').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('neighborhood_id', select2NeighborhoodSave.select2("val"));
                });

                let select2LeaderSave = $('#selectLeaderSave').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('leader_id', select2LeaderSave.select2("val"));
                });
            })

            Livewire.on('clear-select', () => {
                $('#selectNeighborhoodSave').val('').trigger('change');
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

            Livewire.on('selected-item', neighborhood_id => {
                $('#selectNeighborhoodSave').val(neighborhood_id).trigger('change');
            });

            Livewire.on('deleteCell', cell => {
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

                        Livewire.emit('delete', cell.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Delete cell') }}",
                            text: `{{ __('The cell ${cell.name} has been successfully removed') }}`,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    }
                });
            });

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
