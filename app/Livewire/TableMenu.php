<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableMenu extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $menuId;

    protected $listeners = [
        'menuAdded' => 'refreshPermissions',
        'menuUpdated' => 'refreshPermissions',
        'menuDeleted' => '$refresh',
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

    public function delete($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $menu->delete();

        $this->dispatch('menuDeleted');
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
        $menu = Menu::findOrFail($id);
        $this->menuId = $id;
        $this->name = $menu->name;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:30|unique:menus,name,' . $this->menuId,
        ]);
    
        $slug = \Str::slug($this->name); // Generate the slug
    
        $action = $this->menuId ? 'menuUpdated' : 'menuAdded';
    
        Menu::updateOrCreate(['id' => $this->menuId], [
            'name' => $this->name,
            'slug' => $slug, // Add the slug field here
        ]);
    
        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->menuId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->menuId = null;
    }

    public function render()
    {
        $menus = Menu::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-menu', compact('menus'));
    }
}
