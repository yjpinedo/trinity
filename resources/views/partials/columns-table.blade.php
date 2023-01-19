@foreach ($columns as $key => $column)
    @if ($key == 'neighborhood_sector_id')
        <th style="width: 10%; cursor: pointer;">
            {{ __($column) }}
            <i class="fas fa-sort text-primary"></i>
        </th>
    @else
        @if ($key == 'id')
            <th class="align-middle" style="width: {{ $percentage['id'] }}; cursor: pointer;"
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
        @elseif ($key == 'is_baptized')
            <th style="width: 11%; cursor: pointer;" wire:click="sortBy('{{ $key }}')">
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
        @elseif ($key == 'state')
            <th class="text-center" style="width: 8%; cursor: pointer;" wire:click="sortBy('{{ $key }}')">
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
            <th style="width: {{ $percentage['column'] }}; cursor: pointer;" wire:click="sortBy('{{ $key }}')">
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
    @endif
@endforeach

@if (!isset($actionShow))
    <th style="width: {{ $percentage['action'] }}" class="text-center">
        {{ __('Actions') }}
        <i class="fas fa-cogs text-primary"></i>
    </th>
@else
    <th style="width: {{ $percentage['action'] }}" class="">
        {{ __('Age') }}
        <i class="fas fa-minus text-danger"></i>
    </th>
@endif
