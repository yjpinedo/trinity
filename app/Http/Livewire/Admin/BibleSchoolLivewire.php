<?php

namespace App\Http\Livewire\Admin;

use App\Models\BibleSchool;
use App\Models\Member;
use App\Traits\WithOrderTrait;
use Livewire\Component;
use Livewire\WithPagination;

class BibleSchoolLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $btnAction = 'save';
    public $name, $description, $bibleSchool;
    public $search = '';
    public $teacher_id_search = '';
    public $teacher_id = '';

    public $columns = [
        'id' => '#',
        'name' => 'Name',
        'created_at' => 'Date created',
        'teacher_id' => 'Teacher',
        'state' => 'State',
    ];

    protected $listeners = ['delete', 'changeState'];

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
        //'teacher_id_search' => ['except' => ''],
    ];

    protected $rules = [
        'name' => ['required', 'max:255', 'min:2'],
        'description' => ['nullable', 'max:500', 'min:2'],
        'teacher_id' => ['required', 'exists:members,id'],
    ];

    public function changeState(BibleSchool $bibleSchool)
    {
        if ($bibleSchool->state == 'Inactivo') {
            $bibleSchool->state = 'Activo';
        } else {
            $bibleSchool->state = 'Inactivo';
        }
        $bibleSchool->save();
    }

    public function delete(BibleSchool $bibleSchool)
    {
        $bibleSchool->delete();
    }

    public function edit(BibleSchool $bibleSchool)
    {
        $this->bibleSchool = $bibleSchool;
        $this->name = $bibleSchool->name;
        $this->description = $bibleSchool->description;
        $this->teacher_id = $bibleSchool->teacher_id;
        $this->btnAction = 'edit';
        $this->emit('selected-item', $bibleSchool->teacher_id);
        //$this->emit('show-btn');
    }

    public function render()
    {
        $biblesSchools = BibleSchool::orderBy($this->sortColumn, $this->sortDirection)->with('teacher');
        $teachers = Member::orderBy('name', 'asc')->pluck('name', 'id');

        if ($this->search && $this->search != '') {
            $biblesSchools->where(function ($query) {
                $query->orWhere('id', 'like', "%$this->search%")
                    ->orWhere('name', 'like', "%$this->search%");
            });
        }

        if ($this->teacher_id_search && $this->teacher_id_search != '') {
            $biblesSchools->where('teacher_id', $this->teacher_id_search);
        }

        return view('livewire.admin.bible-school-livewire', ['biblesSchools' => $biblesSchools->paginate(10), 'teachers' => $teachers])
            ->layout('components.layouts.app');
    }

    public function save()
    {
        $this->validate();

        $bibleSchoolNew = null;
        $action = 'registered';

        $bibleSchoolNew = BibleSchool::updateOrCreate(
            ['id' => $this->bibleSchool->id ?? null],
            [
                'name' => $this->name,
                'description' => $this->description,
                'teacher_id' => $this->teacher_id,
            ]
        );

        if ($this->bibleSchool) {
            $action = 'updated';
        }

        $this->resetTo();
        $this->emit('alert', ['icon' => 'success', 'message' => "The sector $bibleSchoolNew->name $action successfully"]);
    }

    public function resetTo()
    {
        $this->reset(['name', 'description']);
        $this->teacher_id = '';
        $this->btnAction = 'save';
        $this->bibleSchool = new BibleSchool;
        $this->emit('clear-select');
        //$this->emit('hide-btn');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTeacherIdSearch()
    {
        $this->resetPage();
    }
}
