<?php

namespace App\Http\Livewire\Admin;

use App\Models\Neighborhood;
use App\Models\Sector;
use App\Traits\WithOrderTrait;
use Livewire\Component;
use Livewire\WithPagination;

class NeighborhoodLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $btnAction = 'save';
    public $name, $description, $neighborhood;
    public $search = '';
    public $sector_id = '';
    public $sector_id_search = '';

    public $columns = [
        'id' => '#',
        'name' => 'Name',
        'created_at' => 'Date created',
        'sector_id' => 'Sector',
    ];

    protected $listeners = ['delete'];

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
        'sector_id_search' => ['except' => ''],
    ];

    protected $rules = [
        'sector_id' => ['required', 'exists:sectors,id',],
        'name' => ['required', 'max:255', 'min:2'],
        'description' => ['nullable', 'max:500', 'min:2'],
    ];

    public function delete(Neighborhood $neighborhood)
    {
        $neighborhood->delete();
    }

    public function edit(Neighborhood $neighborhood)
    {
        $this->neighborhood = $neighborhood;
        $this->name = $neighborhood->name;
        $this->description = $neighborhood->description;
        $this->sector_id = $neighborhood->sector_id;
        $this->btnAction = 'edit';
        $this->emit('selected-item', $neighborhood->sector_id);
    }

    public function render()
    {
        $neighborhoods = Neighborhood::orderBy($this->sortColumn, $this->sortDirection)->with('sector');

        if ($this->search && $this->search != '') {
            $neighborhoods->where(function ($query) {
                $query->orWhere('id', 'like', "%$this->search%")
                    ->orWhere('name', 'like', "%$this->search%");
            });
        }

        if ($this->sector_id_search && $this->sector_id_search != '') {
            $neighborhoods->where('sector_id', $this->sector_id_search);
        }

        return view('livewire.neighborhood-livewire', ['neighborhoods' => $neighborhoods->paginate(10), 'sectors' => Sector::pluck('name', 'id')])
            ->layout('components.layouts.app');
    }

    public function resetTo()
    {
        $this->reset(['name', 'description', 'sector_id']);
        $this->sector_id = '';
        $this->btnAction = 'save';
        $this->emit('clear-select');
    }

    public function save()
    {
        $this->validate();

        $neighborhoodNew = null;
        $action = 'save';

        $neighborhoodNew = Neighborhood::updateOrCreate(
            ['id' => $this->neighborhood->id ?? null],
            [
                'name' => $this->name,
                'description' => $this->description,
                'sector_id' => $this->sector_id,
            ]
        );

        if ($this->neighborhood) {
            $action = 'updated';
        }

        $this->resetTo();
        $this->emit('alert', ['icon' => 'success', 'message' => "The sector $neighborhoodNew->name $action successfully"]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
