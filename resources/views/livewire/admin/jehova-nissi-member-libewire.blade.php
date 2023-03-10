<div>
    <x-slot name="title">
        {{ __('Members - Jehova Nissi') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Members Jehova Nissi') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Jehova Nissi') }}
    </x-slot>

    <x-slot name="user">
        {{ __('Members') }}
    </x-slot>

    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h6 class=""><i class="fas fa-table text-primary"></i>
                    {{ __('List of members jehova nissi') }}
                </h6>
            </div>
            <div class="card-body mb-0">
                <div class="card pt-3 px-3">
                    <h6><i class="fas fa-search text-primary"></i>
                        <strong>{{ __('Filters Advanced') }}</strong>
                    </h6>
                    <hr class="mt-0">

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                            <div class="form-group">
                                <x-app-config.input
                                    placeholder="{{ __('Search') }}"
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
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                            <div class="form-group">
                                <select class="custom-select" wire:model="type_red_search">
                                    <option value="">{{ __('Choosen type red') }}</option>
                                    <option value="children">{{ __('Children') }}</option>
                                    <option value="teenagers">{{ __('Teenagers') }}</option>
                                    <option value="youths">{{ __('Youths') }}</option>
                                    <option value="adults">{{ __('Adults') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                            <div class="form-group">
                                <select class="custom-select" wire:model="document_type_search">
                                    <option value="">{{ __('Document Type') }}</option>
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
                                    <option value="">{{ __('Civil State') }}</option>
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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @include('partials.columns-table', [
                                    'percentage' => [
                                        'id' => '5%',
                                        'column' => '12%',
                                        'action' => '8%',
                                    ],
                                    'actionShow' => true,
                                ])
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $memberTable)
                                @if ((int) $memberTable->age >= $this->rangeFrom && (int) $memberTable->age <= $this->rangeTo)
                                    <tr>
                                        <td class="align-middle">{{ $memberTable->id }}</td>
                                        <td class="align-middle">{{ $memberTable->document_number }}</td>
                                        <td class="align-middle">{{ $memberTable->name }} {{ $memberTable->lastname }}
                                        </td>
                                        <td class="align-middle">{{ $memberTable->email }}</td>
                                        <td class="align-middle">{{ $memberTable->cellphone }}</td>
                                        <td class="align-middle">{{ $memberTable->is_baptized }}</td>
                                        <td class="align-middle">{{ $memberTable->neighborhood->name }}</td>
                                        <td class="align-middle">{{ $memberTable->age }}</td>
                                    </tr>
                                @else
                                    @if ($this->rangeFrom == 0 && $this->rangeTo == 0)
                                        <tr>
                                            <td class="align-middle">{{ $memberTable->id }}</td>
                                            <td class="align-middle">{{ $memberTable->document_number }}</td>
                                            <td class="align-middle">{{ $memberTable->name }}
                                                {{ $memberTable->lastname }}
                                            </td>
                                            <td class="align-middle">{{ $memberTable->email }}</td>
                                            <td class="align-middle">{{ $memberTable->cellphone }}</td>
                                            <td class="align-middle">{{ $memberTable->is_baptized }}</td>
                                            <td class="align-middle">{{ $memberTable->neighborhood->name }}</td>
                                            <td class="align-middle">{{ $memberTable->age }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">{{ __('Not members lists') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($members->hasPages())
                <div class="card-footer bg-white mt-0">
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
            });
        </script>
    @endpush
</div>
