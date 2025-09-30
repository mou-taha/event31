<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class CreatePermission extends Component
{

        public $permissionName;
    
        protected $rules = [
            'permissionName' => 'required|string|max:255|unique:permissions,name',
        ];
    
        public function savePermission()
        {
            $this->validate();
    
            $guardName = Str::slug($this->permissionName);
    
            Permission::create([
                'name' => $this->permissionName,
                'guard_name' => $guardName
            ]);
    
            // Clear the input
            $this->permissionName = '';
    
            // Dispatch events to refresh the permissions table and close the modal
            $this->dispatch('permissionAdded');
            $this->dispatch('close-modal');
            $this->dispatch('permissionCreated');

        }
    public function render()
    {
        return view('livewire.create-permission');
    }
}