<?php

namespace App\Http\Livewire\Admin\BibleSchool;

use App\Models\BibleSchool;
use App\Models\Member;
use App\Traits\WithOrderTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollLivewire extends Component
{
    use WithOrderTrait, WithPagination;

    public $bibleSchool, $member_id;

    public $columns = [
        'id' => '#',
        'document_number' => 'Document',
        'name' => 'Name',
        'is_baptized' => 'Is Baptized',
        'progress' => 'Progress'
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['render'];

    protected $rules = [
        'member_id' => ['required', 'exists:members,id']
    ];

    public function mount(BibleSchool $bibleSchool)
    {
        $this->bibleSchool = $bibleSchool;
    }

    public function render()
    {
        $members = $this->getMembers();
        $membersCourse = $this->bibleSchool->members();
        $membersCourse->orderBy($this->sortColumn, $this->sortDirection);

        return view(
            'livewire.admin.bible-school.enroll-livewire',
            [
                'members' => $members,
                'membersCourse' => $membersCourse->paginate(10)
            ]
        )->layout('components.layouts.app');
    }

    public function save()
    {
        $this->validate();

        $member = Member::findOrFail($this->member_id);
        $memberEnroled = $this->getEnroleMember('member_id', $member->id, '=');
        $idsBibleSchools = $this->getBibleSchoolByMember($member);

        $icon = 'success';
        $message = "The miembro $member->name enrolle successfully";

        if (!count($memberEnroled) && !in_array($this->bibleSchool->id, $idsBibleSchools)) {
            if (!is_null($member->bibleSchools()->attach($this->bibleSchool->id))) {
                $icon = 'error';
                $message = "The miembro $member->name not enrolle";
            }
        } else if (count($memberEnroled)) {
            $icon = 'error';
            $message = "The miembro $member->name is already enrolled";
        } else {
            $icon = 'error';
            $message = "The miembro $member->name already ends the Bible School";
        }

        $this->emit('alert', ['icon' => $icon, 'message' => $message]);
        $this->emit('clear-select');
    }

    public function getMembers()
    {
        $idMemberEnroled = [];
        $membersEnroled = $this->getEnroleMember();

        if ($membersEnroled) {
            foreach ($membersEnroled as $enroled) {
                $idMemberEnroled[] = $enroled->member_id;
            }
        }

        return Member::orderBy('name', 'asc')->whereNotIn('id', $idMemberEnroled)->get();
    }

    public function getEnroleMember($find = '', $value = '', $operator = '')
    {
        $membersEnroled = DB::table('bible_school_member');
        $membersEnroled->where('progress', '<>', 'Finalizado');

        if ($find != '' && $value != '') {
            $membersEnroled->where("$find", "$operator", "$value");
        }

        return $membersEnroled->get();
    }

    public function getBibleSchoolByMember($member)
    {
        $idsBiblesSchools = [];

        if ($member->bibleSchools) {
            foreach ($member->bibleSchools as $bibleSchool) {
                $idsBiblesSchools[] = $bibleSchool->id;
            }
        }

        return $idsBiblesSchools;
    }
}
