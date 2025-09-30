
<div class="px-4 sm:px-6 mt-6 lg:px-8">
    @canany(['Lire Role', 'Créer Role', 'Modifier Role', 'Supprimer Role'])
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Rôles</h1>
            <p class="mt-2 text-sm text-gray-700">Liste des rôles</p>
        </div>
        @can('Créer Role')
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <button type="button" wire:click="create()" class="block rounded-md bg-emerald-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Ajouter un rôle</button>     
        </div>
        @endcan
        @if($isOpen)
        <div x-data="{ modalOpen: @entangle('isOpen') }" x-show="modalOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="modalOpen = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <form wire:submit.prevent="store" class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Ajouter un rôle</h3>
                        <div class="mt-2">
                            <input type="text" wire:model="name" placeholder="Nom du rôle" id="role" name="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div x-data="multiSelectCombobox(@entangle('selectedPermissions'), {{ json_encode($permissions) }})" class="mt-4">
                            <label for="combobox" class="block text-sm font-medium text-gray-900">Permissions</label>
                            <div class="relative mt-2">
                                <input id="combobox" type="text" x-model="search" @focus="open = true" @input="filterOptions" class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6" placeholder="Trouver une permission" role="combobox" aria-controls="options" aria-expanded="false">
                                <button type="button" @click="toggleOpen" class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <ul x-show="open" @click.away="open = false" class="absolute z-50 mt-1 max-h-28 w-full overflow-y-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" id="options" role="listbox">
                                    <template x-for="(option, index) in filteredOptions" :key="option.id">
                                        <li @click="selectOption(option)" class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900" :id="'option-' + index" role="option" :aria-selected="selectedOptions.includes(option.id)">
                                            <span class="block truncate" x-text="option.name"></span>
                                            <span x-show="selectedOptions.includes(option.id)" class="absolute inset-y-0 right-0 flex items-center pr-4 text-emerald-600">
                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                            <div class="mt-2">
                                <template x-for="option in selectedOptionsObjects" :key="option.id">
                                    <span class="inline-flex items-center px-2.5 mr-1 py-0.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                        <span x-text="option.name"></span>
                                        <button @click="removeOption(option)" type="button" class="ml-1 inline-flex h-4 w-4 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                            <svg class="h-4 w-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 3a7 7 0 100 14 7 7 0 000-14zm3.53 10.47a.75.75 0 01-1.06 1.06L10 11.06l-2.47 2.47a.75.75 0 01-1.06-1.06L8.94 10 6.47 7.53a.75.75 0 111.06-1.06L10 8.94l2.47-2.47a.75.75 0 111.06 1.06L11.06 10l2.47 2.47z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </span>
                                </template>
                            </div>
                            <input type="hidden" name="selectedPermissions" :value="JSON.stringify(selectedPermissions)">
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 flex justify-end space-x-3">
                        <button type="button" @click="modalOpen = false" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">Fermer</button>
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm">Valider</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    <div class="mt-8 z-10 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div>
                <section class="mt-1 mb-4">
                    <div class="mx-auto max-w-screen-xl px-4 lg:px-8">
                        <div class="relative w-2/5 md:w-1/5">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M2 8a6 6 0 1111.742 3.452l4.816 4.816a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
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
                                                'displayName' => 'Nom du rôle'
                                            ])
                                            <th scope="col" class="px-4 py-3">Permissions du rôle</th>
                                            <th scope="col" class="px-4 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr wire:key="{{ $role->id }}" class="border-b">
                                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $role->name }}
                                                </th>
                                                <td class="px-4 py-3">
                                                    @if($role->permissions->isEmpty())
                                                    <span class="text-gray-900 font-semibold">There are no permissions</span>
                                                @else
                                                    @php
                                                        $permissions = $role->permissions->pluck('name')->toArray();
                                                    @endphp
                                                    @foreach(array_slice($permissions, 0, 2) as $permission)
                                                        <button type="button" wire:click="showAllPermissions({{ $role->id }})" class="rounded-md mr-0.5 bg-emerald-500 px-1 text-sm font-medium text-white shadow-sm">
                                                            {{ $permission }}
                                                        </button>
                                                    @endforeach
                                                    @if(count($permissions) > 2)
                                                        <button type="button" wire:click="showAllPermissions({{ $role->id }})" class="rounded-md bg-emerald-500 px-1 text-sm font-medium text-white shadow-sm">
                                                           +
                                                        </button>
                                                    @endif
                                                @endif
                                                </td>
                                                <td class="px-4 py-3 flex items-center justify-end">
                                                    @can('Modifier Role')
                                                    <button wire:click="edit({{ $role->id }})" class="text-blue-500 pr-4 font-extrabold hover:text-blue-800">Editer</button>
                                                    @endcan
                                                    @can('Supprimer Role')              
                                                    <button wire:click="delete({{ $role->id }})" class="text-red-500 font-extrabold hover:text-red-800">Supprimer</button>
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
                                        <select wire:model.live='perPage' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5">
                                            <option value="5">5</option>
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <div x-data="{ show: false, message: '' }" x-cloak x-show="show" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @notification.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)" class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">Operation completed successfully</p>
                        </div>
                        <div class="ml-4 flex flex-shrink-0">
                            <button @click="show = false" type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
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
    @if($isModalOpen)
    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Permissions for {{ $roleName }}
                            </h3>
                            <div class="mt-2">
                                <ul class="list-disc pl-5">
                                    @foreach($allPermissions as $permission)
                                        <li>{{ $permission }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('notification', (event) => {
                console.log(event.message);
            });
        });
    </script>
<script>
    function multiSelectCombobox(selectedPermissions, permissions) {
        return {
            search: '',
            open: false,
            options: permissions,
            selectedPermissions: selectedPermissions,
            filteredOptions: permissions,
            get selectedOptions() {
                return this.selectedPermissions;
            },
            get selectedOptionsObjects() {
                return this.selectedPermissions.map(id => this.options.find(option => option.id === id));
            },
            filterOptions() {
                this.filteredOptions = this.options.filter(option => option.name.toLowerCase().includes(this.search.toLowerCase()));
            },
            selectOption(option) {
                if (this.selectedPermissions.includes(option.id)) {
                    this.selectedPermissions = this.selectedPermissions.filter(id => id !== option.id);
                } else {
                    this.selectedPermissions.push(option.id);
                }
                this.search = '';
                this.open = false;
            },
            removeOption(option) {
                this.selectedPermissions = this.selectedPermissions.filter(id => id !== option.id);
            },
            toggleOpen() {
                this.open = !this.open;
            }
        };
    }
    </script>
    @endcanany
</div>
