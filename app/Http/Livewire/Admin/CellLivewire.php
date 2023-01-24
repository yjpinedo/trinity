<?php

namespace App\Http\Livewire\Admin;
use App\Models\Cell;
use App\Models\Neighborhood;
use App\Traits\WithOrderTrait;
use Livewire\Component;
use Livewire\WithPagination;

class CellLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $btnAction = 'save';
    public $name, $description, $cell;
    public $leader_id = '';
    public $neighborhood_id_serach = '';
    public $neighborhood_id = '';
    public $search = '';

    public $columns = [
        'id' => '#',
        'name' => 'Name',
        'created_at' => 'Date created',
        'neighborhood_id' => 'Neighborhood',
        'state' => 'State',
    ];

    protected $listeners = ['delete', 'changeState'];

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
        'neighborhood_id_serach' => ['except' => ''],
    ];

    protected $rules = [
        'neighborhood_id' => ['required', 'exists:neighborhoods,id'],
        'name' => ['required', 'max:255', 'min:2'],
        'description' => ['nullable', 'max:500', 'min:2'],
    ];

    public function changeState(Cell $cell)
    {
        if ($cell->state == 'Inactivo') {
            $cell->state = 'Activo';
        } else {
            $cell->state = 'Inactivo';
        }
        $cell->save();
    }

    public function delete(Cell $cell)
    {
        $cell->delete();
    }

    public function edit(Cell $cell)
    {
        $this->cell = $cell;
        $this->name = $cell->name;
        $this->description = $cell->description;
        $this->neighborhood_id = $cell->neighborhood_id;
        $this->btnAction = 'edit';
        $this->emit('selected-item', $cell->neighborhood_id);
    }

    public function render()
    {
        $cells = Cell::orderBy($this->sortColumn, $this->sortDirection)->with('neighborhood', 'leader');
        $neighborhoods = Neighborhood::orderBy('name', 'asc')->pluck('name', 'id');

        if ($this->search && $this->search != '') {
            $cells->where(function ($query) {
                $query->orWhere('id', 'like', "%$this->search%")
                    ->orWhere('name', 'like', "%$this->search%");
            });
        }

        if ($this->neighborhood_id_serach && $this->neighborhood_id_serach != '') {
            $cells->where('neighborhood_id', $this->neighborhood_id_serach);
        }

        return view('livewire.admin.cell-livewire', ['cells' => $cells->paginate(10), 'neighborhoods' => $neighborhoods, 'leaders' => []])
            ->layout('components.layouts.app');
    }

    public function resetTo()
    {
        $this->reset(['name', 'description', 'neighborhood_id']);
        $this->neighborhood_id = '';
        $this->btnAction = 'save';
        $this->cell = new Cell;
        $this->emit('clear-select');
    }

    public function save()
    {
        $this->validate();

        $cellNew = null;
        $action = 'registered';

        /* $cellNew == Cell::updateOrCreate(
            ['id' => $this->cell->id ?? null],
            [
                'name' => $this->name,
                'description' => $this->description,
                'neighborhood_id' => $this->neighborhood_id,
            ]
        ); */

        if ($this->cell) {
            $this->cell->name = $this->name;
            $this->cell->slug = str($this->name)->slug();
            $this->cell->description = $this->description;
            $this->cell->neighborhood_id = $this->neighborhood_id;
            $this->cell->save();
            $cellNew = $this->cell;
            $action = 'updated';
        } else {
            $cellNew = Cell::create([
                'name' => $this->name,
                'slug' => str($this->name)->slug(),
                'description' => $this->description,
                'neighborhood_id' => $this->neighborhood_id,
            ]);
        }

        $this->resetTo();
        $this->emit('alert', ['icon' => 'success', 'message' => "The sector $cellNew->name $action successfully"]);
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
