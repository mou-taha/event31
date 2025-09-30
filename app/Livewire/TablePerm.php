<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TablePerm extends Component
{

    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $permissionId;

    protected $listeners = [
        'permissionAdded' => 'refreshPermissions',
        'permissionUpdated' => 'refreshPermissions',
        'permissionDeleted' => '$refresh',
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

    public function delete($permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->delete();

        $this->dispatch('permissionDeleted');
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
        $permission = Permission::findOrFail($id);
        $this->permissionId = $id;
        $this->name = $permission->name;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:50|unique:permissions,name,' . $this->permissionId,
        ]);

        $action = $this->permissionId ? 'permissionUpdated' : 'permissionAdded';

        Permission::updateOrCreate(['id' => $this->permissionId], [
            'name' => $this->name,
        ]);

        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->permissionId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->permissionId = null;
    }

    public function render()
    {
        $permissions = Permission::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-perm', compact('permissions'));
    }
}
