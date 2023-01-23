<?php

namespace App\Http\Livewire\Admin\Cells;

use App\Models\Cell;
use App\Models\Sector;
use Livewire\Component;
use App\Models\Neighborhood;
use Livewire\WithPagination;
use App\Traits\WithOrderTrait;

class CellSectorLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $sector;
    public $neighborhood_id_serach = '';
    public $search = '';
    public $columns = [
        'id' => '#',
        'name' => 'Name',
        'created_at' => 'Date created',
        'neighborhood_id' => 'Neighborhood',
        'state' => 'State',
    ];

    protected $paginationTheme = 'bootstrap';

    public function mount(Sector $sector)
    {
        $this->sector = $sector;
    }

    public function render()
    {
        $cells = Cell::orderBy($this->sortColumn, $this->sortDirection)
            ->with('neighborhood')
            ->whereHas('neighborhood', function ($neighborhood) {
                return $neighborhood->whereHas('sector', function ($sector) {
                    return $sector->where('id', $this->sector->id);
                });
            });

        $neighborhoods = Neighborhood::orderBy('name', 'asc')
            ->whereHas('sector', function ($sector) {
                return $sector->where('id', $this->sector->id);
            })->pluck('name', 'id');

        if ($this->search && $this->search != '') {
            $cells->where(function ($query) {
                $query->orWhere('id', 'like', "%$this->search%")
                    ->orWhere('name', 'like', "%$this->search%");
            });
        }

        if ($this->neighborhood_id_serach && $this->neighborhood_id_serach != '') {
            $cells->where('neighborhood_id', $this->neighborhood_id_serach);
        }

        return view('livewire.admin.cells.cell-sector-livewire', ['cells' => $cells->paginate(10), 'neighborhoods' => $neighborhoods, 'sector' => $this->sector])
            ->layout('components.layouts.app');
    }

    public function updatingNeighborhoodIdSerach()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
