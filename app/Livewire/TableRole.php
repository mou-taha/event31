<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class TableRole extends Component
{
    use WithPagination;

    public $message = '';
    public $isOpen = false;
    public $isModalOpen = false;
    public $name;
    public $roleId;
    public $roleName;
    public $allPermissions = [];

    public $permissions = [];
    public $selectedPermissions = [];

    protected $listeners = [
        'roleAdded' => 'refreshRoles',
        'roleUpdated' => 'refreshRoles',
        'roleDeleted' => '$refresh',
    ];

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 5;

    public function mount()
    {
        $this->search = '';
        $this->permissions = Permission::all(); // Load all permissions
    }

    public function refreshRoles()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();

        $this->dispatch('roleDeleted');
        $this->dispatch('notification', ['message' => 'Successfully deleted!']);
    }

    public function showAllPermissions($roleId)
    {
        $role = Role::findOrFail($roleId);
        $this->roleId = $roleId;
        $this->roleName = $role->name;
        $this->allPermissions = $role->permissions->pluck('name')->toArray();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
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
        $role = Role::findOrFail($id);
        $this->roleId = $id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:50|unique:roles,name,' . $this->roleId,
            'selectedPermissions' => 'required|array',
        ]);

        $action = $this->roleId ? 'roleUpdated' : 'roleAdded';

        $role = Role::updateOrCreate(['id' => $this->roleId], [
            'name' => $this->name,
        ]);

        // Ensure permissions are valid before syncing
        $validPermissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('id')->toArray();
        $role->syncPermissions($validPermissions);

        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->roleId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->roleId = null;
        $this->selectedPermissions = [];
    }

    public function render()
    {
        $roles = Role::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-role', compact('roles'));
    }
}