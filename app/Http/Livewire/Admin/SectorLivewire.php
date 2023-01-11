<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sector;
use App\Traits\WithOrderTrait;
use Livewire\Component;
use Livewire\WithPagination;

class SectorLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';

    public $columns = [
        'id' => '#',
        'name' => 'Name',
        'description' => 'Description',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $sectors = Sector::orderBy($this->sortColumn, $this->sortDirection);

        if ($this->search && $this->search != '') {
            $sectors->where(function ($query) {
                $query->orWhere('id', 'like', "%$this->search%")
                    ->orWhere('name', 'like', "%$this->search%")
                    ->orWhere('description', 'like', "%$this->search%");
            });
        }

        return view('livewire.admin.sector-livewire', ['sectors' => $sectors->paginate(10)])
            ->layout('components.layouts.app');
    }
}
