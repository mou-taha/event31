<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableCategory extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $categoryId;

    protected $listeners = [
        'categoryAdded' => 'refreshPermissions',
        'categoryUpdated' => 'refreshPermissions',
        'categoryDeleted' => '$refresh',
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

    public function delete($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();

        $this->dispatch('categoryDeleted');
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
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:30|unique:categories,name,' . $this->categoryId,
        ]);
    
        $slug = \Str::slug($this->name); // Generate the slug
    
        $action = $this->categoryId ? 'categoryUpdated' : 'categoryAdded';
    
        Category::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
            'slug' => $slug, // Add the slug field here
        ]);
    
        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->categoryId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->categoryId = null;
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-category', compact('categories'));
    }
}
