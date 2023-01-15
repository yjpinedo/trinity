<?php

namespace App\Http\Livewire\Admin;

use App\Models\Member;
use Livewire\Component;
use App\Models\Neighborhood;
use Livewire\WithPagination;
use App\Traits\WithOrderTrait;

class MemberLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $search = '';
    public $document_type_search, $sex_search, $civil_state_search, $is_baptized_search;
    public $from, $to;
    public $neighborhood_id_serach = '';

    public $columns = [
        'id' => '#',
        'document_number' => 'Document',
        'name' => 'Name',
        'is_baptized' => 'Is Baptized',
        'neighborhood_id' => 'Neighborhood',
        //'neighborhood_sector_id' => 'Sector',
    ];

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
        'neighborhood_id_serach' => ['except' => ''],
    ];

    public function render()
    {
        $members = Member::orderBy($this->sortColumn, $this->sortDirection)->with('neighborhood.sector');
        $neighborhoods = Neighborhood::orderBy('name', 'asc')->pluck('name', 'id');

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

        if ($this->from && $this->to != '') {
            $members->whereBetween('date_of_birth', [date($this->from), date($this->to)]);
        }

        if ($this->neighborhood_id_serach && $this->neighborhood_id_serach != '') {
            $members->where('neighborhood_id', $this->neighborhood_id_serach);
        }

        return view('livewire.admin.member-livewire', ['members' => $members->paginate(10), 'neighborhoods' => $neighborhoods])
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
