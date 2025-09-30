<div x-data="{ open: false, showMessage: false }" x-cloak @open-modal.window="open = true" @close-modal.window="open = false">
    <button type="button" @click="open = true" class="block rounded-md bg-emerald-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Add permission</button>
    <div x-show="showMessage" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed top-0 right-0 mt-4 mr-4 bg-emerald-500 text-white py-2 px-4 rounded shadow-lg">
        Permission created successfully!
    </div>
    <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add Permission</h3>
                    <div class="mt-2">
                        <input type="text" wire:model="permissionName" placeholder="Permission Name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                        @error('permissionName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 flex justify-end space-x-3">
                    <!-- Close Button -->
                    <button type="button" @click="open = false" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">Close</button>
                    <!-- Save Button -->
                    <button type="button" wire:click="savePermission" @click="open = false; showMessage = true; setTimeout(() => { showMessage = false; }, 3000)" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>