<?php

namespace App\Http\Livewire\Admin;

use App\Models\BibleSchool;
use App\Models\Cell;
use App\Models\Member;
use Livewire\Component;
use App\Models\Neighborhood;
use Livewire\WithPagination;
use App\Traits\WithOrderTrait;
use Carbon\Carbon;

class MemberLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $all_school = false;
    public $actionFilters = false;
    public $bibles_schools = [];
    public $btnAction = 'save';
    public $document_type_search, $sex_search, $civil_state_search, $is_baptized_search;
    public $is_baptized = 'No';
    public $name, $lastname, $email, $document_type, $document_number, $date_of_birth, $civil_state, $address, $phone, $cellphone, $member;
    public $neighborhood_id = '';
    public $cell_id = '';
    public $neighborhood_id_serach = '';
    public $step = 1;
    public $search = '';
    public $sex = 'Femenino';
    public $from, $to;

    public $columns = [
        'id' => '#',
        'document_number' => 'Document',
        'name' => 'Name',
        'neighborhood_id' => 'Neighborhood',
        'state' => 'State',
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete', 'changeState'];

    protected $queryString = [
        'search' => ['except' => ''],
        //'neighborhood_id_serach' => ['except' => ''],
        'document_type_search' => ['except' => ''],
        'sex_search' => ['except' => ''],
        'civil_state_search' => ['except' => ''],
        'is_baptized_search' => ['except' => ''],
    ];

    public function attachBibleSchool($member)
    {
        if ($this->all_school) {
            foreach ($this->bibles_schools as $key => $school) {
                $member->bibleSchools()->attach($key, ['progress' => 'Finalizado']);
            }
        } else {
            if ($this->bibles_schools) {
                foreach ($this->bibles_schools as $bibles) {
                    $member->bibleSchools()->attach($bibles, ['progress' => 'Finalizado']);
                }
            }
        }
    }

    protected function rules()
    {
        $id = $this->member->id ?? '';
        return [
            'name' => ['required', 'min:2', 'max:80'],
            'lastname' => ['required', 'min:2', 'max:80'],
            'email' => ['required', 'email', 'unique:members,email,' . $id],
            'document_type' => ['required', 'in:Registro civil,Tarjeta de identidad,Cédula de ciudanía,Tarjeta de extranjería,Pasaporte'],
            'document_number' => ['required', 'numeric', 'digits_between:6,12', 'unique:members,document_number,' . $id],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'sex' => ['required', 'in:Femenino,Masculino'],
            'civil_state' => ['required', 'in:Soltero,Casado,Conviviente civil,Divorciado,Viudo'],
            'address' => ['nullable', 'min:2', 'max:500'],
            'phone' => ['nullable', 'numeric', 'digits_between:6,8', 'unique:members,phone,' . $id],
            'cellphone' => ['nullable', 'numeric', 'digits_between:6,10', 'unique:members,cellphone,' . $id],
            'is_baptized' => ['required', 'in:Si,No'],
            'neighborhood_id' => ['required', 'exists:neighborhoods,id'],
            'cell_id' => ['nullable', 'exists:cells,id'],
        ];
    }

    public function changeState(Member $member)
    {
        if ($member->state == 'Inactivo') {
            $member->state = 'Activo';
        } else {
            $member->state = 'Inactivo';
        }
        $member->save();
    }

    public function changeStep($step)
    {
        $this->step = $step;
    }

    public function delete(Member $member)
    {
        $member->delete();
    }

    public function edit(Member $member)
    {
        $this->member = $member;
        $this->name = $member->name;
        $this->lastname = $member->lastname;
        $this->email = $member->email;
        $this->document_type = $member->document_type;
        $this->document_number = $member->document_number;
        $this->date_of_birth = Carbon::parse($member->date_of_birth)->toDateString();
        $this->sex = $member->sex;
        $this->civil_state = $member->civil_state;
        $this->address = $member->address;
        $this->phone = $member->phone;
        $this->cellphone = $member->cellphone;
        $this->is_baptized = $member->is_baptized;
        $this->neighborhood_id = $member->neighborhood_id;
        $this->cell_id = $member->cell_id;
        $this->bibles_schools = $this->getBiblesSchoolByMember($member);

        $this->btnAction = 'edit';

        $this->emit('selected-item', $member->neighborhood_id, $member->cell_id);
    }

    public function getBiblesSchoolByMember($member)
    {
        $idsSchools = [];

        if ($member->bibleSchools) {
            foreach ($member->bibleSchools as $schools) {
                if ($schools->pivot->progress == 'Finalizado') {
                    $idsSchools[] = $schools->id;
                }
            }
        }

        return $idsSchools;
    }

    public function render()
    {
        $members = Member::orderBy($this->sortColumn, $this->sortDirection)->with('neighborhood.sector');
        $neighborhoods = Neighborhood::orderBy('name', 'asc')->pluck('name', 'id');
        $biblesSchols = BibleSchool::orderBy('name', 'asc')->pluck('name', 'id');
        $listCells = Cell::orderBy('name', 'asc')->pluck('name', 'id');

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

        return view('livewire.admin.member-livewire', ['members' => $members->paginate(10), 'neighborhoods' => $neighborhoods, 'biblesSchols' => $biblesSchols, 'cells' => $listCells])
            ->layout('components.layouts.app');
    }

    public function resetTo()
    {
        $this->reset(['name', 'lastname', 'email', 'document_type', 'document_number', 'date_of_birth', 'civil_state', 'address', 'phone', 'cellphone', 'is_baptized', 'neighborhood_id']);
        $this->all_school = false;
        $this->bibles_schools = [];
        $this->is_baptized = 'No';
        $this->member = new Member;
        $this->sex = 'Femenino';
        $this->btnAction = 'save';

        $this->emit('clear-select');
    }

    public function save()
    {
        $this->validate();

        $memberNew = null;
        $action = 'registered';

        $memberNew = Member::updateOrCreate(
            ['id' => $this->member->id ?? null],
            [
                'name' => $this->name,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'document_type' => $this->document_type,
                'document_number' => $this->document_number,
                'date_of_birth' => $this->date_of_birth,
                'sex' => $this->sex,
                'civil_state' => $this->civil_state,
                'address' => $this->address,
                'phone' => $this->phone,
                'cellphone' => $this->cellphone,
                'is_baptized' => $this->is_baptized,
                'neighborhood_id' => $this->neighborhood_id,
                'cell_id' => $this->cell_id,
            ]
        );

        if ($this->member) {
            $action = 'updated';
            $this->member->bibleSchools()->detach();
            $this->attachBibleSchool($this->member);
        } else {
            $this->attachBibleSchool($memberNew);
        }

        $this->resetTo();
        $this->changeStep(1);
        $this->emit('alert', ['icon' => 'success', 'message' => "The sector $memberNew->name $action successfully"]);
    }

    public function updatedAllSchool($value)
    {
        $this->bibles_schools = [];
        if ($value) {
            $this->bibles_schools = BibleSchool::orderBy('name', 'asc')->pluck('name', 'id');
        }
    }

    public function updatingCivilStateSerach()
    {
        $this->resetPage();
    }

    public function updatingDocumentTypeSerach()
    {
        $this->resetPage();
    }

    public function updatingIsBaptizedSerach()
    {
        $this->resetPage();
    }

    public function updatingNeighborhoodIdSerach()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSexSearch()
    {
        $this->resetPage();
    }
}
