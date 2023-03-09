<div>
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Bible School - Lessons - Take Attendance') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Management Take Attendance') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Take Attendance') }}
    </x-slot>

    <x-slot name="user">
        {{ __('Lessons') }}
    </x-slot>

    <div class="row">
        <div class="col-6">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6><i class="fas fa-table text-primary"></i> {{ __('List of member take attendance') }}
                    </h6>
                </div>
                <div class="card-body">
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
                                        <td>{{ $memberTable->cellphone }}</td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            <x-app-config.button color="link text-success" icon="fas fa-user-check"
                                                class="btn-sm" wire:click="$emit('attendance', {{ $memberTable }})" />
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
        <div class="col-6">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6><i class="fas fa-table text-primary"></i> {{ __('List of member remove assistance') }}
                    </h6>
                </div>
                <div class="card-body">
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
                                @forelse ($membersLesson as $memberLessonTable)
                                    <tr>
                                        <td>{{ $memberLessonTable->id }}</td>
                                        <td>{{ $memberLessonTable->document_number }}</td>
                                        <td>{{ $memberLessonTable->name }} {{ $memberLessonTable->lastname }}</td>
                                        <td>{{ $memberLessonTable->cellphone }}</td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            <x-app-config.button color="link text-danger" icon="fas fa-user-times"
                                                class="btn-sm"
                                                wire:click="$emit('remove', {{ $memberLessonTable }})" />
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
                @if ($membersLesson->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $membersLesson->firstItem() !!} {{ __('to') }} {!! $membersLesson->lastItem() !!}
                            {{ __('of') }} {!! $membersLesson->total() !!} {{ __('entries') }}
                            {!! $membersLesson->links() !!}
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
            Livewire.on('attendance', member => {
                Swal.fire({
                    title: "{{ __('Are you sure you want to take attendance') }}",
                    toast: true,
                    text: `{{ __('There is no way back') }}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    position: 'top-end',
                    confirmButtonText: "{{ __('Yes, take attendance it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emit('takeAttendance', member.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Take attendance member') }}",
                            text: `{{ __('Attendance of ${member.name} taken correctly') }}`,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    }
                });
            });
            Livewire.on('remove', member => {
                Swal.fire({
                    title: "{{ __('Are you sure you want to remove attendance') }}",
                    toast: true,
                    text: `{{ __('There is no way back') }}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    position: 'top-end',
                    confirmButtonText: "{{ __('Yes, remove attendance it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emit('removeAttendance', member.id);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Remove attendance member') }}",
                            text: `{{ __('Attendance of ${member.name} remove correctly') }}`,
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
