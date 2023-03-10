<div>
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Bible Schools - Enroll Member') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Enroll Members') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Enroll Members') }}
    </x-slot>

    <x-slot name="user">
        {{ __('Bible Schools') }}
    </x-slot>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-header  text-center p-2">
                    <h6><i class="fas fa-user-graduate text-primary"></i>
                        {{ __('Enroll new member') }}
                    </h6>
                </div>
                <div class="card-body">
                    <x-app-config.form submit="save">
                        <div class="form-group">
                            <div class="callout callout-info">
                                <h5>{{ __('Bible School:') }} <strong>{{ $bibleSchool->name }}</strong></h5>
                                <p class="font-italic">{{ $bibleSchool->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small>{{ __('Teacher:') }}
                                        <strong>{{ $bibleSchool->teacher->full_name }}</strong></small>
                                    <small>{{ __('Create At:') }}
                                        <strong>{{ $bibleSchool->created_at->format('Y-m-d') }}</strong></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <x-app-config.label value="{{ __('Members') }}" /> <br>
                            <div wire:ignore>
                                <select class="form-control select2bs4" id="selectMemberSearch" style="width: 100%;">
                                    <option value="">{{ __('Choose') }}</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-app-config.label-error for="member_id" />
                        </div>
                        <x-app-config.button class="btn-block" type="sumit" title="Enrolle"
                            icon="fas fa-user-graduate text-primary" color="default" />
                    </x-app-config.form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6><i class="fas fa-table text-primary"></i> {{ __('List of members') }}
                    </h6>
                </div>
                <div class="card-body mb-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <x-app-config.input placeholder="{{ __('Search') }}"
                                    wire:model.debounce.500ms="search" />
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
                                    ])
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($membersCourse as $memberTable)
                                    <tr>
                                        <td class="align-middle">{{ $memberTable->id }}</td>
                                        <td class="align-middle">{{ $memberTable->document_number }}</td>
                                        <td class="align-middle">{{ $memberTable->name }} {{ $memberTable->lastname }}</td>
                                        <td class="align-middle">{{ $memberTable->cellphone }}</td>
                                        <td class="text-center align-middle">
                                            @if ($memberTable->pivot->progress == 'Inscrito')
                                                <span
                                                    class="badge badge-info">{{ $memberTable->pivot->progress }}</span>
                                            @elseif ($memberTable->pivot->progress == 'En curso')
                                                <span
                                                    class="badge badge-warning">{{ $memberTable->pivot->progress }}</span>
                                            @else
                                                <span
                                                    class="badge badge-success">{{ $memberTable->pivot->progress }}</span>
                                            @endif
                                        </td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            <div class="btn-group">
                                                @if ($memberTable->pivot->progress == 'Inscrito')
                                                    <x-app-config.button color="link text-warning" icon="fas fa-spinner"
                                                        class="btn-sm"
                                                        wire:click="$emit('changeProgressMember', {{ $memberTable }}, 'En curso')" />
                                                    <x-app-config.button color="link text-success" icon="fas fa-tasks"
                                                        class="btn-sm"
                                                        wire:click="$emit('changeProgressMember', {{ $memberTable }}, 'Finalizado')" />
                                                @elseif ($memberTable->pivot->progress == 'En curso')
                                                    <x-app-config.button color="link text-primary"
                                                        icon="fas fa-user-graduate" class="btn-sm"
                                                        wire:click="$emit('changeProgressMember', {{ $memberTable }}, 'Inscrito')" />
                                                    <x-app-config.button color="link text-success" icon="fas fa-tasks"
                                                        class="btn-sm"
                                                        wire:click="$emit('changeProgressMember', {{ $memberTable }}, 'Finalizado')" />
                                                @else
                                                    <x-app-config.button color="link text-warning" icon="fas fa-spinner"
                                                        class="btn-sm"
                                                        wire:click="$emit('changeProgressMember', {{ $memberTable }}, 'En curso')" />
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('Not members lists') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($membersCourse->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $membersCourse->firstItem() !!} {{ __('to') }} {!! $membersCourse->lastItem() !!}
                            {{ __('of') }} {!! $membersCourse->total() !!} {{ __('entries') }}
                            {!! $membersCourse->links() !!}
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

                $('.lastName').hide();

                let selectMember = $('#selectMemberSearch').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('member_id', selectMember.select2("val"));
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

            Livewire.on('clear-select', () => {
                $('#selectMemberSearch').val('').trigger('change');
            });

            Livewire.on('changeProgressMember', (member, progress) => {
                Swal.fire({
                    title: "{{ __('Are you sure you want to change progress') }}",
                    toast: true,
                    text: `{{ __('There is no way back') }}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    position: 'top-end',
                    confirmButtonText: "{{ __('Yes, go ahead!') }}",
                    cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emit('changeProgress', member.id, progress);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Change the progress of member') }}",
                            text: `{{ __('Successfully changed member progress') }} ${member.full_name} `,
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
