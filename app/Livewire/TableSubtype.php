<?php

namespace App\Livewire;

use Str;
use App\Models\Type;
use App\Models\Subtype;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableSubtype extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $subtypeId;
    public $selectedType; // Change from selectedRoles to selectedRole


    protected $listeners = [
        'subtypeAdded' => 'refreshPermissions',
        'subtypeUpdated' => 'refreshPermissions',
        'subtypeDeleted' => '$refresh',
    ];

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 5;

    public function mount()
    {
        $this->search = '';
    }

    public function refreshPermissions()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($subtypeId)
    {
        $subtype = Subtype::findOrFail($subtypeId);
        $subtype->delete();

        $this->dispatch('subtypeDeleted');
        $this->dispatch('notification', ['message' => 'Successfully deleted!']);
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $subtype = Subtype::findOrFail($id);
        $this->subtypeId = $id;
        $this->name = $subtype->name;
        $this->isOpen = true;
        $this->selectedType = $subtype->type_id;
        $this->dispatch('updateSelectedType', $this->selectedType);

    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:30|unique:subtypes,name,' . $this->subtypeId,
            'selectedType' => 'required|exists:types,id',

        ]);
    
        $slug = Str::slug($this->name); // Generate the slug
    
        $data = [
            'name' => $this->name,
            'slug' => $slug,
            'type_id' => $this->selectedType,
        ];

        $action = $this->subtypeId ? 'subtypeUpdated' : 'subtypeAdded';

        $subtype = Subtype::updateOrCreate(['id' => $this->subtypeId], $data);


        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('resetType'); // Emit browser event to reset category field
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->subtypeId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->subtypeId = null;
        $this->selectedType = null; // Reset selectedRole to null

    }

    public function render()
    {
        $subtypes = Subtype::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $types = Type::all();

        return view('livewire.table-subtype', compact('subtypes', 'types'));
    }
}
