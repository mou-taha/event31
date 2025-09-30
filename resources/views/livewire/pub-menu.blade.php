<div x-data="{ sidebarOpen: false, menuOpen: false }" x-cloak class="h-full z-10 bg-gray-50">
    <header class="bg-white fixed top-0 left-0 right-0 z-30">
        
        @include('partials.default-nav')
    
            <!-- Menu centré -->
        <div class="hidden md:flex pb-3 pt-3 shadow-sm justify-center">
            <ul class="flex items-center space-x-6">
                <li class="relative">
                    <a  href="{{ route('index') }}" class="nav-link font-semibold {{ request()->routeIs('index') ? 'text-emerald-500 after:bg-emerald-500' : 'text-gray-500 after:bg-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:transition-all after:duration-300 hover:after:w-full">Accueil</a>
                </li>
                @foreach ($menus as $menu)
                  <li class="relative">
                      <a  href="{{ route('menus.index', ['id' => $menu->id]) }}"
                        id="menu-{{ $menu->id }}"
                        class="nav-link font-semibold 
                            {{ Request::segment(2) == $menu->id ? 'text-emerald-500 after:bg-emerald-500' : 'text-gray-500 after:bg-gray-500' }} 
                            text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:transition-all after:duration-300 hover:after:w-full">
                          {{ $menu->name }}
                      </a>
                  </li>
                @endforeach
                <li class="relative">
                    <a href="" class="nav-link font-semibold {{ request()->routeIs('blogs') ? 'text-emerald-500' : 'text-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-gray-500 after:transition-all after:duration-300 hover:after:w-full">Blogs</a>
                </li>
                <!-- <li class="relative">
                    <a href="#" class="bg-emerald-500 hover:bg-emerald-700 text-white px-4 pb-2 pt-1 text-md font-semibold rounded-md">Ajouter un event</a>
                </li> -->
            </ul>
        </div>
    </header>
    <!-- Sidebar -->
    <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true" x-cloak x-show="sidebarOpen" @click.away="sidebarOpen = false" style="display: none;">
      <div class="fixed inset-0 bg-gray-900/80"></div>
      <div class="fixed inset-0 flex">
        <div class="relative mr-16 flex w-full max-w-xs flex-1" x-show="sidebarOpen" style="display: block;">
            <!-- button to close the sidebar -->
          <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
            <button @click="sidebarOpen = false" type="button" class="-m-2.5 p-2.5">
              <span class="sr-only">Close sidebar</span>
              <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          {{-- Mobile sidebar components --}}
          <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-2 pb-4">
            <div class="flex w-full bg-emerald-400 h-8 mx-auto shrink-0 items-center">
              <p class="text-xl font-bold text-white mx-auto text-center">Recherche</p>
            </div>
            <nav class="flex flex-1 flex-col">
              <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                  <ul role="list" class="-mx-2 space-y-1">
                    <li class="px-2">
                      <!-- Search form -->
                      <form action="{{ route('index') }}" method="get" class="md:block">
                        <div class="relative mt-4 flex items-center">
                          <input type="text" name="search" id="search" value="{{request()->search}}" placeholder="Recherche rapide" class="block w-full rounded-md border-0 px-3 py-1 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6">
                          <div class="absolute inset-y-0 right-0 flex py-1 pr-1.5">
                            <button>
                              <kbd class="text-red-700 hover:text-emerald-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-3 text-2xl font-extrabold">
                                <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-700" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                              </kbd>
                            </button>
                          </div>
                        </div>
                      </form>
                    </li>
                    <form action="" method="get" class="md:block">
                      <li class="px-2 mt-2">
                        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Ville</label>
  
                        <div class="">
                          <select
                          id="city"
                          name="city"
                          class="block w-full shadow-sm rounded-md border-0 py-1.5 ring-gray-300 ring-1 focus:ring-2 ring-inset focus:ring-emerald-500 sm:max-w-xs sm:text-sm sm:leading-6 form-select"                    >
                          <option value="">Villes</option>
                          @foreach ($cities as $city)
                              <option>{{ $city->name }}</option>
                          @endforeach
                      </select>
                      </div>
                      </li>
                      <li class="px-2 mt-2">
                        <label for="publicationDatePickerr" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                          <x-input-flatpickr wire:model="birth" id="birth" class="flatpickr block bg-transparent mt-3 py-1.5 w-full" type="date" name="birth" placeholder="Séléctionnez une date"/>
                      </li>
                      <li class="px-2 mt-2">
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                        <div class="">
                          <select
                              id="type"
                              name="type"
                              @class([
                                  'block w-full shadow-sm rounded-md border-0 py-1.5 border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-emerald-500 sm:max-w-xs sm:text-sm sm:leading-6',
                                  'form-select'
                              ])
                          >
                          <option value="" disabled selected >Sélectionnez un type</option>
                          @foreach ($types as $type)
                           <option>{{ $type->name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </li>
                      <li class="px-2 mt-2">
                        <label for="Tout" class="block text-sm font-medium leading-6 text-gray-900">Prix</label>
                        <div class="">
                            <select
                                id="Tout"
                                name="Tout"
                                @class([
                                    'block w-full shadow-sm rounded-md border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-emerald-500 sm:max-w-xs sm:text-sm sm:leading-6',
                                    'form-select'
                                ])
                            >
                    
                                <option value="" >Tout</option>
                                <option value="gratuit">Gratuit</option>
                                <option value="premuim">Premium</option>
  
                    
                            </select>
                        </div>
                      </li>
                      <li class="px-2 mt-2">
                        <label for="trier" class="block text-sm font-medium leading-6 text-gray-900">Triér par :</label>
                        <div class="">
                            <select
                                id="trier"
                                name="trier"
                                @class([
                                    'block w-full shadow-sm rounded-md border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-emerald-500 sm:max-w-xs sm:text-sm sm:leading-6',
                                    'form-select'
                                ])
                            >
                                <option value="ds">Horaire</option>
                                <option value="pricemin">Prix ascendant</option>
                                <option value="pricemax">Prix descandant</option>
  
                    
                            </select>
                        </div>
                      </li>
                      <li class="px-2 mt-4">
                      <button type="submit" class="block w-full shadow-sm rounded-md border-0 py-1.5 text-white bg-emerald-500 hover:bg-emerald-500 sm:max-w-xs sm:text-sm sm:leading-6">
                          Mettre à jour
                      </button>  
                      </li>
                    </form>                    
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- mobile menu -->
    <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true" x-cloak x-show="menuOpen" @click.away="menuOpen = false" style="display: none;">
        <div class="fixed inset-0 bg-gray-900/80"></div>
        <div class="fixed inset-0 flex">
        <div class="relative mr-16 flex w-full max-w-xs flex-1" x-show="menuOpen" style="display: block;">
            <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
              <!-- button to close the menu -->
              <button @click="menuOpen = false" type="button" class="mt-0 ml-0">
                  <span class="sr-only">Close sidebar</span>
                  <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
              </button>
            </div>
            <!-- menu components -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white -pt-4 px-2 pb-4">
              <div class="flex w-full bg-emerald-400 h-8 mx-auto shrink-0 items-center">
                  <p class="text-xl font-bold text-white mx-auto text-center">Menu</p>
              </div>
              <nav class="flex flex-1 flex-col">
                  <ul role="list" class="flex flex-1 flex-col gap-y-7">
                  <li>
                      <ul role="list" class="-mx-2 space-y-2 px-2">
                      <li>
                          <a href="{{ route('index')}}" class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                          Accueil
                          </a>
                      </li>
                      @foreach ($menus as $menu)
                      <li>
                          <a  href="{{ route('menus.index', ['id' => $menu->id]) }}" class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                          {{ $menu->name }}
                          </a>
                      </li>
                      @endforeach
                      <li>
                          <a href="" class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                          Blog
                          </a>
                      </li>
                      </ul>
                  </li>
                  </ul>
              </nav>
            </div>
        </div>
        </div>
    </div> 
    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:top-[84px] lg:z-20 lg:flex lg:w-64 lg:flex-col">
      <div class="flex grow flex-col gap-y-5 shadow-lg  overflow-y-auto mt-2 px-3">
        <nav class="flex flex-1 flex-col">
          <div class="space-y-[10px] px-1">
            <p class="font-bold text-slate-900 mt-3 text-xl lg:text-2xl leading-tight pl-2 lg:pl-0">Filtre</p>

              <!-- Current: "bg-cyan-800 text-white", Default: "text-cyan-100 hover:bg-cyan-600 hover:text-white" -->
              <div class="w-full max-w-lg lg:max-w-xs">
                <label for="search" class="sr-only">Search</label>
                <div class="relative">
                  <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <input id="search" name="search" class="block w-full rounded-md border-0 bg-transparent py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6" placeholder="Recherche" type="search">
                </div>
              </div>
              <div>
                <x-input-label for="birth" :value="__('')" />
                <div x-data="singleSelectCombobox(@entangle('selectedCity'), {{ json_encode($cities) }})" class="relative mt-2">
                  <input 
                      id="cityCombobox" 
                      type="text" 
                      x-model="search" 
                      @focus="open = true" 
                      @input="filterOptions" 
                      class="w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6" 
                      placeholder="Sélectioner une ville" 
                      aria-controls="options" 
                      aria-expanded="false"
                      :value="selectedCityObject ? selectedCityObject.name : ''"
                      autocomplete="off"
                  >
                  <button type="button" @click="toggleOpen" class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                      <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                      </svg>
                  </button>
                  <ul x-show="open" class="absolute z-40 mt-1 max-h-28 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" id="options" role="listbox">
                      <template x-for="(option, index) in filteredOptions" :key="option.id">
                          <li @click="selectOption(option)" class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900" :id="'option-' + index"  :aria-selected="selectedCity === option.id">
                              <span class="block truncate" x-text="option.name"></span>
                              <span x-show="selectedCity === option.id" class="absolute inset-y-0 right-0 flex items-center pr-4 text-emerald-600">
                                  <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 5.296a.75.75 0 00-1.06-1.06l-8 8a.75.75 0 001.06 1.06l8-8z" clip-rule="evenodd" />
                                  </svg>
                              </span>
                          </li>
                      </template>
                  </ul>
                  </div>          
                    <x-input-error :messages="$errors->get('birth')" class="mt-2" />
              </div>        
              <div>
                <x-input-label for="birth" :value="__('')" />
                <x-input-flatpickr wire:model="birth" id="birth" class="flatpickr block bg-transparent mt-3 py-1.5 w-full" type="date" name="birth" placeholder="Séléctionnez une date"/>
                <x-input-error :messages="$errors->get('birth')" class="mt-2" />
              </div>
              <div>
                <div class="border border-gray-300 rounded-md relative mt-6">
                  <span class=" bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Type d'organisation</span>
                  <div class="block mt-3">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Présentielle') }}</span>
                    </label>
                  </div>
                  <div class="block mt-2">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Virtuelle') }}</span>
                    </label>
                  </div>
                </div>
              </div>
              <div>
                <div class="border border-gray-300 rounded-md relative mt-6">
                  <span class=" bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Type d'accès</span>
      
                  <div class="block mt-3">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Gratuit') }}</span>
                    </label>
                  </div>
                  <div class="block mt-2">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Payant') }}</span>
                    </label>
                  </div>
                </div>
              </div>
              <div>
                <div class="border border-gray-300 rounded-md relative mt-6">
                  <span class=" bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Trier par :</span>
      
                  <div class="block mt-3">
                    <label for="remember" class="inline-flex items-center">
                      <x-radio-input wire:model="sex" id="Femme" class="flex ml-2" type="radio" name="sex" value="Femme"/>
                      <x-input-label for="sex" :value="__('Horaire')" class="ml-3 flex" />
                    </label>
                  </div>
                  <div class="block mt-2">
                    <label for="remember" class="inline-flex items-center">
                      <x-radio-input wire:model="sex" id="Femme" class="flex ml-2" type="radio" name="sex" value="Femme"/>
                      <x-input-label for="sex" :value="__('Prix ascendant')" class="ml-3 flex" />
                    </label>
                  </div>
                  <div class="block mt-2">
                    <label for="remember" class="inline-flex items-center">
                      <x-radio-input wire:model="sex" id="Femme" class="flex ml-2" type="radio" name="sex" value="Femme"/>
                      <x-input-label for="sex" :value="__('Prix descendant')" class="ml-3 flex" />
                    </label>
                  </div>
                </div>
              </div>
          </div>
        </nav>
      </div>
    </div>
    <!-- Button to toggle the sidebar for mobile -->
    <div class="fixed top-[60px] z-20 bg-white flex flex-grow w-full items-center justify-between shadow-sm  md:hidden px-[2px]">


      <div class="items-center w-full h-10 mr-1 bg-white">
        <div class="scrollable-tabs-container">

          <ul>
            <li>
                <a  href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-900' }}">Accueil</a>
            </li>
            @foreach ($menus as $menu)
                <li>
                    <a  href="{{ route('menus.index', ['id' => $menu->id]) }}" class="{{ (request()->routeIs('menus.index') && request()->route('id') == $menu->id) ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-900' }}">{{ $menu->name }}</a>
                </li>
            @endforeach
        </ul>

      </div>
      </div>
  </div>
  <main class="py-10 mt-5 z-0 lg:pl-60 lg:mt-8 relative">
    <div class="px-4 sm:px-3 lg:px-4 pt-10 mx-0 lg:mx-16 relative">
      <div class="glide md:hidden">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            
            <li class="glide__slide justify-center grid grid-cols-8 gap-5 items-center">
              <button @click="sidebarOpen = true" type="button" class="text-gray-700 col-span-1 lg:hidden">
                <img x-show="!menuOpen" src="{{asset('svg/menu/search.svg')}}" alt="burger" class="w-4 ml-2">
                </button>
              <div class=" col-span-6">
                <form wire:submit.prevent="filterItems">
                  <select
                      wire:model="selectedCity"
                      id="city"
                      name="city"
                      class="rounded-md pr-7 pl-2 border-0 py-4 bg-transparent ring-transparent ring-1 focus:ring-2 ring-inset focus:ring-transparent sm:max-w-xs sm:text-sm sm:leading-6 form-select"
                      style="font-weight: 600 !important; font-size: 16px !important; color: #4B5563 !important;"
                  >
                      <option value="">Villes</option>
                      @foreach ($cities as $city)
                          <option value="{{ $city->id }}">{{ $city->name }}</option>
                      @endforeach
                  </select>
                  <button type="submit">Submit</button>
              </form>
            </div>
            </li>
          </ul>


        </div>
    </div>
              <div class="-mt-2">
                  @if(empty($items))
                    <div class="md:hidden mt-20 font-bold text-lg text-center">
                      <span class="text-emerald-500">Il n'y a aucun événement ce jour-là, vérifiez l'entrée en haut pour les autres jours vus ou </span>
                      <a id="right-arrow2" class="text-gray-500">cliquez ici</a>
                      <span class="text-emerald-500">pour vous déplacer au jour suivant</span>
                    </div>
                    @else
                    @foreach($items as $item)
                      {{-- debut du post --}}
                      <article class="flex flex-col lg:flex-row z-10 pb-6 my-5 md:pt-6 pl-0 sm:px-2 drop-shadow-md rounded-lg lg:px-4 bg-white relative">
                        <div class="flex flex-col-reverse lg:flex-row lg:w-6/12">
                          <div class="md:-ml-[14px] mt-2 md:mt-0 flex flex-row lg:flex-col justify-between">
                            <livewire:like-button :event-id="$item['event']->id" />
                            <a target="_blank" href="">
                              <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 mr-1 w-8 h-8" viewBox="0 0 24 24">
                                <path fill="#888888" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                              </svg>
                            </a>
                            <div x-data="{ isModalOpen: false }">
                              <button @click="isModalOpen = true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 mr-1 w-8 h-8" viewBox="0 0 24 24">
                                  <path fill="#888888" d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  <path fill="#888888" d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM7.5 4.5a.85.85 0 1 1 1.7 0a.85.85 0 0 1-1.7 0z"/>
                                </svg>
                              </button>
                              <div x-show="isModalOpen" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 flex items-center justify-center">
                                <div @click.away="isModalOpen = false" class="bg-white h-full w-full p-6 rounded-lg shadow-lg transform transition-all sm:w-full">
                                  <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                                    <button @click="isModalOpen = false" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                      <span class="sr-only">Close</span>
                                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                      </svg>
                                    </button>
                                  </div>
                                  <h2 class="text-lg font-bold mb-4 text-center">Plus d'informations</h2>
                                  <ul class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Ville :</span>
                                      <span class="text-gray-700">{{ $item['event']->ville ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Adresse :</span>
                                      <span class="text-gray-700">{{ $item['event']->adresse ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Poste de :</span>
                                      <span class="text-gray-700">{{ $item['type'] ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Date de :</span>
                                      <span class="text-gray-700">{{ $item['event']->date ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Heure de :</span>
                                      <span class="text-gray-700">{{ $item['event']->heure ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Type :</span>
                                      <span class="text-gray-700">{{ $item['type'] ?? 'N/A' }}</span>
                                    </li>

                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Menu :</span>
                                      <span class="text-gray-700">{{ $item['event']->menu->name ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Type :</span>
                                      <span class="text-gray-700">{{ $item['event']->type->name ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Sous-type :</span>
                                      <span class="text-gray-700">{{ $item['event']->subtype->name ?? 'N/A' }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                      <span class="text-gray-500 font-semibold">Prix :</span>
                                      <span class="text-gray-700">
                                        @foreach($item['prices'] as $price)
                                          {{ $price->amount }} {{ $price->currency }}
                                          @if (!$loop->last), @endif
                                        @endforeach
                                      </span>
                                    </li>

                                  </ul>
                                  <li class="flex rounded-md bg-gray-50 mt-4 p-3 items-center space-x-2 col-span-4">
                                    <span class="text-gray-500 font-semibold">Contenu :</span>
                                    <span class="text-gray-700">{{ $item['event']->content ?? 'N/A' }}</span>
                                  </li>
                                </div>
                              </div>
                            </div>
                          </div>
                          <a  href="{{ route('show', [$item['type'], $item['id']]) }}" class="md:mr-5 lg:w-full lg:h-full relative">
                            <img class="h-60 w-[480px] mn-w-[480px] object-cover rounded-t-lg md:rounded-lg border-[1px] border-gray-200 shadow-md" src="{{ asset('storage/' . ($item['event']->image ?? 'default.jpg')) }}" alt="">
                          </a>
                        </div>
                        <div class="pt-0 pl-3 md:pl-4 lg:w-7/12 text-left">
                          <div class="lg:w-4/4 pb-0 mt-2 md:mt-0 lg:pb-2">
                            <div class=" flex justify-between flex-wrap gap-2 ">
                              <div class=" flex justify-between flex-wrap gap-2 ">

                              @if ($item['event']->menu)
                                <a
                                href=""
                                class=" bg-emerald-500 text-white px-2 py-1 text-xs md:text-sm font-semibold rounded-md" href="">
                                {{ $item['event']->menu->name ?? 'N/A' }}
                                </a>
                              @endif
                              @if ($item['event']->type)
                                <a href="" 
                                  class="bg-emerald-500 text-white px-2 py-1 text-xs md:text-sm font-semibold rounded-md">
                                  {{ $item['event']->type->name ?? 'N/A' }}
                                </a>
                              @endif
                              @if ($item['event']->subtype)
                                <a href="" 
                                  class="bg-emerald-500 text-white mr-2 px-2 py-1 text-xs md:text-sm font-semibold rounded-md">
                                  {{ $item['event']->subtype->name ?? 'N/A' }}
                                </a>
                              @endif
                              <a target="_blank" href="">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md border border-emerald-500">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"/></svg>
                                </div>
                              </a>
                              </div>
                              <div x-data="{ open: false }" class="relative inline-block pr-3 lg:pr-0 text-left">
                                  @if ($item['prices']->isEmpty())
                                      <p class="inline-flex items-center rounded-md bg-emerald-500/5 px-2 py-1 text-xs md:text-sm font-medium text-emerald-400 ring-1 ring-inset ring-emerald-500/20">Gratuit</p>
                                  @elseif ($item['prices']->count() == 1)
                                      <p class="inline-flex items-center rounded-md bg-emerald-500/5 px-2 py-1 text-xs md:text-sm font-medium text-emerald-400 ring-1 ring-inset ring-emerald-500/20">
                                          A partir de : {{ $item['prices'][0]->pivot->cost }}
                                      </p>
                                  @else
                                      <button @click="open = !open" class="inline-flex items-center rounded-md bg-emerald-500/5 px-2 py-1 text-xs md:text-sm font-medium text-emerald-400 ring-1 ring-inset ring-emerald-500/20">
                                        A partir de : {{ $item['lowest_cost'] }}
                                      </button>
                                      <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                          <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                              @foreach ($item['prices'] as $price)
                                                  <a class="block px-4 {{ $loop->last ? '' : 'border-b-2 border-b-emerald-300' }} py-2 text-xs md:text-sm font-semibold text-emerald-500" role="menuitem">
                                                      {{ $price->name }} : {{ $price->pivot->cost }}
                                                  </a>
                                              @endforeach
                                          </div>
                                      </div>
                                  @endif
                              </div>
                            </div>
                            <h3 class="pt-2 text-gray-800 text-xl md:text-2xl font-bold ">
                              
                              <a  href="{{ route('show', [$item['type'], $item['id']]) }}">{{ $item['event']->title ?? 'N/A' }}</a>
                            </h3>
                            
                            <p class="text-gray-700 text-sm pt-1 md:text-lg md:pt-2 font-semibold">{{ $item['event']->subtitle ?? 'N/A' }}</p>
                            @php
                            \Carbon\Carbon::setLocale('fr');
                            $dateEnd = $item['dateend'] ? \Carbon\Carbon::parse($item['dateend'])->format('d/m/Y') : null;
                            $dateStart = \Carbon\Carbon::parse($item['datestart'])->translatedFormat('l d/m/Y');
                            @endphp
                            @if ($dateEnd)
                            <p class="text-gray-700 text-sm pt-1 md:pt-2 font-semibold md:text-medium">
                              {{ $dateStart ? 'De ' . $dateStart . ' à ' . $dateEnd : 'Le ' . $dateEnd }}
                            </p>
                            @else
                            <p class="text-gray-700 text-sm pt-1 md:pt-2 font-semibold md:text-medium">
                              {{'Le ' . $dateStart}}
                            </p>
                            @endif

                          @if (isset($item['city']) && $item['city'])
                          <p class="text-gray-600 text-sm pt-1 md:pt-1 font-semibold">
                              {{ $item['city'] }} - {{ $item['address'] }}
                          </p>
                          @else
                          <a class="text-gray-600 text-sm pt-1 md:pt-1 font-semibold">
                          Lien de participation                           
                          </a>
                          @endif
                          </div>
                        </div>
                      </article>
                    @endforeach
                  @endif
                </div>
      </div>
    </main>

</div>