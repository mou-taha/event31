<div class="px-4 sm:px-6 mt-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Publications</h1>
            <p class="mt-2 text-sm text-gray-700">Liste des publications</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
          <a  href="{{route('inputevent')}}" class="block rounded-md bg-emerald-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Ajouter une publication</a>     
        </div>
        @if($isOpen)
            <div  x-data="{ modalOpen: @entangle('isOpen') }" x-show="modalOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-name" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="modalOpen = false" aria-hidden="true"></div>
        
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
                    <form class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-name">Ajouter une publication</h3>
                            <div class="mt-2">
                                <input type="text" wire:model="title" placeholder="titre de la publication" id="event" name="event" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                <input wire:model.live.debounce.300ms="search" type="text" name="title" id="title" class="rounded-md peer block w-full border-0 bg-white py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Chercher ..." required="">
                                <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focus:border-emerald-600" aria-hidden="true"></div>
                            </div>
                        </div>
                        <div class="bg-white mt-4 relative shadow-md sm:rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-sm text-gray-700 bg-gray-50">
                                        <tr>
                                            @include('livewire.includes.table-sortable-th', [
                                                'name' => 'title',
                                                'displayName' => 'Titre de la publication'
                                            ])
                                            <th scope="col" class="px-4 py-3">Dates d'événements</th>
                                            <th scope="col" class="px-4 py-3">Date de mise à jour</th>
                                            @can('Lire Utilisateur')
                                            <th scope="col" class="px-4 py-3">Activée</th>
                                            @endcan
                                            <th scope="col" class="px-4 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr wire:key="{{ $event->id }}" class="border-b">
                                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $event->title }}
                                                </th>
                                                <td class="px-4 py-3">
                                                    <button 
                                                        type="button"
                                                        wire:click="showDates({{ $event->id }})"
                                                        class="text-emerald-600 hover:underline"
                                                    >
                                                    Dates d'événement
                                                    </button>
                                                </td>                                              <td class="px-4 py-3">{{ $event->updated_at }}</td>
                                                @can('Lire Utilisateur')
                                                <td class="px-4 py-3">
                                                    <button 
                                                        type="button" 
                                                        wire:click="toggleConfirmation({{ $event->id }})"
                                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent {{ $event->confirmed ? 'bg-emerald-600' : 'bg-gray-200' }} transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2" 
                                                        role="switch" 
                                                        aria-checked="{{ $event->confirmed ? 'true' : 'false' }}"
                                                    >
                                                        <span class="sr-only"></span>
                                                        <span 
                                                            class="pointer-events-none relative inline-block h-5 w-5 {{ $event->confirmed ? 'translate-x-5' : 'translate-x-0' }} transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                                        >
                                                            <span 
                                                                class="absolute inset-0 flex h-full w-full items-center justify-center {{ $event->confirmed ? 'opacity-0 duration-100 ease-out' : 'opacity-100 duration-200 ease-in' }} transition-opacity" 
                                                                aria-hidden="true"
                                                            >
                                                                <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                                                    <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            <span 
                                                                class="absolute inset-0 flex h-full w-full items-center justify-center {{ $event->confirmed ? 'opacity-100 duration-200 ease-in' : 'opacity-0 duration-100 ease-out' }} transition-opacity" 
                                                                aria-hidden="true"
                                                            >
                                                                <svg class="h-3 w-3 text-emerald-600" fill="currentColor" viewBox="0 0 12 12">
                                                                    <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </button>
                                                </td>
                                                @endcan
                                                <td class="px-4 py-3 flex items-center justify-end">
                                                <button 
                                                    type="button"
                                                    class="mr-4 px-3 py-1 text-sm font-medium rounded-full {{ $event->confirmed ? 'bg-emerald-500 text-white hover:bg-emerald-700' : 'bg-red-500 text-white hover:bg-red-700' }} transition-colors duration-200 ease-in-out"
                                                >
                                                    {{ $event->confirmed ? 'Vérifié' : 'Non vérifié' }}
                                                </button>
                                                    <a  href="{{ route('inputevent', ['id' => $event->id]) }}" class="text-blue-500 pr-4 font-extrabold hover:text-blue-800">Editer</a>
                                                    <button wire:click="delete({{ $event->id }})" class="text-red-500 font-extrabold hover:text-red-800">Supprimer</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($showModal)
                                    <div class="fixed inset-0 z-10 flex items-center justify-center">
                                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                        </div>
                                        
                                        <!-- Modal content -->
                                        <div class="bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                            <div>
                                                <div class="mt-3 text-left sm:mt-5">
                                                    <h3 class="text-xl leading-6 font-medium text-gray-900">
                                                        Dates d'événement
                                                    </h3>
                                                    <div class="mt-2">
                                                        @foreach($modalData['virtuals'] as $virtual)
                                                            <p class="mt-1">
                                                                <span class="text-emerald-600">Virtuel:</span> 
                                                                {{ \Carbon\Carbon::parse($virtual->datestart)->format('Y-m-d') }}
                                                                @if($virtual->dateend)
                                                                    au {{ \Carbon\Carbon::parse($virtual->dateend)->format('Y-m-d') }}
                                                                @endif
                                                            </p>
                                                        @endforeach
                                                        @foreach($modalData['physicals'] as $physical)
                                                            <p class="mt-1">
                                                                <span class="text-emerald-600">Physique:</span> 
                                                                {{ \Carbon\Carbon::parse($physical->datestart)->format('Y-m-d') }}
                                                                @if($physical->dateend)
                                                                    au {{ \Carbon\Carbon::parse($physical->dateend)->format('Y-m-d') }}
                                                                @endif
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-5 sm:mt-6">
                                                <button 
                                                    type="button" 
                                                    wire:click="closeModal" 
                                                    class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:text-sm"
                                                >
                                                    Fermer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                {{ $events->links() }}
                            </div>
                        </div>
                    </div>
                </section>
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
</div>
