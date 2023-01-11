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

    public $columns = [
        'id' => '#',
        'name' => 'Name',
        'description' => 'Description',
    ];

    public function render()
    {
        $posts = Sector::orderBy($this->sortColumn, $this->sortDirection)->paginate(10);
        return view('livewire.admin.sector-livewire', ['sectors' => $posts])->layout('components.layouts.app');
    }
}
