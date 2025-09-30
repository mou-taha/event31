<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Organism;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableOrganism extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $organismId;

    protected $listeners = [
        'organismAdded' => 'refreshPermissions',
        'organismUpdated' => 'refreshPermissions',
        'organismDeleted' => '$refresh',
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

    public function delete($organismId)
    {
        $organism = Organism::findOrFail($organismId);
        $organism->delete();

        $this->dispatch('organismDeleted');
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
        $organism = Organism::findOrFail($id);
        $this->organismId = $id;
        $this->name = $organism->name;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:organisms,name,' . $this->organismId,
        ]);
    
        $slug = \Str::slug($this->name); // Generate the slug
    
        $action = $this->organismId ? 'organismUpdated' : 'organismAdded';
    
        Organism::updateOrCreate(['id' => $this->organismId], [
            'name' => $this->name,
            'slug' => $slug, // Add the slug field here
        ]);
    
        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->organismId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->organismId = null;
    }

    public function render()
    {
        $organisms = Organism::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-organism', compact('organisms'));
    }
}
