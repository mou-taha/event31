<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Include Alpine.js -->

    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    <livewire:styles />
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Event31 | Répondez à la question ”on fait quoi ce soir ?”</title>
</head>

<body>
    <div x-data="{ sidebarOpen: false, menuOpen: false }" x-cloak class="h-full z-10 bg-gray-50">
        <header class="bg-white fixed top-0 left-0 right-0 z-30">
            @include('partials.default-nav')
            <!-- Menu centré -->
            <div class="hidden md:flex pb-3 pt-3 shadow-sm justify-center">
                <ul class="flex items-center space-x-6">
                    <li class="relative">
                        <a href="{{ route('index') }}"
                            class="nav-link font-semibold {{ request()->routeIs('index') ? 'text-emerald-500' : 'text-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-gray-500 after:transition-all after:duration-300 hover:after:w-full">Accueil</a>
                    </li>
                    @foreach ($menus as $menu)
                        <li class="relative">
                            <a href="{{ route('menus.index', ['id' => $menu->id]) }}" id="menu-{{ $menu->id }}"
                                class="nav-link font-semibold 
                          {{ Request::route('id') == $menu->id ? 'text-emerald-500 after:bg-emerald-500' : 'text-gray-500 after:bg-gray-500' }} 
                          text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:transition-all after:duration-300 hover:after:w-full">
                                {{ $menu->name }}
                            </a>
                        </li>
                    @endforeach
                    <li class="relative">
                        <a href="{{ route('blogs.index') }}"
                            class="nav-link font-semibold {{ request()->routeIs('blogs.index') ? 'text-emerald-500' : 'text-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-gray-500 after:transition-all after:duration-300 hover:after:w-full">Blogs</a>
                    </li>
                    <!-- <li class="relative">
                      <a href="#" class="bg-emerald-500 hover:bg-emerald-700 text-white px-4 pb-2 pt-1 text-md font-semibold rounded-md">Ajouter un event</a>
                  </li> -->
                </ul>
            </div>
        </header>
        <!-- Sidebar -->
        <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-cloak x-show="sidebarOpen"
            @click.away="sidebarOpen = false" style="display: none;">
            <div class="fixed inset-0 bg-gray-900/80"></div>
            <div class="fixed inset-0 flex">
                <div class="relative mr-16 flex w-full max-w-xs flex-1" x-show="sidebarOpen" style="display: block;">
                    <!-- button to close the sidebar -->
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button @click="sidebarOpen = false" type="button" class="-m-2.5 p-2.5">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
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
                                    <form id="searchForm" action="{{ route('index') }}" method="GET" class="md:block">
                                        <div>
                                            <!-- Search Field -->
                                            <div class="w-full max-w-lg lg:max-w-xs">
                                                <label for="search" class="sr-only">Search</label>
                                                <div class="relative">
                                                    <div id="searchIcon"
                                                        class="pointer-events-auto absolute inset-y-0 left-0 flex items-center pl-3 cursor-pointer">
                                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <input id="search" name="search"
                                                        class="block w-full rounded-md border-0 bg-transparent py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"
                                                        placeholder="Recherche" type="search"
                                                        value="{{ old('search', $searchTerm) }}">
                                                </div>
                                            </div>

                                            <!-- City Selection using Alpine.js Combobox -->
                                            <div x-data="singleSelectCombobox('{{ old('city', $selectedCity) }}', {{ json_encode($cities) }})" class="relative mt-2">
                                                <input id="cityCombobox" type="text" x-model="search"
                                                    @focus="open = true" @input="filterOptions"
                                                    class="w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"
                                                    placeholder="Sélectionner une ville" autocomplete="off"
                                                    name="city">

                                                <ul x-show="open"
                                                    class="absolute z-40 mt-1 max-h-28 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                                    <template x-for="(option, index) in filteredOptions"
                                                        :key="option.id">
                                                        <li @click="selectOption(option)"
                                                            class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900">
                                                            <span class="block truncate" x-text="option.name"></span>
                                                            <span x-show="selectedCity === option.id"
                                                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-emerald-600">
                                                                <svg class="h-5 w-5" viewBox="0 0 20 20"
                                                                    fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M16.704 5.296a.75.75 0 00-1.06-1.06l-8 8a.75.75 0 001.06 1.06l8-8z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                            <!-- Date Selection using Flatpickr -->
                                            <div class="mt-3">
                                                <label for="birth" class="sr-only">Date</label>
                                                <input id="birth"
                                                    class="flatpickr hidden md:block w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"
                                                    type="text" name="date" placeholder="Sélectionner une date"
                                                    value="{{ old('date', $selectedDate) }}">
                                                <x-text-input wire:model="birth" id="birth"
                                                    class="block md:hidden w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"
                                                    type="date" name="birth" placeholder="Sélectionner une date"
                                                    value="{{ old('date', $selectedDate) }}" />

                                            </div>
                                            <!-- Type of Organization -->
                                            <div>
                                                <div class="border border-gray-300 rounded-md relative mt-6">
                                                    <span
                                                        class="bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Type
                                                        d'organisation</span>
                                                    <div class="block mt-3">
                                                        <label for="physical" class="inline-flex items-center">
                                                            <input name="type[]" id="physical" type="checkbox"
                                                                class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                                value="physical"
                                                                {{ in_array('physical', old('type', $selectedTypes)) ? 'checked' : '' }}>
                                                            <span
                                                                class="ms-2 text-sm text-gray-600">{{ __('Présentielle') }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="block mt-2">
                                                        <label for="virtual" class="inline-flex items-center">
                                                            <input name="type[]" id="virtual" type="checkbox"
                                                                class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                                value="virtual"
                                                                {{ in_array('virtual', old('type', $selectedTypes)) ? 'checked' : '' }}>
                                                            <span
                                                                class="ms-2 text-sm text-gray-600">{{ __('Virtuelle') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Type of Access -->
                                            <div>
                                                <div class="border border-gray-300 rounded-md relative mt-6">
                                                    <span
                                                        class="bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Type
                                                        d'accès</span>
                                                    <div class="block mt-3">
                                                        <label for="free" class="inline-flex items-center">
                                                            <input name="price[]" id="free" type="checkbox"
                                                                class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                                value="gratuit"
                                                                {{ in_array('gratuit', old('price', $selectedPrices)) ? 'checked' : '' }}>
                                                            <span
                                                                class="ms-2 text-sm text-gray-600">{{ __('Gratuit') }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="block mt-2">
                                                        <label for="payant" class="inline-flex items-center">
                                                            <input name="price[]" id="payant" type="checkbox"
                                                                class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                                value="payant"
                                                                {{ in_array('payant', old('price', $selectedPrices)) ? 'checked' : '' }}>
                                                            <span
                                                                class="ms-2 text-sm text-gray-600">{{ __('Payant') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Sorting -->
                                            <div>
                                                <div class="border border-gray-300 rounded-md relative mt-6">
                                                    <span
                                                        class="bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Trier
                                                        par :</span>
                                                    <div class="block mt-3">
                                                        <label for="sortByDate" class="inline-flex items-center">
                                                            <input id="sortByDate" type="radio"
                                                                class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                                name="sort" value="ds"
                                                                {{ old('sort', $sortBy) == 'ds' ? 'checked' : '' }}>
                                                            <span
                                                                class="ms-2 text-sm text-gray-600">{{ __('Horaire') }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="block mt-2">
                                                        <label for="sortByPriceAsc" class="inline-flex items-center">
                                                            <input id="sortByPriceAsc" type="radio"
                                                                class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                                name="sort" value="pricemin"
                                                                {{ old('sort', $sortBy) == 'pricemin' ? 'checked' : '' }}>
                                                            <span
                                                                class="ms-2 text-sm text-gray-600">{{ __('Prix ascendant') }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="block mt-2">
                                                        <label for="sortByPriceDesc" class="inline-flex items-center">
                                                            <input id="sortByPriceDesc" type="radio"
                                                                class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                                name="sort" value="pricemax"
                                                                {{ old('sort', $sortBy) == 'pricemax' ? 'checked' : '' }}>
                                                            <span
                                                                class="ms-2 text-sm text-gray-600">{{ __('Prix descendant') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="flex justify-between items-center gap-x-6 mt-2">
                                                <a href="{{ route('index') }}" id="resetButton"
                                                    class="text-sm font-semibold leading-6 text-gray-900 cursor-pointer">{{ __('Réinitialiser') }}</a>
                                                <button type="submit"
                                                    class=" inline-flex items-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                                                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Valider') }}
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                    <script>
                                        function singleSelectCombobox(initialSelectedCity, cities) {
                                            return {
                                                open: false,
                                                search: '',
                                                selectedCity: initialSelectedCity,
                                                options: cities,
                                                filteredOptions: cities,

                                                init() {
                                                    this.search = this.getSelectedCityName(this.selectedCity);
                                                },

                                                filterOptions() {
                                                    if (this.search === '') {
                                                        this.filteredOptions = this.options;
                                                    } else {
                                                        this.filteredOptions = this.options.filter(option => option.name.toLowerCase().includes(this.search
                                                            .toLowerCase()));
                                                    }
                                                },

                                                selectOption(option) {
                                                    this.selectedCity = option.id;
                                                    this.search = option.name;
                                                    this.open = false;
                                                },

                                                getSelectedCityName(cityId) {
                                                    const selectedCity = this.options.find(option => option.id == cityId);
                                                    return selectedCity ? selectedCity.name : '';
                                                }
                                            };
                                        }
                                    </script>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile menu -->
        <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true" x-cloak x-show="menuOpen"
            @click.away="menuOpen = false" style="display: none;">
            <div class="fixed inset-0 bg-gray-900/80"></div>
            <div class="fixed inset-0 flex">
                <div class="relative mr-16 flex w-full max-w-xs flex-1" x-show="menuOpen" style="display: block;">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <!-- button to close the menu -->
                        <button @click="menuOpen = false" type="button" class="mt-0 ml-0">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- menu components -->
                    <div class="flex grow flex-col z-50 gap-y-5 overflow-y-auto bg-white -pt-4 px-2 pb-4">
                        <div class="flex w-full bg-emerald-400 h-8 mx-auto shrink-0 items-center">
                            <p class="text-xl font-bold text-white mx-auto text-center">Menu</p>
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-2 px-2">
                                        <li>
                                            <a href="{{ route('index') }}"
                                                class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                Accueil
                                            </a>
                                        </li>
                                        @foreach ($menus as $menu)
                                            <li>
                                                <a href=""
                                                    class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                    {{ $menu->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{{ route('blogs.index') }}"
                                                class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
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
                        <p class="font-bold text-slate-900 mt-3 text-xl lg:text-2xl leading-tight pl-2 lg:pl-0">Filtre
                        </p>
                        <form id="searchForm" action="{{ route('index') }}" method="GET" class="md:block">
                            <div>
                                <!-- Search Field -->
                                <div class="w-full max-w-lg lg:max-w-xs">
                                    <label for="search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div id="searchIcon"
                                            class="pointer-events-auto absolute inset-y-0 left-0 flex items-center pl-3 cursor-pointer">
                                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input id="search" name="search"
                                            class="block w-full rounded-md border-0 bg-transparent py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"
                                            placeholder="Recherche" type="search"
                                            value="{{ old('search', $searchTerm) }}">
                                    </div>
                                </div>

                                <!-- City Selection using Alpine.js Combobox -->
                                <div x-data="singleSelectCombobox('{{ old('city', $selectedCity) }}', {{ json_encode($cities) }})" class="relative mt-2">
                                    <input id="cityCombobox" type="text" x-model="search" @focus="open = true"
                                        @input="filterOptions"
                                        class="w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"
                                        placeholder="Sélectionner une ville" autocomplete="off" name="city">

                                    <ul x-show="open"
                                        class="absolute z-40 mt-1 max-h-28 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                        <template x-for="(option, index) in filteredOptions" :key="option.id">
                                            <li @click="selectOption(option)"
                                                class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900">
                                                <span class="block truncate" x-text="option.name"></span>
                                                <span x-show="selectedCity === option.id"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-emerald-600">
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                        aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M16.704 5.296a.75.75 0 00-1.06-1.06l-8 8a.75.75 0 001.06 1.06l8-8z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>

                                <!-- Date Selection using Flatpickr -->
                                <div class="mt-3">
                                    <label for="birth" class="sr-only">Date</label>
                                    <input id="birth"
                                        class="flatpickr block w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"
                                        type="text" name="date" placeholder="Sélectionner une date"
                                        value="{{ old('date', $selectedDate) }}">
                                </div>

                                <!-- Type of Organization -->
                                <div>
                                    <div class="border border-gray-300 rounded-md relative mt-6">
                                        <span class="bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Type
                                            d'organisation</span>
                                        <div class="block mt-3">
                                            <label for="physical" class="inline-flex items-center">
                                                <input name="type[]" id="physical" type="checkbox"
                                                    class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                    value="physical"
                                                    {{ in_array('physical', old('type', $selectedTypes)) ? 'checked' : '' }}>
                                                <span
                                                    class="ms-2 text-sm text-gray-600">{{ __('Présentielle') }}</span>
                                            </label>
                                        </div>
                                        <div class="block mt-2">
                                            <label for="virtual" class="inline-flex items-center">
                                                <input name="type[]" id="virtual" type="checkbox"
                                                    class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                    value="virtual"
                                                    {{ in_array('virtual', old('type', $selectedTypes)) ? 'checked' : '' }}>
                                                <span class="ms-2 text-sm text-gray-600">{{ __('Virtuelle') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Type of Access -->
                                <div>
                                    <div class="border border-gray-300 rounded-md relative mt-6">
                                        <span class="bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Type
                                            d'accès</span>
                                        <div class="block mt-3">
                                            <label for="free" class="inline-flex items-center">
                                                <input name="price[]" id="free" type="checkbox"
                                                    class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                    value="gratuit"
                                                    {{ in_array('gratuit', old('price', $selectedPrices)) ? 'checked' : '' }}>
                                                <span class="ms-2 text-sm text-gray-600">{{ __('Gratuit') }}</span>
                                            </label>
                                        </div>
                                        <div class="block mt-2">
                                            <label for="payant" class="inline-flex items-center">
                                                <input name="price[]" id="payant" type="checkbox"
                                                    class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                    value="payant"
                                                    {{ in_array('payant', old('price', $selectedPrices)) ? 'checked' : '' }}>
                                                <span class="ms-2 text-sm text-gray-600">{{ __('Payant') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sorting -->
                                <div>
                                    <div class="border border-gray-300 rounded-md relative mt-6">
                                        <span
                                            class="bg-gray-50 absolute -top-3 px-1 left-2 text-sm text-gray-600">Trier
                                            par :</span>
                                        <div class="block mt-3">
                                            <label for="sortByDate" class="inline-flex items-center">
                                                <input id="sortByDate" type="radio"
                                                    class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                    name="sort" value="ds"
                                                    {{ old('sort', $sortBy) == 'ds' ? 'checked' : '' }}>
                                                <span class="ms-2 text-sm text-gray-600">{{ __('Horaire') }}</span>
                                            </label>
                                        </div>
                                        <div class="block mt-2">
                                            <label for="sortByPriceAsc" class="inline-flex items-center">
                                                <input id="sortByPriceAsc" type="radio"
                                                    class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                    name="sort" value="pricemin"
                                                    {{ old('sort', $sortBy) == 'pricemin' ? 'checked' : '' }}>
                                                <span
                                                    class="ms-2 text-sm text-gray-600">{{ __('Prix ascendant') }}</span>
                                            </label>
                                        </div>
                                        <div class="block mt-2">
                                            <label for="sortByPriceDesc" class="inline-flex items-center">
                                                <input id="sortByPriceDesc" type="radio"
                                                    class="ml-2 rounded bg-transparent border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                                    name="sort" value="pricemax"
                                                    {{ old('sort', $sortBy) == 'pricemax' ? 'checked' : '' }}>
                                                <span
                                                    class="ms-2 text-sm text-gray-600">{{ __('Prix descendant') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-between items-center gap-x-6 mt-2">
                                    <a href="{{ route('index') }}" id="resetButton"
                                        class="text-sm font-semibold leading-6 text-gray-900 cursor-pointer">{{ __('Réinitialiser') }}</a>
                                    <button type="submit"
                                        class=" inline-flex items-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Valider') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                        <script>
                            function singleSelectCombobox(initialSelectedCity, cities) {
                                return {
                                    open: false,
                                    search: '',
                                    selectedCity: initialSelectedCity,
                                    options: cities,
                                    filteredOptions: cities,

                                    init() {
                                        this.search = this.getSelectedCityName(this.selectedCity);
                                    },

                                    filterOptions() {
                                        if (this.search === '') {
                                            this.filteredOptions = this.options;
                                        } else {
                                            this.filteredOptions = this.options.filter(option => option.name.toLowerCase().includes(this.search
                                                .toLowerCase()));
                                        }
                                    },

                                    selectOption(option) {
                                        this.selectedCity = option.id;
                                        this.search = option.name;
                                        this.open = false;
                                    },

                                    getSelectedCityName(cityId) {
                                        const selectedCity = this.options.find(option => option.id == cityId);
                                        return selectedCity ? selectedCity.name : '';
                                    }
                                };
                            }
                        </script>

                    </div>
                </nav>
            </div>
        </div>
        <!-- Button to toggle the sidebar for mobile -->
        <div
            class="fixed top-[60px] z-20 bg-white flex flex-grow w-full items-center justify-between shadow-sm  md:hidden px-[2px]">


            <div class="items-center w-full h-10 mr-1 bg-white">
                <div class="scrollable-tabs-container">

                    <ul>
                        <li>
                            <a href="{{ route('index') }}"
                                class="{{ request()->routeIs('index') ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-900' }}">Accueil</a>
                        </li>

                        @foreach ($menus as $menu)
                            <li>
                                <a href="{{ route('menus.index', ['id' => $menu->id]) }}"
                                    class="{{ Request::route('id') == $menu->id ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-900' }}">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <div
                    class="glide__slide -mt-5 h-12 bg-white w-full justify-center grid grid-cols-8 gap-5 items-center">
                    <button @click="sidebarOpen = true" type="button"
                        class="text-gray-700 mb-4 col-span-1 lg:hidden">
                        <img x-show="!menuOpen" src="{{ asset('svg/menu/search.svg') }}" alt="burger"
                            class="w-4 ml-2">
                    </button>
                    <div class="col-span-6 mb-4">
                        <form action="" method="get" id="cityForm">
                            <select id="city" name="city" placeholder="Ville" onchange="this.form.submit();"
                                @class([
                                    ' rounded-md pr-7 pl-2 border-0 border-0 py-4 bg-transparent ring-transparent ring-1 ring-inset focus:ring-2  ring-inset focus:ring-transparent sm:max-w-xs sm:text-sm sm:leading-6',
                                    'form-select',
                                ])
                                style="font-weight: 600 !important; font-size: 16px !important; color: #4B5563 !important;">
                                <option value="" {{ request()->city ? '' : 'selected' }}>Villes</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->name }}"
                                        {{ request()->city == $city->name ? 'selected' : '' }}>{{ $city->name }}
                                    </option>
                                @endforeach
                            </select>



                        </form>
                    </div>
                </div>
            </div>
        </div>
        <main class="py-10 mt-5 z-0 lg:pl-60 lg:mt-8 relative">
            <div class="px-4 sm:px-3 lg:px-4 pt-10 mx-0 lg:mx-16 relative">
                <div class="glide md:hidden">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">

                            <li class="glide__slide justify-center pt-12 flex items-center">
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- partial view events --}}
                <div id="posts-container">
                    @include('partials.event', ['items' => $items])
                </div>

            </div>
            {{-- Hidden pagination links --}}
            <div id="pagination-links" style="display: none;">
                {{ $items->links() }}
            </div>
            <div id="loading-indicator" style="display: none;">Loading more events...</div>

        </main>
        <footer class="bg-gray-50" aria-labelledby="footer-heading">
            <p id="footer-heading" class="sr-only">Footer</p>
            <div class="mx-auto px-4 md:ml-64 pt-10 sm:pt-12 lg:px-12 lg:pl-16 lg:pt-16">
                <div class="xl:grid grid-cols-2 xl:grid-cols-4 xl:gap-8">
                    <div class="space-y-5 col-span-2">
                        <a href="{{ route('index') }}" class="h-7 flex items-center justify-start ">
                            <p class="text-gray-900 font-bold text-3xl ">E</p>
                            <img src="{{ asset('img/logo-green-black.png') }}" alt="Logo" class="ml-1 h-7">
                            <p class="-ml-1 text-gray-900 font-bold text-3xl ">ent</p>
                            <p class="text-emerald-500 font-bold ml-1 text-3xl "> 31</p>
                        </a>
                        <h1 class="text-sm leading-6 text-gray-600">Get inspired, go out and enjoy</h2>
                            <div class="flex space-x-6">
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">X</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">YouTube</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                    </div>
                    <div class="col-span-2 grid md:ml-8 grid-cols-2 gap-8">
                        <div class="mt-8 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-emerald-500">Redirection</h3>
                            <ul role="list" class="mt-6 space-y-3">
                                <li>
                                    <a href="{{ route('apropos') }}"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">A propos</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact') }}"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Contact</a>
                                </li>
                                <li>
                                    <a href="{{ route('blogs.index') }}"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blogs</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-8 md:ml-8 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-emerald-500">Policy</h3>
                            <ul role="list" class="mt-6 space-y-3">
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Revoir</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class=" col-span-4 border-t border-gray-900/10 mt-4 pt-4 pb-4 ">
                    <p class="text-xs leading-5 "><span class="text-emerald-500">&copy; 2024 Event31,</span> <span
                            class="text-gray-500">Conception et design : <a href="https://edersys.ma/"
                                target="_blank">E-dersys SARL</a></span></p>
                </div>
            </div>
    </div>
    </footer>
    <script>
        document.getElementById('searchIcon').addEventListener('click', function() {
            // Get the search input value
            const searchValue = document.getElementById('search').value;

            // Submit the form with the search value
            document.getElementById('searchForm').submit();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('.flatpickr', {
                dateFormat: 'Y-m-d',
                locale: 'fr',
                disableMobile: true
            });
        });
    </script>
    <script>
        document.addEventListener('clickRetourLink', () => {
            document.querySelector('a[href="{{ route('organisms') }}"]').click();
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('notification', (event) => {
                console.log(event.message);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var page = 1;
            var loading = false;

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !loading) {
                    loading = true;
                    page++;
                    $('#loading-indicator').show();

                    $.ajax({
                        url: '{{ route('index') }}?page=' + page,
                        type: 'GET',
                        success: function(data) {
                            console.log("success success success success success success")
                            if (data) {
                                $('#posts-container').append(data);
                                loading = false;
                                $('#loading-indicator').hide();
                            } else {
                                // No more data to load
                                $('#loading-indicator').text('No more posts.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Status: ", status);
                            console.log("Error: ", error);
                            console.log("Response Text:", xhr.responseText);
                            loading = false;
                            $('#loading-indicator').text('Error loading posts.');
                        }
                    });
                }
            });
        });
    </script>
    </div> <button id="backToTopBtn"
        class="hidden fixed bottom-5 right-5 z-50 rounded-full bg-emerald-600 p-3 text-white shadow hover:bg-emerald-700 transition duration-300 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5V6m0 0L5.25 12.75M12 6l6.75 6.75" />
        </svg>
    </button>
    <livewire:scripts />
</body>

</html>
