<?php

namespace App\Http\Livewire\Admin\Cells;

use App\Models\Cell;
use App\Models\Member;
use Livewire\Component;
use App\Models\Neighborhood;
use Livewire\WithPagination;
use App\Traits\WithOrderTrait;

class MemberCellLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $cell;
    public $document_type_search, $sex_search, $civil_state_search, $is_baptized_search;
    public $is_baptized = 'No';
    public $search = '';
    public $sex = 'Femenino';
    public $from, $to;

    protected $paginationTheme = 'bootstrap';

    public $columns = [
        'id' => '#',
        'document_number' => 'Document',
        'name' => 'Name',
        'email' => 'Email',
        'cellphone' => 'Cellphone',
        'is_baptized' => 'Baptized',
    ];

    public function mount(Cell $cell)
    {
        $this->cell = $cell;
    }

    public function render()
    {
        $members = Member::orderBy($this->sortColumn, $this->sortDirection)->whereHas('cell', function ($cell) {
            return $cell->where('id', $this->cell->id);
        });

        if ($this->search && $this->search != '') {
            $members->where(function ($query) {
                $query->orWhere('id', 'like', "%$this->search%")
                    ->orWhere('document_number', 'like', "%$this->search%")
                    ->orWhere('name', 'like', "%$this->search%")
                    ->orWhere('lastname', 'like', "%$this->search%")
                    ->orWhere('email', 'like', "%$this->search%")
                    ->orWhere('address', 'like', "%$this->search%")
                    ->orWhere('phone', 'like', "%$this->search%")
                    ->orWhere('cellphone', 'like', "%$this->search%");
            });
        }

        if ($this->document_type_search && $this->document_type_search != '') {
            $members->where('document_type', $this->document_type_search);
        }

        if ($this->sex_search && $this->sex_search != '') {
            $members->where('sex', $this->sex_search);
        }

        if ($this->civil_state_search && $this->civil_state_search != '') {
            $members->where('civil_state', $this->civil_state_search);
        }

        if ($this->is_baptized_search && $this->is_baptized_search != '') {
            $members->where('is_baptized', $this->is_baptized_search);
        }

        if (($this->from && $this->from != '') && ($this->to && $this->to != '')) {
            $members->whereBetween('date_of_birth', [date($this->from), date($this->to)]);
        }

        return view('livewire.admin.cells.member-cell-livewire', ['members' => $members->paginate(10), 'cell' => $this->cell])
            ->layout('components.layouts.app');
    }
}
