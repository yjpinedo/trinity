<div>
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Bible School - Enroll Member') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Enroll Member') }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Enroll Member') }}
    </x-slot>

    <x-slot name="user">
        {{ __('Bible School') }}
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
                                        'actionShow' => false,
                                    ])
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($membersCourse as $memberTable)
                                    <tr>
                                        <td class="align-middle">{{ $memberTable->id }}</td>
                                        <td class="align-middle">{{ $memberTable->document_number }}</td>
                                        <td class="align-middle">{{ $memberTable->full_name }}</td>
                                        <td class="align-middle">{{ $memberTable->is_baptized }}</td>
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
        </script>
    @endpush
</div>
