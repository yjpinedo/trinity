<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Lesson;
use Livewire\Component;
use App\Models\BibleSchool;
use Livewire\WithPagination;
use App\Traits\WithOrderTrait;

class LessonLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $btnAction = 'save';
    public $name, $description, $lesson_date, $lesson, $bibleSchool;
    public $search = '';
    public $from, $to;

    public $columns = [
        'id' => '#',
        'name' => 'Name',
        'lesson_date' => 'Date Lesson',
        'state' => 'State',
    ];

    protected $listeners = ['changeState'];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => ['required', 'min:2', 'max:70'],
        'lesson_date' => ['required', 'date', 'after:today'],
        'description' => ['nullable', 'min:2', 'max:70'],
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function changeState(Lesson $lesson)
    {
        if ($lesson->state == 'Inactivo') {
            $lesson->state = 'Activo';
        } else {
            $lesson->state = 'Inactivo';
        }
        $lesson->save();
    }

    public function edit(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->name = $lesson->name;
        $this->lesson_date = Carbon::parse($lesson->lesson_date)->toDateString();
        $this->description = $lesson->description;
        $this->btnAction = 'edit';
    }

    public function mount(BibleSchool $bibleSchool)
    {
        $this->bibleSchool = $bibleSchool;
    }

    public function render()
    {
        $lessons = $this->bibleSchool->lessons()->orderBy($this->sortColumn, $this->sortDirection);

        if ($this->search && $this->search != '') {
            $lessons->where(function ($query) {
                $query->orWhere('lessons.id', 'like', "%$this->search%")
                    ->orWhere('lessons.name', 'like', "%$this->search%");
            });
        }

        if (($this->from && $this->from != '') && ($this->to && $this->to != '')) {
            $lessons->whereBetween('lessons.lesson_date', [date($this->from), date($this->to)]);
        }

        return view('livewire.admin.lesson-livewire', ['lessons' => $lessons->paginate(10)])->layout('components.layouts.app');
    }

    public function save()
    {
        $this->validate();

        $lessonNew = null;
        $action = 'registered';

        $lessonNew = Lesson::updateOrCreate(
            ['id' => $this->lesson->id ?? null],
            [
                'name' => $this->name,
                'slug' => str($this->name)->slug(),
                'description' => $this->description,
                'lesson_date' => $this->lesson_date,
            ]
        );

        if ($this->btnAction == 'save') {
            $lessonNew->bibleSchools()->attach($this->bibleSchool->id);
        }

        if ($this->lesson) {
            $action = 'updated';
        }

        $this->resetTo();
        $this->emit('alert', ['icon' => 'success', 'message' => "The sector $lessonNew->name $action successfully"]);
    }

    public function resetTo()
    {
        $this->reset(['name', 'description', 'lesson_date']);
        $this->btnAction = 'save';
        $this->lesson = new Lesson;
        //$this->emit('clear-select');
        //$this->emit('hide-btn');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
