<div class="mt-4">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="store" >
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
                <div class="divide-y divide-gray-200 lg:col-span-12">
                    <!-- Profile section -->
                    <div class="px-4 py-1 sm:p-4">
                        <div class="mt-2 flex flex-col lg:flex-row">
                            <div class="flex-grow space-y-6">
                                <div class="grid grid-cols-12 gap-6">
                                    {{--debut combo--}}
                                    <div class="col-span-12 sm:col-span-9">
                                        @livewire('dependent-dropdown', ['selectedMenu' => $menu_id, 'selectedType' => $type_id, 'selectedSubtype' => $subtype_id])
                                    </div>
                                    {{--fin combo--}}

                                    {{--debut organism--}}
                                    <div class="col-span-12 sm:col-span-3">

                                        <label for="organism" class="block text-sm  font-medium text-gray-700">Organisme</label>
                                        <div x-data="singleSelectCombobox(@entangle('selectedOrganism'), {{ json_encode($organisms) }})" class="relative mt-2">
                                            <input 
                                                id="organismCombobox" 
                                                type="text" 
                                                x-model="search" 
                                                @focus="open = true" 
                                                @input="filterOptions" 
                                                class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6" 
                                                placeholder="rechercher un organisme..." 
                                                aria-controls="options" 
                                                aria-expanded="false"
                                                :value="selectedOrganismObject ? selectedOrganismObject.name : ''"
                                                autocomplete="off"
                                            >
                                            <button type="button" @click="toggleOpen" class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <ul x-show="open" class="absolute z-50 mt-1 max-h-28 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" id="options" role="listbox">
                                                <template x-for="(option, index) in filteredOptions" :key="option.id">
                                                    <li @click="selectOption(option)" class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900" :id="'option-' + index"  :aria-selected="selectedOrganism === option.id">
                                                        <span class="block truncate" x-text="option.name"></span>
                                                        <span x-show="selectedOrganism === option.id" class="absolute inset-y-0 right-0 flex items-center pr-4 text-emerald-600">
                                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M16.704 5.296a.75.75 0 00-1.06-1.06l-8 8a.75.75 0 001.06 1.06l8-8z" clip-rule="evenodd" />
                                                            </svg>
                                                        </span>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                        <x-input-error :messages="$errors->get('selectedOrganism')" />
                                    </div>
                                    {{--fin organism--}}

                                    {{--debut title--}}
                                    <div class="col-span-12 sm:col-span-4">
                                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Titre<span class="text-red-500">*</span></label>
                                        <div class="flex rounded-md shadow-sm">
                                            <x-text-input wire:model="title" id="title" name="title" type="text" class="mt-1 block w-full" autofocus  />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('title')" />

                                    </div>
                                    {{--fin title--}}

                                    {{--debut subtitle--}}
                                    <div class="col-span-12 sm:col-span-4">
                                        <label for="subtitle" class="block text-sm font-medium leading-6 text-gray-900">Sous-titre</label>
                                        <div class="flex rounded-md shadow-sm">
                                            <x-text-input wire:model="subtitle" id="subtitle" name="subtitle" type="text" class="mt-1 block w-full" autofocus  />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('subtitle')" />

                                    </div>
                                    {{--fin subtitle--}}
                                    <div class="col-span-12 sm:col-span-4">
                                        <label for="link" class="block text-sm font-medium leading-6 text-gray-900">Lien</label>
                                        <div class="flex rounded-md shadow-sm">
                                            <x-text-input wire:model="link" id="link" name="link" type="text" class="mt-1 block w-full" autofocus  />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('link')" />

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Action buttons -->
                </div>
            </div>
        </div>
        <div class="overflow-hidden mt-4 rounded-lg bg-white shadow">
            <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
                <div class="divide-y divide-gray-200 lg:col-span-12">
                    <div class="px-4 py-1 sm:p-4">
                        <div class="mt-2 flex flex-col lg:flex-row">
                            <div class="flex-grow space-y-6">
                                <div class="grid grid-cols-12 gap-6">
                                    {{--debut content--}}
                                    <div class="col-span-12 sm:col-span-8">
                                        <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Contenu<span class="text-red-500">*</span></label>
                                        <div class="mt-2">
                                            <textarea wire:model="content" id="content" name="content" rows="8" class="mt-[8px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"></textarea>
                                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                                        </div>
                                    </div>
                                    {{--fin content--}}
                                    <div class="col-span-12 sm:col-span-4 mb-4">
                                        <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Image<span class="text-red-500">*</span></label>
                                    
                                        <div class="relative mt-2 flex flex-col items-center justify-center w-full h-[204px] border border-gray-300 rounded-lg bg-gray-50">
                                            @if ($previewImageUrl)
                                                <img src="{{ $previewImageUrl }}" alt="Preview" class="object-cover w-full h-full rounded-lg" id="image-preview">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full">
                                                    <div wire:loading wire:target="newImage">
                                                        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-emerald-600"></div>
                                                    </div>
                                                    <span class="animate-bounce text-sm text-gray-400" wire:loading.remove wire:target="newImage">No image selected</span>
                                                </div>
                                            @endif
                                            <input wire:model="newImage" type="file" id="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('newImage')" />
                                    </div>
                                    
                                    

                                    
                                    
                                    
                                    

                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <div class="overflow-hidden mt-4 rounded-lg bg-white shadow">
            <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
                <div class="divide-y divide-gray-200 lg:col-span-12">
                    <div class="px-4 py-1 sm:p-4">
                        <div class="flex flex-col lg:flex-row">
                            <div class="flex-grow space-y-6">
                                <div class="flex justify-between my-2 md:my-0">
                                    <h2 class="text-xl font-semibold leading-7 text-gray-900">Ajouter un ou plusieurs prix si l'évènement est payant<h2>
                                    <div class="flex">
                                    @can('Créer Access')
                                        @livewire('add-price')
                                    @endcan
                                    <button type="button" wire:click="addPrice" class="inline-flex items-center gap-x-1 rounded-md bg-emerald-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>                                          
                                          Ajouter un prix
                                    </button>
                                    </div>
                                </div>
                                    {{--debut price--}}
                                    @foreach ($selectedPrices as $index => $selectedPrice)
                                    <div class="col-span-12 sm:col-span-6" wire:key="price-{{ $selectedPrice['id'] ?? $index }}">
                                        <div>
                                            <div class="flex space-x-2">
                                                <div class="flex-grow">
                                                    <label for="price_{{ $selectedPrice['id'] ?? $index }}" class="mt-1 block text-sm font-medium text-gray-700">Prix</label>
                                                    <select id="price_{{ $selectedPrice['id'] ?? $index }}" wire:model="selectedPrices.{{ $index }}.price_id" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-0 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6">
                                                        <option value="">Sélectionnez un prix</option>
                                                        @foreach ($prices as $price)
                                                            <option value="{{ $price->id }}">{{ $price->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="flex-grow">
                                                    <label for="cost_{{ $selectedPrice['id'] ?? $index }}" class="mt-1 block text-sm font-medium text-gray-700">Coût</label>
                                                    <input type="text" id="cost_{{ $selectedPrice['id'] ?? $index }}" wire:model="selectedPrices.{{ $index }}.cost" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-0 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6" />
                                                </div>
                                                <div class="flex items-end">
                                                    <button type="button" wire:click="removePrice('{{ $selectedPrice['id'] ?? $index }}')" aria-controls="{{ $index }}" class="mt-2 bg-red-500 text-white block w-full rounded-md border-0 px-3 mr-2 py-1.5 sm:text-sm sm:leading-6">Retirer</button>
                                                </div>
                                            </div>
                                            <x-input-error :messages="$errors->get('selectedPrices.*.price_id')" />
                                            <x-input-error :messages="$errors->get('selectedPrices.*.cost')" />
                                        </div>
                                    </div>
                                    @endforeach
                                
                                
                                    {{--fin price--}}
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <div class="overflow-hidden mt-4 rounded-lg bg-white shadow">
            <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
                <div class="divide-y divide-gray-200 lg:col-span-12">
                    <div class="px-4 py-1 sm:p-4">
                        <div class="flex flex-col lg:flex-row">
                            <div class="flex-grow space-y-6">
                                <div class="flex justify-between my-2 md:my-0">
                                    <h2 class="text-xl font-semibold leading-7 text-gray-900">Ajouter un ou plusieurs emplacements à l'évènement</h2>
                                    <div class="flex">
                                    @can('Créer Ville')
                                      @livewire('add-city')
                                    @endcan 
                                    <button type="button" wire:click.prevent="addPhysical" class="inline-flex items-center gap-x-1 rounded-md bg-emerald-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                          </svg>
                                          Ajouter un lieu
                                    </button>
                                    </div>
                                </div>
                                @foreach($physicals as $index => $physical)
                                <div class="grid grid-cols-12 gap-6 overflow-hidden rounded-xl ring-1 ring-gray-900/10 shadow-sm p-6 relative mb-4">
                                       
                                        <div class="col-span-12 sm:col-span-4 mt-1">
                                            <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                                            <div class="flex space-x-1">
                                                <div class="flex-grow">
                                                    <select wire:model="physicals.{{ $index }}.city_id" id="physical-city-{{ $index }}" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-0 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6">
                                                        <option value="">Sélectionnez une ville</option>
                                                        @foreach($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>  
                                            <x-input-error :messages="$errors->get('physicals.' . $index . '.city_id')" />
                                            </div>                                        
                                        <div class="col-span-12 sm:col-span-4 relative mb-2">
                                            <label for="address_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Adresse</label>
                                            <x-text-input wire:model="physicals.{{ $index }}.address" id="address_{{ $index }}" name="address" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('physicals.' . $index . '.address')" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-4 relative mb-2">
                                            <label for="longitude_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Longitude</label>
                                            <x-text-input wire:model="physicals.{{ $index }}.longitude" id="longitude_{{ $index }}" name="longitude" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('physicals.' . $index . '.longitude')" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-4 relative mb-2">
                                            <label for="latitude_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Latitude</label>
                                            <x-text-input wire:model="physicals.{{ $index }}.latitude" id="latitude_{{ $index }}" name="latitude" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('physicals.' . $index . '.latitude')" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-4 relative mb-2">
                                            <label for="datestart_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Date début</label>
                                            <x-text-input wire:model="physicals.{{ $index }}.datestart" id="datestart_{{ $index }}" name="datestart" type="datetime-local" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('physicals.' . $index . '.datestart')" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-4 relative mb-2">
                                            <div class="flex justify-between items-center">
                                                <label for="dateend_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Date fin</label>
                                                <div class="flex justify-start items-center">
                                                    <input type="checkbox" wire:model="physicals.{{ $index }}.hide" 
                                                    class="mt-0.5 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-600"
                                                    value="1"
                                                    {{ $physicals[$index]['hide'] == 1 ? 'checked' : '' }}>                                                    
                                                    <span class="block text-sm ml-1 font-medium leading-6 text-red-600">Cochez pour masquer les dates</span>
                                                </div>

                                            </div>
                                            <x-text-input wire:model="physicals.{{ $index }}.dateend" id="dateend_{{ $index }}" name="dateend" type="datetime-local" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('physicals.' . $index . '.dateend')" />
                                        </div>
                                        <button type="button" wire:click.prevent="removePhysical({{ $index }})" class="absolute top-2 right-2 rounded-full bg-red-600 pb-1 px-[11px] py-[1px] text-white text-base shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                            x
                                        </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <div class="overflow-hidden mt-4 rounded-lg bg-white shadow">
            <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
                <div class="divide-y divide-gray-200 lg:col-span-12">
                    <div class="px-4 py-1 sm:p-4">
                        <div class="flex flex-col lg:flex-row">
                            <div class="flex-grow space-y-6">
                                <div class="flex justify-between my-2 md:my-0">
                                    <h2 class="text-xl font-semibold leading-7 text-gray-900">Ajouter un ou plusieurs liens si l'événement est virtuel</span></h2>
                                    <button type="button" wire:click.prevent="addVirtual()" class="inline-flex items-center gap-x-1 rounded-md bg-emerald-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                          </svg>
                                          
                                          Ajouter un lien
                                    </button>
                                </div>
                                @foreach($virtuals as $index => $virtual)
                                <div class="grid grid-cols-12 gap-6 overflow-hidden rounded-xl ring-1 ring-gray-900/10 shadow-sm p-6 relative mb-4">
                                       
                                    <div class="col-span-12 sm:col-span-6 relative mb-2">
                                        <label for="link_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Lien</label>
                                        <x-text-input wire:model="virtuals.{{ $index }}.link" id="link_{{ $index }}" name="link_{{ $index }}" type="text" class="mt-1 block w-full" autofocus  />
                                        <x-input-error class="mt-2" :messages="$errors->get('virtuals.' . $index . '.link')" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 relative mb-2">
                                        <label for="content_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Contenu</label>
                                        <x-text-input wire:model="virtuals.{{ $index }}.content" id="content_{{ $index }}" name="content_{{ $index }}" type="text" class="mt-1 block w-full" autofocus  />
                                        <x-input-error class="mt-2" :messages="$errors->get('virtuals.' . $index . '.content')" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 relative mb-6">
                                        <label for="datestart_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Date début</label>
                                        <x-text-input wire:model="virtuals.{{ $index }}.datestart" id="datestart_{{ $index }}" name="datestart_{{ $index }}" type="datetime-local" class="mt-1 block w-full" autofocus  />
                                        <x-input-error class="mt-2" :messages="$errors->get('virtuals.' . $index . '.datestart')" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 relative mb-6">
                                        <div class="flex justify-between items-center">
                                            <label for="dateend_{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Date fin</label>
                                            <div class="flex justify-start items-center">
                                                <input type="checkbox" wire:model="virtuals.{{ $index }}.hide" 
                                                class="mt-0.5 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-600"
                                                value="1"
                                                {{ $virtuals[$index]['hide'] == 1 ? 'checked' : '' }}>                                                
                                                <span class="block text-sm ml-1 font-medium leading-6 text-red-600">Cochez pour masquer les dates</span>
                                            </div>

                                        </div>
                                        <x-text-input wire:model="virtuals.{{ $index }}.dateend" id="dateend_{{ $index }}" name="dateend_{{ $index }}" type="datetime-local" class="mt-1 block w-full" autofocus  />
                                        <x-input-error class="mt-2" :messages="$errors->get('virtuals.' . $index . '.dateend')" />
                                    </div>
                                        <button type="button" wire:click.prevent="removeVirtual({{ $index }})" class="absolute top-2 right-2 rounded-full bg-red-600 pb-1 px-[11px] py-[1px] text-white text-base shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                            x
                                        </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <div class="overflow-hidden mt-4 rounded-lg bg-white shadow">
            <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
                <div class="divide-y divide-gray-200 lg:col-span-12">

                    <div class="px-4 py-3 sm:px-6 flex items-center justify-between">
                    @if ($isEditMode)
                        @can('Lire Utilisateur')
                        <div class="flex items-center">
                            <p class="text-md mr-4 font-semibold"> Publié par {{ $event->user->username }}</p>
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
                            <button 
                                type="button"
                                class="ml-4 px-3 py-1  hidden md:flex text-sm font-medium rounded-full {{ $event->confirmed ? 'bg-emerald-500 text-white hover:bg-emerald-700' : 'bg-red-500 text-white hover:bg-red-700' }} transition-colors duration-200 ease-in-out"
                            >
                                {{ $event->confirmed ? 'Vérifié' : 'Non vérifié' }}
                            </button>
                        </div>
                        @endcan
                    @endif
                        <div class="ml-2 flex">
                            <a  href="" class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Annuler</a>
                            <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-emerald-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Sauvegarder</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    </div>
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <div 
                x-data="{ show: false, message: '' }"
                x-show="show"
                x-cloak
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @notification.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
            >
            <a  href="{{route('events')}}" class="inline-flex justify-center rounded-md sr-only bg-white px-5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Retour</a>

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
        document.addEventListener('clickRetourLink', () => {
            document.querySelector('a[href="{{ route('events') }}"]').click();
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('notification', (event) => {
                console.log(event.message);
            });
        });
    </script>
    <script>
        function singleSelectCombobox(selectedOrganism, organisms) {
            return {
                search: '',
                open: false,
                organisms: organisms,
                selectedOrganism: selectedOrganism,
                filteredOptions: organisms,
                filterOptions() {
                    this.filteredOptions = this.organisms.filter(organism => organism.name.toLowerCase().includes(this.search.toLowerCase()));
                },
                selectOption(option) {
                    this.selectedOrganism = option.id;
                    this.search = option.name;
                    this.open = false;
                },
                toggleOpen() {
                    this.open = !this.open;
                },
                reset() {
                    this.selectedOrganism = null;
                    this.search = '';
                }
            };
        }
    
        document.addEventListener('livewire:load', function () {
            Livewire.on('resetFields', () => {
                const comboboxComponent = document.getElementById('organismCombobox')._x_dataStack[0];
                comboboxComponent.reset();
            });
        });
    </script>

        <script src="https://unpkg.com/cropperjs/dist/cropper.js"></script>

</div>