<?php

namespace App\Http\Livewire\Admin\BibleSchool;

use App\Models\Lesson;
use App\Models\Member;
use Livewire\Component;
use App\Models\BibleSchool;
use Livewire\WithPagination;
use App\Traits\WithOrderTrait;
use Illuminate\Support\Facades\DB;

class TakeAttendanceLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $bibleSchool, $lesson;

    public $columns = [
        'id' => '#',
        'document_number' => 'Document',
        'name' => 'Name',
        'cellphone' => 'Cellphone'
    ];

    protected $listeners = ['takeAttendance', 'removeAttendance'];

    public function mount(BibleSchool $bibleSchool, Lesson $lesson)
    {
        $this->bibleSchool = $bibleSchool;
        $this->lesson = $lesson;
    }

    public function removeAttendance(Member $member)
    {
        $member->lessons()->detach($this->lesson->id);
        //$this->emit('alert', ['icon' => 'success', 'message' => "Attendance of $member->name taken correctly."]);
    }

    public function render()
    {
        $membersCourse = $this->bibleSchool
            ->members()
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->whereIN('members.id', $this->getEnrolledMember())
            ->whereNotIn('members.id', $this->getAssistedMember());

        $membersLessons = $this->lesson
            ->members()
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->whereIn('members.id', $this->getAssistedMember());

        return view('livewire.admin.bible-school.take-attendance-livewire', ['members' => $membersCourse->paginate(10), 'membersLesson' => $membersLessons->paginate(10)])
            ->layout('components.layouts.app');
    }

    public function takeAttendance(Member $member)
    {
        $member->lessons()->attach($this->lesson->id);
    }

    public function getEnrolledMember()
    {
        $idMembers = [];
        $memberCourses = DB::table('bible_school_member')->where('progress', '=', 'Inscrito')->get();

        foreach ($memberCourses as $members) {
            $idMembers[] = $members->member_id;
        }

        return $idMembers;
    }

    public function getAssistedMember()
    {
        $idMembers = [];
        $memberLesson = DB::table('lesson_member')->where('lesson_id', '=', $this->lesson->id)->get();

        foreach ($memberLesson as $members) {
            $idMembers[] = $members->member_id;
        }

        return $idMembers;
    }
}
