<div class="px-4 sm:px-6 mt-6 lg:px-8">
    @canany(['Lire Menu', 'Créer Menu', 'Modifier Menu', 'Supprimer Menu'])
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Menus</h1>
            <p class="mt-2 text-sm text-gray-700">Liste des menus</p>
        </div>
        @can('Créer Menu')
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
          <button type="button" wire:click="create()" class="block rounded-md bg-emerald-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Ajouter un menu</button>     
        </div>
        @endcan
        @if($isOpen)
            <div  x-data="{ modalOpen: @entangle('isOpen') }" x-show="modalOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="modalOpen = false" aria-hidden="true"></div>
        
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
                    <form class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Ajouter un menu</h3>
                            <div class="mt-2">
                                <input type="text" wire:model="name" placeholder="Nom du menu" id="menu" name="menu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 flex justify-end space-x-3">
                            <!-- Close Button -->
                            <button type="button" @click="modalOpen = false" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">Fermer</button>
                            <!-- Save Button -->
                            <button type="button" wire:click.prevent="store()" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div>
                <section class="mt-1 mb-4">
                    <div class="mx-auto max-w-screen-xl px-4 lg:px-8">
                        <!-- Start coding here -->
                        <div class="relative w-2/5 md:w-1/5">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-700" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="relative rounded-md shadow-md">
                                <input wire:model.live.debounce.300ms="search" type="text" name="name" id="name" class="rounded-md peer block w-full border-0 bg-white py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Chercher ..." required="">
                                <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focus:border-emerald-600" aria-hidden="true"></div>
                            </div>
                        </div>
                        <div class="bg-white mt-4 relative shadow-md sm:rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-sm text-gray-700 bg-gray-50">
                                        <tr>
                                            @include('livewire.includes.table-sortable-th', [
                                                'name' => 'name',
                                                'displayName' => 'Nom du menu'
                                            ])
                                            <th scope="col" class="px-4 py-3">Date de création</th>
                                            <th scope="col" class="px-4 py-3">Date de mise à jour</th>
                                            <th scope="col" class="px-4 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr wire:key="{{ $menu->id }}" class="border-b">
                                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $menu->name }}
                                                </th>
                                                <td class="px-4 py-3">{{ $menu->created_at }}</td>
                                                <td class="px-4 py-3">{{ $menu->updated_at }}</td>
                                                <td class="px-4 py-3 flex items-center justify-end">
                                                    @can('Modifier Menu')
                                                    <button wire:click="edit({{ $menu->id }})" class="text-blue-500 pr-4 font-extrabold hover:text-blue-800">Editer</button>
                                                    @endcan
                                                    @can('Supprimer Menu')
                                                    <button wire:click="delete({{ $menu->id }})" class="text-red-500 font-extrabold hover:text-red-800">Supprimer</button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="py-4 px-3">
                                <div class="flex">
                                    <div class="flex space-x-4 items-center mb-3">
                                        <label class="w-44 text-sm font-medium text-gray-900">Vue par page</label>
                                        <select wire:model.live='perPage' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="5">5</option>
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                {{ $menus->links() }}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <div 
                x-data="{ show: false, message: '' }"
                x-show="show"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @notification.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
            >
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">Opération effectuée avec succès</p>
                        </div>
                        <div class="ml-4 flex flex-shrink-0">
                            <button @click="show = false" type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">Close</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('notification', (event) => {
                console.log(event.message);
            });
        });
    </script>
    @endcanany
</div>
