<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableCity extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $cityId;

    protected $listeners = [
        'cityAdded' => 'refreshPermissions',
        'cityUpdated' => 'refreshPermissions',
        'cityDeleted' => '$refresh',
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

    public function delete($cityId)
    {
        $city = City::findOrFail($cityId);
        $city->delete();

        $this->dispatch('cityDeleted');
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
        $city = City::findOrFail($id);
        $this->cityId = $id;
        $this->name = $city->name;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:30|unique:cities,name,' . $this->cityId,
        ]);
    
        $slug = \Str::slug($this->name); // Generate the slug
    
        $action = $this->cityId ? 'cityUpdated' : 'cityAdded';
    
        City::updateOrCreate(['id' => $this->cityId], [
            'name' => $this->name,
            'slug' => $slug, // Add the slug field here
        ]);
    
        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->cityId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->cityId = null;
    }

    public function render()
    {
        $cities = City::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-city', compact('cities'));
    }
}
