<div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <style>
            .btn-circle.btn-xl {
                width: 60px;
                height: 60px;
                padding: 13px 18px;
                border-radius: 80px;
                font-size: 15px;
                text-align: center;
            }

            .display-none {
                display: none;
            }
        </style>
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
        {{ __('Members') }}
    </x-slot>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
            <div class="card card-outline card-primary">
                <div class="card-header  text-center p-2">
                    <h6><i class="fas fa-user-friends text-primary"></i>
                        {{ __('Create new member') }}
                    </h6>
                </div>
                <div class="card-body">
                    <x-app-config.form submit="save">
                        <div class="text-center ">
                            <a class="btn {{ $step == 1 ? 'btn-primary' : 'btn-default' }} btn-circle btn-xl mr-4"
                                wire:click="changeStep('1')">
                                <h4>1</h4>
                            </a>
                            <a class="btn {{ $step == 2 ? 'btn-primary' : 'btn-default' }} btn-circle btn-xl"
                                wire:click="changeStep('2')">
                                <h4>2</h4>
                            </a>
                            <a class="btn {{ $step == 3 ? 'btn-primary' : 'btn-default' }} btn-circle btn-xl ml-4"
                                wire:click="changeStep('3')">
                                <h4>3</h4>
                            </a>
                        </div>

                        <hr>

                        <div class="step-1 mt-2 {{ $step != 1 ? 'display-none' : '' }}">
                            <div class="form-group text-center">
                                <h5><strong>{{ __('Personal Information') }}</strong></h5>
                            </div>
                            <div class="form-group">
                                <x-app-config.label for="idNameMember" value="Names" />
                                <x-app-config.input wire:model.defer="name" id="idNameMember" autofocus="autofocus" />
                                <x-app-config.label-error for="name" />
                            </div>
                            <div class="form-group">
                                <x-app-config.label for="idLastnameMember" value="Lastnames" />
                                <x-app-config.input wire:model.defer="lastname" id="idLastnameMember" />
                                <x-app-config.label-error for="lastname" />
                            </div>
                            <div class="form-group">
                                <x-app-config.label for="idEmailMember" value="Email" />
                                <x-app-config.input wire:model.defer="email" id="idEmailMember" />
                                <x-app-config.label-error for="email" />
                            </div>
                            <div class="form-group">
                                <x-app-config.label for="idDocumentTypeMember" value="Document type" />
                                <select class="custom-select" id="idDocumentTypeMember"
                                    wire:model.defer="document_type">
                                    <option value="">{{ __('Choosen') }}</option>
                                    <option value="Registro civil">{{ __('Registro civil') }}</option>
                                    <option value="Tarjeta de identidad">{{ __('Tarjeta de identidad') }}
                                    </option>
                                    <option value="Cédula de ciudanía">{{ __('Cédula de ciudanía') }}</option>
                                    <option value="Tarjeta de extranjería">{{ __('Tarjeta de extranjería') }}
                                    </option>
                                    <option value="Pasaporte">{{ __('Pasaporte') }}</option>
                                </select>
                                <x-app-config.label-error for="document_type" />
                            </div>
                            <div class="form-group">
                                <x-app-config.label for="idDocumentNumberMember" value="Document number" />
                                <x-app-config.input wire:model.defer="document_number" id="idDocumentNumberMember" />
                                <x-app-config.label-error for="document_number" />
                            </div>
                        </div>

                        <div class="step-2 {{ $step != 2 ? 'display-none' : '' }}">
                            <div class="form-group">
                                <x-app-config.label for="idDateMember" value="Date of birth" />
                                <input type="date" class="form-control" wire:model.defer="date_of_birth"
                                    id="idDateMember">
                                <x-app-config.label-error for="date_of_birth" />
                            </div>
                            <div class="form-group clearfix">
                                <x-app-config.label value="Sex" />
                                <br>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="radio" id="idSexFemaleMember" wire:model="sex" value="Femenino">
                                    <x-app-config.label for="idSexFemaleMember" value="Female" />
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="idSexMaleMember" wire:model="sex" value="Masculino">
                                    <x-app-config.label for="idSexMaleMember" value="Male" />
                                </div>
                            </div>
                            <div class="form-group">
                                <x-app-config.label for="idCivilStateMember" value="{{ __('Civil state') }}" />
                                <select class="custom-select" id="idCivilStateMember" wire:model="civil_state">
                                    <option value="">{{ __('Choosen') }}</option>
                                    <option value="Soltero">{{ __('Soltero') }}</option>
                                    <option value="Casado">{{ __('Casado') }}
                                    </option>
                                    <option value="Conviviente civil">{{ __('Conviviente civil') }}</option>
                                    <option value="Divorciado">{{ __('Divorciado') }}
                                    </option>
                                    <option value="Viudo">{{ __('Viudo') }}</option>
                                </select>
                                <x-app-config.label-error for="civil_state" />
                            </div>
                            <div class="form-group text-center">
                                <h5><strong>{{ __('Contact information') }}</strong></h5>
                            </div>
                            <div class="form-group">
                                <x-app-config.label for="idAddressMember" value="Address" />
                                <x-app-config.input wire:model.defer="address" id="idAddressMember" />
                                <x-app-config.label-error for="address" />
                            </div>
                            <div class="form-group">
                                <x-app-config.label value="Neighborhood" /> <br>
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
                                </select>
                            </div>
                        </div>

                        <div class="step-3 {{ $step != 3 ? 'display-none' : '' }}">
                            <div class="form-group">
                                <x-app-config.label for="idPhoneMember" value="Phone" />
                                <x-app-config.input wire:model.defer="phone" id="idPhoneMember" />
                                <x-app-config.label-error for="phone" />
                            </div>
                            <div class="form-group">
                                <x-app-config.label for="idCellPhoneMember" value="Cellphone" />
                                <x-app-config.input wire:model.defer="cellphone" id="idCellPhoneMember" />
                                <x-app-config.label-error for="cellphone" />
                            </div>

                            <div class="form-group">
                                <x-app-config.label value="Cell" /> <br>
                                <div wire:ignore>
                                    <select class="form-control select2bs4" id="selectCellSave" style="width: 100%;">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach ($cells as $key => $cell)
                                            <option value="{{ $key }}">{{ $cell }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-app-config.label-error for="cell_id" />
                                </select>
                            </div>

                            <div class="form-group text-center">
                                <h5><strong>{{ __('Ecclesiastical information') }}</strong></h5>
                            </div>
                            <div class="form-group clearfix">
                                <x-app-config.label value="{{ __('Baptized') }}" />
                                <br>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="radio" id="idIsBaptizedNotMember" wire:model="is_baptized"
                                        value="No">
                                    <x-app-config.label for="idIsBaptizedNotMember" value="Not" />
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="idIsBaptizedYesMember" wire:model="is_baptized"
                                        value="Si">
                                    <x-app-config.label for="idIsBaptizedYesMember" value="Yes" />
                                </div>
                                <x-app-config.label-error for="is_baptized" />
                            </div>
                            <br>
                            @if (count($biblesSchols))
                                <div class="form-group clearfix">
                                    <label>{{ __('Bible schools') }}</label>
                                    <br>
                                    <div class="card p-2">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="allSchool" wire:model="all_school">
                                            <label for="allSchool">
                                                {{ __('All schools') }}
                                            </label>
                                        </div>
                                        <br>

                                        <div class="row">
                                            @foreach ($biblesSchols as $key => $bibleScholCheck)
                                                <div class="col-6">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" id="{{ $key }}"
                                                            wire:model="bibles_schools" value="{{ $key }}">
                                                        <label for="{{ $key }}">
                                                            {{ $bibleScholCheck }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($step == 1)
                            <a wire:click="changeStep('2')" class="btn btn-default btn-flat">{{ __('Next') }} <i
                                    class="fas fa-long-arrow-alt-right text-primary"></i></a>
                        @elseif($step == 2)
                            <a wire:click="changeStep('1')" class="btn btn-default btn-flat"><i
                                    class="fas fa-long-arrow-alt-left text-danger"></i> {{ __('Previous') }}</a>
                            <a wire:click="changeStep('3')" class="btn btn-default btn-flat">{{ __('Next') }} <i
                                    class="fas fa-long-arrow-alt-right text-primary"></i></a>
                        @else
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a wire:click="changeStep('2')" class="btn btn-default btn-flat"><i
                                            class="fas fa-long-arrow-alt-left text-danger"></i>
                                        {{ __('Previous') }}</a>
                                </div>
                                <div>
                                    <x-app-config.button type="button" title="Reset" color="default"
                                        icon="far fa-minus-square text-orange" wire:click="resetTo()"
                                        id="btnReset" />
                                    @if ($btnAction == 'save')
                                        <x-app-config.button type="sumit" title="Register"
                                            icon="fas fa-save text-indigo" color="default" />
                                    @else
                                        <x-app-config.button type="sumit" title="Update"
                                            icon="fas fa-save text-indigo" color="default" />
                                    @endif
                                </div>
                            </div>
                        @endif
                    </x-app-config.form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
            <div class="card card-outline card-primary">
                <div class="card-header p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mt-2 ml-2"><i class="fas fa-table text-primary"></i>
                                {{ __('List of members') }}
                            </h6>
                        </div>
                        @if (!$actionFilters)
                            <a style="cursor: pointer" wire:click="$set('actionFilters', true)"
                                class="btn btn-default btn-sm btn-flat">{{ __('Show Filters Advanced') }} <i
                                    class="fas fa-eye text-primary"></i></a>
                        @else
                            <a style="cursor: pointer" wire:click="$set('actionFilters', false)"
                                class="btn btn-default btn-sm btn-flat">{{ __('Hide Filters Advanced') }} <i
                                    class="fas fa-eye-slash text-danger"></i></a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
                            <div class="form-group">
                                <x-app-config.input placeholder="{{ __('Search') }}"
                                    wire:model.debounce.500ms="search" />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                            <div class="form-group">
                                <div wire:ignore>
                                    <select class="custom-select select2bs4" id="selectNeighborhoodId"
                                        style="width: 100%">
                                        <option value="">{{ __('Choose by neighborhood') }}</option>
                                        @foreach ($neighborhoods as $key => $neighborhood)
                                            <option value="{{ $key }}">{{ $neighborhood }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($actionFilters)
                        <div class="card pt-3 px-3">
                            <h6><i class="fas fa-search text-primary"></i>
                                <strong>{{ __('Filters Advanced') }}</strong>
                            </h6>
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="form-group">
                                        <select class="custom-select" wire:model="document_type_search">
                                            <option value="">{{ __('Document type') }}</option>
                                            <option value="Registro civil">{{ __('Registro civil') }}</option>
                                            <option value="Tarjeta de identidad">{{ __('Tarjeta de identidad') }}
                                            </option>
                                            <option value="Cédula de ciudanía">{{ __('Cédula de ciudanía') }}
                                            </option>
                                            <option value="Tarjeta de extranjería">
                                                {{ __('Tarjeta de extranjería') }}
                                            </option>
                                            <option value="Pasaporte">{{ __('Pasaporte') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="form-group">
                                        <select class="custom-select" wire:model="sex_search">
                                            <option value="">{{ __('Sex') }}</option>
                                            <option value="Femenino">{{ __('Femenino') }}</option>
                                            <option value="Masculino">{{ __('Masculino') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="form-group">
                                        <select class="custom-select" wire:model="civil_state_search">
                                            <option value="">{{ __('Civil state') }}</option>
                                            <option value="Soltero">{{ __('Soltero') }}</option>
                                            <option value="Casado">{{ __('Casado') }}</option>
                                            <option value="Conviviente civil">{{ __('Conviviente civil') }}
                                            </option>
                                            <option value="Divorciado">{{ __('Divorciado') }}</option>
                                            <option value="Viudo">{{ __('Viudo') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
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
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <input type="date" class="form-control" wire:model="from">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <input type="date" class="form-control" wire:model="to">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                        <td>{{ $memberTable->neighborhood->name }}</td>
                                        <td class="text-center align-middle">
                                            <span
                                                class="badge badge-{{ $memberTable->state == 'Activo' ? 'success' : 'danger' }}">{{ $memberTable->state }}</span>
                                        </td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            @if ($memberTable->state == 'Activo')
                                                <x-app-config.button color="link text-danger" icon="fas fa-power-off"
                                                    class="btn-sm"
                                                    wire:click="$emit('changeStateMember', {{ $memberTable }})" />
                                            @else
                                                <x-app-config.button color="link text-success" icon="fas fa-power-off"
                                                    class="btn-sm"
                                                    wire:click="$emit('changeStateMember', {{ $memberTable }})" />
                                            @endif
                                            {{-- <x-app-config.button color="link text-danger" icon="fas fa-trash"
                                                class="btn-sm"
                                                wire:click="$emit('deleteMember', {{ $memberTable }})" /> --}}
                                            <x-app-config.button color="link text-cyan" icon="fas fa-edit"
                                                class="btn-sm" wire:click="edit('{{ $memberTable->id }}')" />
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
    </div>

    @push('js')
        <!-- SweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('livewire:load', function() {

                //Initialize Select2 Elements
                // Filtered
                let select2 = $('#selectNeighborhoodId').select2({
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

                let select2CellSave = $('#selectCellSave').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    console.log(select2CellSave.select2("val"));
                    @this.set('cell_id', select2CellSave.select2("val"));
                });
            });

            Livewire.on('clear-select', () => {
                $('#selectNeighborhoodSave').val('').trigger('change');
                $('#selectCellSave').val('').trigger('change');
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

            Livewire.on('selected-item', (neighborhood_id, cell_id) => {
                $('#selectNeighborhoodSave').val(neighborhood_id).trigger('change');
                $('#selectCellSave').val(cell_id).trigger('change');
            });

            /* Livewire.on('deleteMember', member => {
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

                        Livewire.emit('delete', member.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Delete member') }}",
                            text: `{{ __('The member ${member.name} has been successfully removed') }}`,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    }
                });
            }); */

            Livewire.on('changeStateMember', member => {
                Swal.fire({
                    title: "{{ __('Are you sure you want to state') }}",
                    toast: true,
                    text: `{{ __('There is no way back') }}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    position: 'top-end',
                    confirmButtonText: "{{ __('Yes, state it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emit('changeState', member.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Change state member') }}",
                            text: `{{ __('The member ${member.name} has been successfully change') }}`,
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
