<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Price;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TablePrice extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $priceId;

    protected $listeners = [
        'priceAdded' => 'refreshPermissions',
        'priceUpdated' => 'refreshPermissions',
        'priceDeleted' => '$refresh',
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

    public function delete($priceId)
    {
        $price = Price::findOrFail($priceId);
        $price->delete();

        $this->dispatch('priceDeleted');
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
        $price = Price::findOrFail($id);
        $this->priceId = $id;
        $this->name = $price->name;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:30|unique:prices,name,' . $this->priceId,
        ]);
    
        $slug = \Str::slug($this->name); // Generate the slug
    
        $action = $this->priceId ? 'priceUpdated' : 'priceAdded';
    
        Price::updateOrCreate(['id' => $this->priceId], [
            'name' => $this->name,
            'slug' => $slug, // Add the slug field here
        ]);
    
        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->priceId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->priceId = null;
    }

    public function render()
    {
        $prices = Price::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-price', compact('prices'));
    }
}
