<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sector;
use App\Traits\WithOrderTrait;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SectorLivewire extends Component
{
    use WithOrderTrait, WithPagination, WithFileUploads;

    public $btnAction = 'save';
    public $identificationImage;
    public $name, $description, $image;
    public $search = '';
    public $sectorFind, $imageFind;

    public $columns = [
        'id' => '#',
        'name' => 'Name',
        'description' => 'Description',
    ];

    protected $listeners = ['delete'];

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $rules = [
        'name' => 'required|max:255|min:2',
        'description' => 'nullable|max:500|min:3',
        'image' => 'nullable|image:max2048',
    ];

    public function delete(Sector $sector)
    {
        if ($sector->image) {
            Storage::delete($sector->image);
        }
        $sector->delete();
        $this->resetTo();
    }

    public function edit(Sector $sector)
    {
        $this->btnAction = 'edit';
        $this->sectorFind = $sector;
        $this->name = $sector->name;
        if ($sector->description) {
            $this->description = $sector->description;
        }
        if ($sector->image) {
            $this->imageFind = $sector->image;
        } else {
            $this->imageFind = null;
        }

        $this->emit('show-btn');
    }

    public function mount()
    {
        $this->identificationImage = rand();
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

    public function resetTo()
    {
        $this->reset(['name', 'description', 'image']);
        $this->identificationImage = rand();
        $this->imageFind = null;
        $this->btnAction = 'save';
        $this->sectorFind = new Sector;
        $this->emit('hide-btn');
    }

    public function save()
    {
        $this->validate();

        $sectorNew = null;
        $action = null;

        if ($this->sectorFind) {
            if ($this->image) {
                if ($this->imageFind) {
                    Storage::delete($this->imageFind);
                }
                $this->sectorFind->image = $this->image->store('public/admin/sectors');
            }
            $this->sectorFind->name = $this->name;
            $this->sectorFind->description = $this->description;

            $this->sectorFind->save();

            $sectorNew = $this->sectorFind;
            $action = 'updated';
            $this->imageFind = null;
        } else {

            $sectorNew = Sector::create([
                'name' => $this->name,
                'description' => $this->description,

            ]);

            if ($this->image) {
                $image = $this->image->store('public/admin/sectors');
                $sectorNew->image = $image;
                $sectorNew->save();
            }

            $action = 'registered';
        }

        $this->resetTo();
        $this->emit('alert', ['icon' => 'success', 'message' => "The sector $sectorNew->name $action successfully"]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
