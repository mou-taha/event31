<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class ManagePermission extends Component
{
    public $permissions, $name, $permission_id;
    public $isOpen = 0;


    public function render()
    {
        $this->permissions = Permission::all();
        return view('livewire.manage-permission');
    }



    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->permission_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Permission::updateOrCreate(['id' => $this->permission_id], ['name' => $this->name]);

        session()->flash('message', $this->permission_id ? 'Permission mise à jour.' : 'Permission crée avec succès.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permission_id = $id;
        $this->name = $permission->name;

        $this->openModal();
    }

    public function delete($id)
    {
        Permission::find($id)->delete();
        session()->flash('message', 'Permission supprimée avec succès.');
    }
}
