<div class="px-4 sm:px-6 mt-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Permissions</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the permissions in your account</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
<livewire:create-permission
wire:refresh="refreshPermissions"
wire:poll.10s
@permissionAdded="refreshPermissions"
@closeModal="open = false"/>        
</div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <livewire:table-perm />

        </div>
    </div>
</div>