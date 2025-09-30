<?php

namespace App\Livewire;

use Str;
use App\Models\Menu;
use App\Models\Type;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableType extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $typeId;
    public $selectedMenu; // Change from selectedRoles to selectedRole


    protected $listeners = [
        'typeAdded' => 'refreshPermissions',
        'typeUpdated' => 'refreshPermissions',
        'typeDeleted' => '$refresh',
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

    public function delete($typeId)
    {
        $type = Type::findOrFail($typeId);
        $type->delete();

        $this->dispatch('typeDeleted');
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
        $type = Type::findOrFail($id);
        $this->typeId = $id;
        $this->name = $type->name;
        $this->isOpen = true;
        $this->selectedMenu = $type->menu_id;
        $this->dispatch('updateSelectedMenu', $this->selectedMenu);

    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:30|unique:types,name,' . $this->typeId,
            'selectedMenu' => 'required|exists:menus,id',

        ]);
    
        $slug = Str::slug($this->name); // Generate the slug
    
        $data = [
            'name' => $this->name,
            'slug' => $slug,
            'menu_id' => $this->selectedMenu,
        ];

        $action = $this->typeId ? 'typeUpdated' : 'typeAdded';

        $type = Type::updateOrCreate(['id' => $this->typeId], $data);


        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('resetMenu'); // Emit browser event to reset category field
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->typeId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->typeId = null;
        $this->selectedMenu = null; // Reset selectedRole to null

    }

    public function render()
    {
        $types = Type::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $menus = Menu::all();

        return view('livewire.table-type', compact('types', 'menus'));
    }
}
