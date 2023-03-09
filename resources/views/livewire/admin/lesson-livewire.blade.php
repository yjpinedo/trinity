<div>
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Bible School - Lessons') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Management Lessons') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Lessons') }}
    </x-slot>

    <x-slot name="user">
        {{ __('Bible School') }}
    </x-slot>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-header  text-center p-2">
                    <h6><i class="fas fa-school text-primary"></i>
                        {{ __('Create new lesson') }}
                    </h6>
                </div>
                <div class="card-body">
                    <x-app-config.form submit="save">
                        <div class="form-group">
                            <x-app-config.label for="idNameLesson" value="Name" />
                            <x-app-config.input wire:model.defer="name" id="idNameLesson" autofocus="autofocus" />
                            <x-app-config.label-error for="name" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label for="idDateLesson" value="Date Lesson" />
                            <input type="date" class="form-control" wire:model.defer="lesson_date" id="idDateLesson">
                            <x-app-config.label-error for="lesson_date" />
                        </div>
                        <div class="form-group">
                            <x-app-config.label for="idDescriptionLesson" value="Description" />
                            <textarea class="form-control" rows="5" wire:model.defer="description" id="idDescriptionLesson"></textarea>
                            <x-app-config.label-error for="description" />
                        </div>
                        <div class="form-group">
                            <x-slot name="actions">
                                @include('partials.actions', ['idButtonReset' => 'Lesson'])
                            </x-slot>
                        </div>
                    </x-app-config.form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card card-outline card-primary">
                <div class="card-header text-center p-2">
                    <h6><i class="fas fa-table text-primary"></i> {{ __('List of lessons of bible school') }}
                        <strong>{{ $bibleSchool->name }}</strong>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="card p-2">
                        <div class="row p-0">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                <x-app-config.input placeholder="{{ __('Search by id, name') }}"
                                    wire:model.debounce.500ms="search" />
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <input type="date" class="form-control" wire:model="from">
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <input type="date" class="form-control" wire:model="to">
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
                                @forelse ($lessons as $lessonTable)
                                    <tr>
                                        <td>{{ $lessonTable->id }}</td>
                                        <td>{{ $lessonTable->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($lessonTable->lesson_date)->format('Y-m-d') }}
                                        </td>
                                        <td>{{ $lessonTable->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center align-middle">
                                            <span
                                                class="badge badge-{{ $lessonTable->state == 'Activo' ? 'success' : 'danger' }}">{{ $lessonTable->state }}</span>
                                        </td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            <div class="btn-group">
                                                @if ($lessonTable->state == 'Activo')
                                                    <x-app-config.button color="link text-danger"
                                                        icon="fas fa-power-off" class="btn-sm"
                                                        wire:click="$emit('changeStateLesson', {{ $lessonTable }})" />
                                                @else
                                                    <x-app-config.button color="link text-success"
                                                        icon="fas fa-power-off" class="btn-sm"
                                                        wire:click="$emit('changeStateLesson', {{ $lessonTable }})" />
                                                @endif
                                                {{-- <x-app-config.button color="link text-danger"
                                                icon="fas fa-trash" class="btn-sm" wire:click="$emit('deleteBiblesSchool', {{ $lessonTable }})" /> --}}
                                                <x-app-config.button color="link text-cyan" icon="fas fa-edit"
                                                    class="btn-sm" wire:click="edit('{{ $lessonTable->slug }}')" />

                                                <a href="{{ route('admin.bible-school.lessons-take-attendance', ['bibleSchool' => $bibleSchool->slug, 'lesson' => $lessonTable->slug]) }}" class="btn btn-link text-navy btn-sm"
                                                    title="{{ __('Take Attendance') }}"><i
                                                        class="fas fa-clipboard-check"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('Not bible schools lists') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($lessons->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $lessons->firstItem() !!} {{ __('to') }}
                            {!! $lessons->lastItem() !!}
                            {{ __('of') }} {!! $lessons->total() !!} {{ __('entries') }}
                            {!! $lessons->links() !!}
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
                $('#btnResetLesson').hide();

                hideShowBtn('input', '#idNameLesson', '#btnResetLesson');
                hideShowBtn('input', '#idDateLesson', '#btnResetLesson');
                hideShowBtn('input', '#idDescriptionLesson', '#btnResetLesson');
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

            Livewire.on('changeStateLesson', lesson => {
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

                        Livewire.emit('changeState', lesson.slug);

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: "{{ __('Change state lesson') }}",
                            text: `{{ __('The state of the lesson ${lesson.name} was successfully updated') }}`,
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
