<div>
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Bible School') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Management Bible School') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Bible School') }}
    </x-slot>

    <x-slot name="user">
        {{ Auth::user()->name }}
    </x-slot>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-header  text-center p-2">
                    <h6><i class="fas fa-school text-primary"></i>
                        {{ __('Create new bible school') }}
                    </h6>
                </div>
                <div class="card-body">
                    <x-app-config.form submit="save">
                        <div class="form-group">
                            <x-app-config.label value="{{ __('Teacher') }}" /> <br>
                            <div wire:ignore>
                                <select class="form-control select2bs4" id="selectTeacherSave" style="width: 100%;">
                                    <option value="">{{ __('Choose') }}</option>
                                    @foreach ($teachers as $key => $teacher)
                                        <option value="{{ $key }}">{{ $teacher }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-app-config.label-error for="sector_id" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label value="Name" />
                            <x-app-config.input wire:model.defer="name" id="idNameBibleSchool" />
                            <x-app-config.label-error for="name" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label value="Description" />
                            <textarea class="form-control" rows="5" wire:model.defer="description" id="idDescriptionBibleSchool"></textarea>
                            <x-app-config.label-error for="description" />
                        </div>
                        <div class="form-group">
                            <x-slot name="actions">
                                @include('partials.actions', ['idButtonReset' => 'BibleSchool'])
                            </x-slot>
                        </div>
                    </x-app-config.form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6><i class="fas fa-table text-primary"></i> {{ __('List of bibles schools') }}
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
                                    <select class="form-control select2bs4" id="selectTeacherSearch"
                                        style="width: 100%">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach ($teachers as $key => $teacher)
                                            <option value="{{ $key }}">{{ $teacher }}</option>
                                        @endforeach
                                    </select>
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
                                            'id' => '8%',
                                            'column' => '11%',
                                            'action' => '12%',
                                        ],
                                    ])
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($biblesSchools as $biblesSchoolTable)
                                    <tr>
                                        <td>{{ $biblesSchoolTable->id }}</td>
                                        <td>{{ $biblesSchoolTable->name }}</td>
                                        <td>{{ $biblesSchoolTable->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $biblesSchoolTable->teacher->name ?? __('Not teacher asigned') }}</td>
                                        <td class="text-center align-middle">
                                            <span
                                                class="badge badge-{{ $biblesSchoolTable->state == 'Activo' ? 'success' : 'danger' }}">{{ $biblesSchoolTable->state }}</span>
                                        </td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            @if ($biblesSchoolTable->state == 'Activo')
                                                <x-app-config.button color="link text-danger" icon="fas fa-power-off"
                                                    class="btn-sm"
                                                    wire:click="$emit('changeStateBiblesSchool', {{ $biblesSchoolTable }})" />
                                            @else
                                                <x-app-config.button color="link text-success" icon="fas fa-power-off"
                                                    class="btn-sm"
                                                    wire:click="$emit('changeStateBiblesSchool', {{ $biblesSchoolTable }})" />
                                            @endif
                                            {{-- <x-app-config.button color="link text-danger"
                                                icon="fas fa-trash" class="btn-sm" wire:click="$emit('deleteBiblesSchool', {{ $biblesSchoolTable }})" /> --}}
                                            <x-app-config.button color="link text-cyan" icon="fas fa-edit"
                                                class="btn-sm" wire:click="edit('{{ $biblesSchoolTable->id }}')" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('Not bible schools lists') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($biblesSchools->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $biblesSchools->firstItem() !!} {{ __('to') }}
                            {!! $biblesSchools->lastItem() !!}
                            {{ __('of') }} {!! $biblesSchools->total() !!} {{ __('entries') }}
                            {!! $biblesSchools->links() !!}
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

                $('#btnResetBibleSchool').hide();

                hideShowBtn('input', '#idNameBibleSchool', '#btnResetBibleSchool');
                hideShowBtn('input', '#idDescriptionBibleSchool', '#btnResetBibleSchool');
                hideShowBtn('change', '#selectTeacherSave', '#btnResetBibleSchool');

                //Initialize Select2 Elements
                // Filtered
                let select2 = $('#selectTeacherSearch').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('teacher_id_search', select2.select2("val"));
                });

                // Save
                let select2Save = $('#selectTeacherSave').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('teacher_id', select2Save.select2("val"));
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

            /* Livewire.on('show-btn', () => $('#btnResetBibleSchool').show());

            Livewire.on('hide-btn', () => $('#btnResetBibleSchool').hide()); */

            Livewire.on('clear-select', () => {
                $('#selectTeacherSave').val('').trigger('change');
            });

            Livewire.on('selected-item', teacher_id => {
                $('#selectTeacherSave').val(teacher_id).trigger('change');
            });

            Livewire.on('changeStateBiblesSchool', bibleSchool => {
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

                        Livewire.emit('changeState', bibleSchool.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Change state bible school') }}",
                            text: `{{ __('The state of the bible school ${bibleSchool.name} was successfully updated') }}`,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    }
                });
            });

            /* Livewire.on('deleteBiblesSchool', bibleSchool => {
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

                        Livewire.emit('delete', bibleSchool.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Delete bibleSchool') }}",
                            text: `{{ __('The bibleSchool ${bibleSchool.name} has been successfully removed') }}`,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    }
                });
            }); */

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
