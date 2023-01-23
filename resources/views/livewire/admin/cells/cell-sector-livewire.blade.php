<div>
    <x-slot name="title">
        {{ __('Sector - Cells') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Cells ') . $sector->name }}
    </x-slot>

    <x-slot name="pageActive">
        {{ __('Cells') }}
    </x-slot>

    <x-slot name="user">
        {{ __('Sector') }}
    </x-slot>

    <div class="row">

        <div class="col-12">
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
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    @foreach ($columns as $key => $column)
                                        @if ($key == 'id')
                                            <th class="align-middle" style="width: 5%; cursor: pointer;"
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
                                        @elseif ($key == 'state')
                                            <th class="text-center" style="width: 8%; cursor: pointer;"
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
                                        @else
                                            <th style="cursor: pointer;"
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
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cells as $cellTable)
                                    <tr>
                                        <td>{{ $cellTable->id }}</td>
                                        <td>{{ $cellTable->name }}</td>
                                        <td>{{ $cellTable->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $cellTable->neighborhood->name }}</td>
                                        <td class="text-center align-middle">
                                            <span
                                                class="badge badge-{{ $cellTable->state == 'Activo' ? 'success' : 'danger' }}">{{ $cellTable->state }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('Not cells lists') }}</td>
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
        <script>
            document.addEventListener('livewire:load', function() {

                //Initialize Select2 Elements
                // Filtered
                let select2 = $('#selectCellId').select2({
                    theme: 'bootstrap4'
                }).on('change', () => {
                    @this.set('neighborhood_id_serach', select2.select2("val"));
                });
            });
        </script>
    @endpush
</div>
