<div>
    <x-slot name="title">
        {{ __('Sectors') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Managment Sectors') }}
    </x-slot>

    <x-slot name="user">
        {{ Auth::user()->name }}
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header align-middle">
                    <h3 class="card-title"><i class="fas fa-list-ol text-primary"></i> {{ __('List of sectors') }}</h3>
                    <x-app-config.button title="{{ __('Create new sector') }}" icon="fas fa-sitemap"
                        class="btn-sm float-right" />
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                            <th style="cursor: pointer;" wire:click="sortBy('{{ $key }}')">
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
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sectors as $sector)
                                    <tr>
                                        <td>{{ $sector->id }}</td>
                                        <td>{{ $sector->name }}</td>
                                        <td>{{ $sector->description }}</td>
                                        <td style="width: 12%" class="align-middle text-center">
                                            <x-app-config.button color="outline-light text-primary" icon="fas fa-trash"
                                                class="btn-sm" />
                                            <x-app-config.button color="outline-light text-primary" icon="fas fa-edit"
                                                class="btn-sm" />
                                            <x-app-config.button color="outline-light text-primary" icon="fas fa-eye"
                                                class="btn-sm" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">{{ __('Not sectors lists') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($sectors->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-item-center pb-0">
                            {{ __('Showing') }} {!! $sectors->firstItem() !!} {{ __('to') }} {!! $sectors->lastItem() !!}
                            {{ __('of') }} {!! $sectors->total() !!} {{ __('entries') }}
                            {!! $sectors->links() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
