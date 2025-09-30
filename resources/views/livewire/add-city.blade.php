<div class="flex items-end">
    <button type="button" wire:click="create()" class="inline-flex items-center rounded-md bg-green-50 px-2.5 py-2 mr-2 text-sm font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
        Ajouter une ville
    </button>

        @if($isOpen)
            <div  x-data="{ modalOpen: @entangle('isOpen') }" x-show="modalOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="modalOpen = false" aria-hidden="true"></div>
        
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
                    <form class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add City</h3>
                            <div class="mt-2">
                                <input type="text" wire:model="name" placeholder="City Name" id="city" name="city" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 flex justify-end space-x-3">
                            <!-- Close Button -->
                            <button type="button" @click="modalOpen = false" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">Close</button>
                            <!-- Save Button -->
                            <button type="button" wire:click.prevent="store()" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>