<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

new class extends Component
{
    public $permission;
    public $permissionName;
    public $permissionId;

    protected $rules = [
        'permissionName' => 'required|string|max:255|unique:permissions,name,' . 'permissionId', // Ensure unique validation ignores current permission ID
    ];

    public function mount($permissionId)
    {
        $this->permission = Permission::findOrFail($permissionId);
        $this->permissionName = $this->permission->name;
        $this->permissionId = $permissionId;
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
        $this->dispatch('close-modal-' . $this->permissionId);
    }


    public function render()
    {
        return view('livewire.create-permission-edit');
    }
}
 ?>
<div x-data="{ open: false, showMessage: false }" x-cloak 
@open-modal-{{ $permission->id }}.window="open = true" 
@close-modal-{{ $permission->id }}.window="open = false">

<!-- Button to open modal -->
<button
type="button" @click="open = true"
onclick=""
wire:click=""
class="px-2 mr-1 py-[6px] bg-blue-500 text-white rounded">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg>
</button>
<div x-show="showMessage" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed top-0 right-0 mt-4 mr-4 bg-emerald-500 text-white py-2 px-4 rounded shadow-lg">
   Permission updated successfully!
</div>

<!-- Modal -->
<div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
   <!-- Modal content -->
   <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
       <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
       <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
       <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
           <!-- Modal header -->
           <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Permission</h3>
           <!-- Modal content -->
           <div class="mt-2">
               <!-- Input for editing permission name -->
               <input type="text" wire:model="permissionName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
               @error('permissionName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
           </div>
           <!-- Modal footer -->
           <div class="mt-5 sm:mt-6 flex justify-end space-x-3">
               <!-- Close Button -->
               <button type="button" @click="open = false" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">Close</button>
               <!-- Save Button -->
               <button type="button" wire:click="updatePermission" @click="open = false; showMessage = true; setTimeout(() => { showMessage = false; }, 3000)" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">Save</button>
           </div>
       </div>
   </div>
</div>
</div>