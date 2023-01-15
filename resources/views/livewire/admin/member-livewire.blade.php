<div>
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Members') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Management Members') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Members') }}
    </x-slot>

    <x-slot name="user">
        {{ Auth::user()->name }}
    </x-slot>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6><i class="fas fa-table text-primary"></i> {{ __('List of members') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <x-app-config.input placeholder="{{ __('Nam, last, doc, ema, addre, pho and cellp') }}"
                                    wire:model.debounce.500ms="search" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div wire:ignore>
                                <select class="form-control select2bs4" id="selectNeighborhoodId" style="width: 100%">
                                    <option value="">{{ __('Choose') }}</option>
                                    @foreach ($neighborhoods as $key => $neighborhood)
                                        <option value="{{ $key }}">{{ $neighborhood }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <select class="custom-select" wire:model="document_type_search">
                                    <option value="">{{ __('Document type') }}</option>
                                    <option value="Registro civil">{{ __('Registro civil') }}</option>
                                    <option value="Tarjeta de identidad">{{ __('Tarjeta de identidad') }}</option>
                                    <option value="Cédula de ciudanía">{{ __('Cédula de ciudanía') }}</option>
                                    <option value="Tarjeta de extranjería">{{ __('Tarjeta de extranjería') }}
                                    </option>
                                    <option value="Pasaporte">{{ __('Pasaporte') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select class="custom-select" wire:model="sex_search">
                                    <option value="">{{ __('Sex') }}</option>
                                    <option value="Femenino">{{ __('Femenino') }}</option>
                                    <option value="Masculino">{{ __('Masculino') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select class="custom-select" wire:model="civil_state_search">
                                    <option value="">{{ __('Civil state') }}</option>
                                    <option value="Soltero">{{ __('Soltero') }}</option>
                                    <option value="Casado">{{ __('Casado') }}</option>
                                    <option value="Conviviente civil">{{ __('Conviviente civil') }}</option>
                                    <option value="Divorciado">{{ __('Divorciado') }}</option>
                                    <option value="Viudo">{{ __('Viudo') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select class="custom-select" wire:model="is_baptized_search">
                                    <option value="">{{ __('Baptized') }}</option>
                                    <option value="Si">{{ __('Si') }}</option>
                                    <option value="No">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="date" class="form-control" wire:model="from">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="date" class="form-control" wire:model="to">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    @include('partials.columns-table', [
                                        'percentage' => [
                                            'id' => '8%',
                                            'column' => '10%',
                                            'action' => '15%',
                                        ],
                                    ])
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($members as $memberTable)
                                    <tr>
                                        <td>{{ $memberTable->id }}</td>
                                        <td>{{ $memberTable->document_number }}</td>
                                        <td>{{ $memberTable->name }} {{ $memberTable->lastname }}</td>
                                        <td>{{ $memberTable->is_baptized }}</td>
                                        <td>{{ $memberTable->neighborhood->name }}</td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            <x-app-config.button title="Delete" color="outline-light text-danger"
                                                icon="fas fa-trash" class="btn-sm" {{-- wire:click="$emit('deleteNeighborhood', {{ $memberTable }})" --}} />
                                            <x-app-config.button title="Edit" color="outline-light text-cyan"
                                                icon="fas fa-edit" class="btn-sm" {{-- wire:click="edit('{{ $memberTable->id }}')" --}} />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">{{ __('Not members lists') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($members->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $members->firstItem() !!} {{ __('to') }} {!! $members->lastItem() !!}
                            {{ __('of') }} {!! $members->total() !!} {{ __('entries') }}
                            {!! $members->links() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @push('js')
            <!-- Select2 -->
            <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
            <!-- SweetAlert2 -->
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('livewire:load', function() {

                    /* $('#btnResetNeighborhood').hide();

                    hideShowBtn('input', '#idNameNeighborhood', '#btnResetNeighborhood');
                    hideShowBtn('input', '#idDescriptionNeighborhood', '#btnResetNeighborhood');
                    hideShowBtn('change', '#selectSectorSave', '#btnResetNeighborhood'); */

                    //Initialize Select2 Elements
                    // Filtered
                    let select2 = $('#selectNeighborhoodId').select2({
                        theme: 'bootstrap4'
                    }).on('change', () => {
                        @this.set('neighborhood_id_serach', select2.select2("val"));
                    });

                    // Save
                    /* let select2Save = $('#selectSectorSave').select2({
                        theme: 'bootstrap4'
                    }).on('change', () => {
                        @this.set('sector_id', select2Save.select2("val"));
                    }); */
                });

                /* Livewire.on('clear-select', () => {
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

                function hideShowBtn(event, field, button) {
                    $(field).on(event, () => {
                        if ($(field).val() !== '') {
                            $(button).show();
                        } else {
                            $(button).hide();
                        }
                    });
                } */
            </script>
        @endpush
    </div>
