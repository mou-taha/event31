<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class CreatePermissionEdit extends Component
{
    public $permission;
    public $permissionName;

    protected $rules = [
        'permissionName' => 'required|string|max:255|unique:permissions,name',
    ];

    public function mount($permissionId)
    {
        $this->permission = Permission::findOrFail($permissionId);
        $this->permissionName = $this->permission->name;
    }

    public function updatePermission()
    {
        $this->validate();

        $guardName = Str::slug($this->permissionName);

        $this->permission->update([
            'name' => $this->permissionName,
            'guard_name' => $guardName
        ]);

        // Dispatch event to refresh the permissions table
        $this->dispatch('permissionUpdated');
        $this->dispatch('close-modal');
        $this->dispatch('permissionEdited');

    }

    public function render()
    {
        return view('livewire.create-permission-edit');
    }
}
