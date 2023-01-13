@foreach ($columns as $key => $column)
    @if ($key == 'id')
        <th class="align-middle" style="width: {{ $percentage['id'] }}; cursor: pointer;" wire:click="sortBy('{{ $key }}')">
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
@endforeach
<th style="width: {{ $percentage['action'] }}" class="text-center">
    {{ __('Actions') }}
    <i class="fas fa-cogs text-primary"></i>
</th>
