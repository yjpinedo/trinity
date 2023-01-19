<?php

namespace App\Http\Livewire\Admin;

use App\Models\Member;
use Livewire\Component;
use App\Models\Neighborhood;
use Livewire\WithPagination;
use App\Traits\WithOrderTrait;

class ShalomMemberLibewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $document_type_search, $sex_search, $civil_state_search, $is_baptized_search;
    public $is_baptized = 'No';
    public $neighborhood_id_serach = '';
    public $search = '';
    public $sex = 'Femenino';
    public $from, $to;
    public $type_red_search;
    public $rangeFrom = 0;
    public $rangeTo = 0;

    protected $paginationTheme = 'bootstrap';

    public $columns = [
        'id' => '#',
        'document_number' => 'Document',
        'name' => 'Name',
        'email' => 'Email',
        'cellphone' => 'Cellphone',
        'is_baptized' => 'Is Baptized',
        'neighborhood_id' => 'Neighborhood',
    ];

    public function render()
    {
        $members = Member::orderBy($this->sortColumn, $this->sortDirection)->whereHas('neighborhood', function ($neighborhood) {
            return $neighborhood->whereHas('sector', function ($sector) {
                return $sector->where('slug', 'shalom');
            });
        });

        $neighborhoods = Neighborhood::orderBy('name', 'asc')->whereHas('sector', function ($sector) {
            return $sector->where('slug', 'shalom');
        })->pluck('name', 'id');

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

        if ($this->neighborhood_id_serach && $this->neighborhood_id_serach != '') {
            $members->where('neighborhood_id', $this->neighborhood_id_serach);
        }

        if ($this->type_red_search == 'children') {
            $this->rangeFrom = 0;
            $this->rangeTo = 13;
        } elseif ($this->type_red_search == 'teenagers') {
            $this->rangeFrom = 14;
            $this->rangeTo = 18;
        } elseif ($this->type_red_search == 'youths') {
            $this->rangeFrom = 19;
            $this->rangeTo = 30;
        } elseif ($this->type_red_search == 'adults') {
            $this->rangeFrom = 30;
            $this->rangeTo = 200;
        } else {
            $this->rangeFrom = 0;
            $this->rangeTo = 0;
        }

        return view('livewire.admin.shalom-member-libewire', ['members' => $members->paginate(10), 'neighborhoods' => $neighborhoods])
            ->layout('components.layouts.app');
    }
}