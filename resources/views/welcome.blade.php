
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Event31 | Répondez à la question ”on fait quoi ce soir ?”</title>
</head>
<body   x-data="{ sidebarOpen: false, menuOpen: false }" x-cloak class="h-full bg-gray-50">


  <header class="bg-white fixed top-0 left-0 right-0 z-50">
    
@include('partials.default-nav')

      <!-- Menu centré -->
<div class="hidden md:flex pb-3 pt-3 shadow justify-center">
    <ul class="flex items-center space-x-6">
        <li class="relative">
            <a href="{{ route('index') }}" class="nav-link font-semibold {{ request()->routeIs('index') ? 'text-green-500' : 'text-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-gray-500 after:transition-all after:duration-300 hover:after:w-full">Accueil</a>
        </li>
        @foreach ($families as $family)
        <li class="relative">
            <a href="{{ route('publications.byFamily', ['family' => $family->slug]) }}"
               id="family-{{ $family->id }}"
               class="nav-link font-semibold 
                   {{ Request::segment(2) == $family->slug ? 'text-green-500 after:bg-green-500' : 'text-gray-500 after:bg-gray-500' }} 
                   text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:transition-all after:duration-300 hover:after:w-full">
                {{ $family->name }}
            </a>
        </li>
    @endforeach
        <li class="relative">
            <a href="{{ route('blogs.index') }}" class="nav-link font-semibold {{ request()->routeIs('blogs') ? 'text-green-500' : 'text-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-gray-500 after:transition-all after:duration-300 hover:after:w-full">Blogs</a>
        </li>
        <!-- <li class="relative">
            <a href="#" class="bg-green-500 hover:bg-green-700 text-white px-4 pb-2 pt-1 text-md font-semibold rounded-md">Ajouter un event</a>
        </li> -->
    </ul>
  </div>
  </header>


      <!-- Sidebar -->
      <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-cloak x-show="sidebarOpen" @click.away="sidebarOpen = false" style="display: none;">
        <div class="fixed inset-0 bg-gray-900/80"></div>
        <div class="fixed inset-0 flex">
          <div class="relative mr-16 flex w-full max-w-xs flex-1" x-show="sidebarOpen" style="display: block;">
            <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
              <!-- button to close the sidebar -->
              <button @click="sidebarOpen = false" type="button" class="-m-2.5 p-2.5">
                <span class="sr-only">Close sidebar</span>
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
      
            {{-- Mobile sidebar components --}}
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-2 pb-4">
              <div class="flex w-full bg-green-400 h-8 mx-auto shrink-0 items-center">
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
                            <input type="text" name="search" id="search" value="{{request()->search}}" placeholder="Recherche rapide" class="block w-full rounded-md border-0 px-3 py-1 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                            <div class="absolute inset-y-0 right-0 flex py-1 pr-1.5">
                              <button>
                                <kbd class="text-red-700 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-3 text-2xl font-extrabold">
                                  <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-700" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                  </svg>
                                </kbd>
                              </button>
                            </div>
                          </div>
                        </form>
                      </li>
                      <form action="{{ request()->is('families/*') ? route('publications.byFamily', ['family' => request()->family]) : route('index') }}" method="get" class="md:block">
                        <li class="px-2 mt-2">
                          <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Ville</label>
    
                          <div class="">
                            <select
                            id="city"
                            name="city"
                            class="block w-full shadow-sm rounded-md border-0 py-1.5 ring-gray-300 ring-1 focus:ring-2 ring-inset focus:ring-green-500 sm:max-w-xs sm:text-sm sm:leading-6 form-select"                    >
                            <option value="">Villes</option>
                            @foreach ($cities as $city)
                                <option>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        </div>
                        </li>
                        <li class="px-2 mt-2">
                          <label for="publicationDatePickerr" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                          <div class="relative rounded-md shadow-sm">
                              <input
                                  id="publicationDatePickerr"
                                  name="ds"
                                  type="text"
                                  value="{{ request()->input('ds', $selectedDate) }}"
                                  class="form-input block w-full rounded-md border-0 py-1.5 ring-1 bg-white focus:ring-2 ring-inset focus:ring-green-500 sm:text-sm sm:leading-6"
                                  readonly="readonly">
                          </div>                        
                        </li>
                        <li class="px-2 mt-2">
                          <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                          <div class="">
                            <select
                                id="type"
                                name="type"
                                @class([
                                    'block w-full shadow-sm rounded-md border-0 py-1.5 border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-green-500 sm:max-w-xs sm:text-sm sm:leading-6',
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
                                      'block w-full shadow-sm rounded-md border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-green-500 sm:max-w-xs sm:text-sm sm:leading-6',
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
                                      'block w-full shadow-sm rounded-md border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-green-500 sm:max-w-xs sm:text-sm sm:leading-6',
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
                        <button type="submit" class="block w-full shadow-sm rounded-md border-0 py-1.5 text-white bg-green-500 hover:bg-green-500 sm:max-w-xs sm:text-sm sm:leading-6">
                            Mettre à jour
                        </button>  
                        </li>
                      </form>                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- mobile menu -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-cloak x-show="menuOpen" @click.away="menuOpen = false" style="display: none;">
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
            <div class="flex w-full bg-green-400 h-8 mx-auto shrink-0 items-center">
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
                    @foreach ($families as $family)
                    <li>
                      <a href="{{ route('publications.byFamily', ['family' => $family->slug]) }}" class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        {{ $family->name }}
                      </a>
                    </li>
                    @endforeach
                    <li>
                      <a href="{{ route('blogs.index') }}" class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
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
      <div class="hidden lg:fixed lg:inset-y-0 lg:top-32 lg:z-40 lg:flex lg:w-64 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto mt-2 px-6">
          <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
              <li>
                <ul role="list" class="-mx-1 space-y-1">
                  <p class="font-bold text-slate-900 text-xl lg:text-2xl leading-tight pl-2 lg:pl-0">Filtre</p>

                  <li>
                    <div>
                      <form action="{{ route('index') }}" method="get" class="md:block">
                        <div class="relative mt-4 flex items-center">
                          <input type="text" name="search" id="search" value="{{request()->search}}" placeholder="Recherche rapide" class="  block w-full rounded-md bg-gray-50 border-0 px-3 py-1 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                          <div class="absolute inset-y-0 right-0 flex py-1 pr-1.5">
                            <button>
                              <kbd class="text-red-700 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-3 text-2xl font-extrabold">
                                <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-700" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                              </kbd>
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </li>
                  <li>
                    <form action="{{ request()->is('families/*') ? route('publications.byFamily', ['family' => request()->family]) : route('index') }}" method="get" class="md:block">
                      <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Ville</label>
                    <div class="">
                        <select
                            id="city"
                            name="city"
                            @class([
                                'block w-full shadow-sm rounded-md bg-gray-50 border-0 py-1.5 border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-green-500 sm:max-w-xs sm:text-sm sm:leading-6',
                                'form-select'

                            ])
                        >
                        <option value=""disabled selected >Sélectionnez une ville</option>
                        @foreach ($cities as $city)
                         <option>{{ $city->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    </li>
                    <li>
                      <label for="publicationDatePickerrr" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                      <div class="relative rounded-md shadow-sm">
                          <input
                              id="publicationDatePickerrr"
                              name="ds"
                              type="text"
                              value="{{ request()->input('ds', $selectedDate) }}"
                              class="form-input block w-full rounded-md border-0 py-1.5 ring-1 bg-transparent ring-gray-300 focus:ring-2 ring-inset focus:ring-green-500 sm:text-sm sm:leading-6"
                              readonly="readonly">
                      </div>
                    </li>
                    <li>
                      <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                      <div class="">
                        <select
                            id="type"
                            name="type"
                            @class([
                                'block w-full shadow-sm rounded-md bg-gray-50 border-0 py-1.5 border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-green-500 sm:max-w-xs sm:text-sm sm:leading-6',
                                'form-select'
                            ])
                        >
                        <option value=""disabled selected >Sélectionnez un type</option>
                        @foreach ($types as $type)
                         <option>{{ $type->name }}</option>
                        @endforeach
                        </select>
                      </div>
                      </li>
                      <li>
                        <label for="Tout" class="block text-sm font-medium leading-6 text-gray-900">Tout</label>
                        <div class="">
                            <select
                                id="Tout"
                                name="Tout"
                                @class([
                                    'block w-full shadow-sm bg-gray-50 rounded-md border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-green-500 sm:max-w-xs sm:text-sm sm:leading-6',
                                    'form-select'
                                ])
                            >
                    
                                <option value="">Tout</option>
                                <option value="gratuit">Gratuit</option>
                                <option value="premuim">Premium</option>

                    
                            </select>
                        </div>
                        </li>
                        <li>
                          <label for="trier" class="block text-sm font-medium leading-6 text-gray-900">Triér par :</label>
                          <div class="">
                              <select
                                  id="trier"
                                  name="trier"
                                  @class([
                                      'block w-full shadow-sm rounded-md bg-gray-50 border-0 py-1.5 ring-gray-300 ring-1 ring-inset focus:ring-2  ring-inset focus:ring-green-500 sm:max-w-xs sm:text-sm sm:leading-6',
                                      'form-select'
                                  ])
                              >
                      
                                  <option value="ds">Horaire</option>
                                  <option value="pricemin">Prix ascendant</option>
                                  <option value="pricemax">Prix descandant</option>
  
                      
                              </select>
                          </div>
                          </li>
              <li>
                <div class=" leading-6"></div>
                <ul role="list" class="mt-4">
                  <li>
                    <!-- Current: "bg-gray-50 text-green-600", Default: "text-gray-700 hover:text-green-600 hover:bg-gray-50" -->
                    <button type="submit" class="block w-full shadow-sm rounded-md border-0 py-1.5 text-white bg-green-700 hover:bg-green-500 sm:max-w-xs sm:text-sm sm:leading-6">
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
      <!-- Button to toggle the sidebar for mobile -->
    <div class="fixed top-10 z-40 bg-white flex flex-grow w-full items-center justify-between shadow-sm  md:hidden px-[2px]">
      <button @click="sidebarOpen = true" type="button" class="text-gray-700 w-1/12 lg:hidden">
        <img x-show="!menuOpen" src="{{asset('svg/menu/search.svg')}}" alt="burger" class="w-4 ml-2">
      </button>
      <form class="w-4/12" action="{{ request()->is('families/*') ? route('publications.byFamily', ['family' => request()->family]) : route('index') }}" method="get" id="cityForm">
      
        <select
          id="city"
          name="city"
          placeholder="Ville"
          onchange="this.form.submit();"
          @class([
              ' rounded-md pr-7 pl-2 border-0 border-0 py-4 ring-white ring-1 ring-inset focus:ring-2  ring-inset focus:ring-white sm:max-w-xs sm:text-sm sm:leading-6',
              'form-select'
          ])
    style="font-weight: 600 !important; font-size: 16px !important; color: #4B5563 !important;"
      >
      <option value=""  {{ request()->city ? '' : 'selected' }}>Villes</option>
        @foreach ($cities as $city)
            <option value="{{ $city->name }}" {{ request()->city == $city->name ? 'selected' : '' }}>{{ $city->name }}</option>
        @endforeach
    </select>

    @if(request()->has('ds'))
        <input type="hidden" name="ds" value="{{ request()->ds }}">
    @endif
      </select>
      </form>
      <div class="items-center w-7/12 ">
        <div class="glide">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides items-center">
              @foreach ($families as $family)
                 <a class="" href="{{ route('publications.byFamily', ['family' => $family->slug]) }}"><li class=" text-center glide__slide w-full px-1 {{ Request::segment(2) == $family->slug ? 'text-green-500 after:bg-green-500' : 'text-gray-500 after:bg-gray-500' }} font-semibold text-md ">{{ $family->name }}</li></a>              @endforeach
                 <a href="{{ route('blogs.index') }}" class=""><li class=" glide__slide text-gray-600 font-semibold text-md text-center ">Blog</li></a>
            </ul>
          </div>
        </div>
      
      </div>
    </div>



    <main class="py-14 mt-5 lg:pl-52 lg:mt-8">
      <div class="px-4 sm:px-3 lg:px-4 pt-10 mx-0 lg:mx-16">
        <div class="glide w-12/12 md:hidden mt-4">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
              
              <li class="glide__slide justify-center grid grid-cols-4 gap-5 items-center">

                <div class=" col-span-3">
                <a id="left-arrow">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 inline-block cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                  </svg>
                </a>
            
                <input type="text" value="{{ request()->get('ds', 'Toutes les dates') }}" id="publicationDatePicker" class="border w-3/4 text-center bg-transparent border-gray-300 rounded-md px-3 py-[2px] text-md text-gray-500" readonly />
            
                <a id="right-arrow">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 inline-block cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                  </svg>
                </a>
              </div>
              <div class="col-span-1">
                <a href="{{ url()->current() }}" class="bg-gray-500 text-white px-2 py-1 text-sm font-semibold rounded-md">
                  Proche
              </a>
              </div>
              </li>
            </ul>


          </div>
      </div>
        <div class="glide">
          <div class="glide__track" data-glide-el="track">
              <ul class="glide__slides">
                      <li class="glide__slide">
                        @if($publications->isEmpty())
                        <div class="md:hidden mt-20 font-bold text-lg text-center">
                          <span class="text-emerald-500">Il n'y a aucun événement ce jour-là, vérifiez l'entrée en haut pour les autres jours vus ou </span> <a id="right-arrow2" class="text-gray-500">cliquez ici </a> <span class="text-emerald-500">pour vous déplacer au jour suivant</span>                  
                        </div>
                        @else
                        @foreach ($publications as $publication)
                        {{-- debut du post --}}
                        <article class="flex flex-col lg:flex-row pb-6 my-5 md:pt-6 pl-0 sm:px-2 drop-shadow-md rounded-lg lg:px-4 bg-white">
                          <div class="flex flex-col-reverse lg:flex-row lg:w-6/12">
                              <div class="md:-ml-[14px] mt-2 md:mt-0 flex flex-row lg:flex-col justify-between">
                                <div x-data="{ liked: false }">
                                  <svg @click="liked = !liked" :class="{ 'text-red-500': liked, 'text-[#888888]': !liked }" xmlns="http://www.w3.org/2000/svg" class="ml-2 mr-1 cursor-pointer" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                      <path d="M12 19.654l-.758-.685q-2.448-2.236-4.05-3.829q-1.602-1.592-2.529-2.808q-.926-1.217-1.295-2.201Q3 9.146 3 8.15q0-1.908 1.296-3.204Q5.592 3.65 7.5 3.65q1.32 0 2.475.675T12 6.288Q12.87 5 14.025 4.325T16.5 3.65q1.908 0 3.204 1.296Q21 6.242 21 8.15q0 .996-.368 1.98q-.369.985-1.295 2.202q-.927 1.216-2.52 2.808q-1.592 1.593-4.06 3.83zm0-1.354q2.4-2.17 3.95-3.716q1.55-1.547 2.45-2.685t1.25-2.015Q20 9.006 20 8.15q0-1.5-1-2.5t-2.5-1q-1.194 0-2.204.682q-1.01.681-1.808 2.053h-.976q-.818-1.39-1.818-2.063q-1-.672-2.194-.672q-1.48 0-2.49 1Q4 6.65 4 8.15q0 .856.35 1.734t1.25 2.015t2.45 2.675Q9.6 16.112 12 18.3m0-6.825"/>
                                  </svg>
                                </div>
                
                              <a target="_blank" href="{{ $publication->link }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class=" ml-3 mr-1" width="34" height="34" viewBox="0 0 24 24">
                                  <path fill="#888888" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                              </a>
                              <div x-cloak x-data="{ isModalOpen: false }" >
                                <button @click="isModalOpen = true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 mr-1" width="34" height="34" viewBox="0 0 24 24">
                                        <path fill="#888888" d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path fill="#888888" d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </button>
                                <div x-cloak x-show="isModalOpen" class="absolute inset-0 z-40 bg-white bg-opacity-75 transition-opacity" style="display: none;">
                                    <div class="absolute inset-0 z-10 md:ml-5 md:-mt-1">
                                        <div class="flex min-h-full min-w-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                            <div class="absolute transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                                <p class="text-lg font-bold tracking-tight text-gray-900 pb-4 sm:text-lg">Description</p>
                                                <p class="text-md w-auto md:w-full font-semibold tracking-tight text-gray-700 pb-4 sm:text-md">{{ substr($publication->content, 0, 220) }}...</p>
                                                <button @click="isModalOpen = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                    Annuler
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div X-cloak x-data="{ isModalOpen: false }">
                              <button @click="isModalOpen = true">
                                  <svg xmlns="http://www.w3.org/2000/svg" class=" ml-3 mr-1" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="#888888" d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                  </svg>
                                </button>
                                <div x-cloak x-show="isModalOpen" class="absolute inset-0 z-40 bg-white bg-opacity-75 transition-opacity">
                                  <div class="absolute inset-0 z-10 md:ml-5 md:-mt-1">
                                    <div class="flex min-h-full min-w-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                      <div class="absolute min-w-full md:min-w-0 transform overflow-hidden rounded-lg bg-white  px-4 pb-4 pt-3 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                        <div class="my-4">
                                          <p class="text-sm mt-4 md:mt-0">Partager ce lien via</p>
                                
                                          <div class="flex my-2 items-center justify-start">
                                            <!--FACEBOOK ICON-->
                                            <a rel="noreferrer" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('publications.show', ['publication' => $publication]) }}&title={{ $publication->title }}" class="text-gray-600 hover:text-[#1877f2]">
                                              <span class="sr-only">Facebook</span>
                                              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                              </svg>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url={{ route('publications.show', ['publication' => $publication]) }}&text={{ $publication->title }}" rel="noreferrer" target="_blank" class="text-gray-600 hover:text-[#1d9bf0] ml-2">
                                              <span class="sr-only">X</span>
                                              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
                                              </svg>
                                            </a>
                                            <a href="#" class="text-gray-700 hover:text-[#bc2a8d] dark:hover:text-white dark:text-gray-400 ml-2">
                                              <svg class="w-6 h-6 text-gray-600 hover:text-[#bc2a8d]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                  <path
                                                      d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                                      />
                                              </svg>
                                            </a>
                                            <a href="https://api.whatsapp.com/send?text={{$publication->title}}%3A%20%0A{{ route('publications.show', ['publication' => $publication]) }}" rel="noreferrer" target="_blank" class="text-gray-600 hover:text-[#25D366] ml-3">
                                              <span class="sr-only">whatsapp</span>
                                              <svg fill="currentColor" aria-hidden="true" viewBox="0 0 24 24" class="h-[21px] w-[21px]">             
                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path>
                                              </svg>
                                            </a>
                                          </div>
                                
                                          <p class="text-sm mt-4">Ou copier lien</p>
                                          <!--BOX LINK-->
                                          <div class="border-2 border-gray-200 flex justify-between items-center mt-2 py-2">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              width="24"
                                              height="24"
                                              viewBox="0 0 24 24"
                                              class="fill-gray-500 ml-2"
                                            >
                                              <path
                                                d="M8.465 11.293c1.133-1.133 3.109-1.133 4.242 0l.707.707 1.414-1.414-.707-.707c-.943-.944-2.199-1.465-3.535-1.465s-2.592.521-3.535 1.465L4.929 12a5.008 5.008 0 0 0 0 7.071 4.983 4.983 0 0 0 3.535 1.462A4.982 4.982 0 0 0 12 19.071l.707-.707-1.414-1.414-.707.707a3.007 3.007 0 0 1-4.243 0 3.005 3.005 0 0 1 0-4.243l2.122-2.121z"
                                              ></path>
                                              <path
                                                d="m12 4.929-.707.707 1.414 1.414.707-.707a3.007 3.007 0 0 1 4.243 0 3.005 3.005 0 0 1 0 4.243l-2.122 2.121c-1.133 1.133-3.109 1.133-4.242 0L10.586 12l-1.414 1.414.707.707c.943.944 2.199 1.465 3.535 1.465s2.592-.521 3.535-1.465L19.071 12a5.008 5.008 0 0 0 0-7.071 5.006 5.006 0 0 0-7.071 0z"
                                              ></path>
                                            </svg>
                                
                                            <input class="w-full md:w-full outline-none bg-transparent" type="text" placeholder="link" value="{{ route('publications.show', ['publication' => $publication]) }}">
                                
                                          </div>
                                        </div>
                                          <button
                                            @click="isModalOpen = false"
                                            type="button"
                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                            Annuler
                                          </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>  
                   
                              </div>
                
                              </div>
                              <a href="{{ route('publications.show', ['publication' => $publication]) }}">
                                   <img class="w-full max-h-full object-cover pt-0 lg:max-h-none lg:h-60 rounded-md lg:rounded-lg  aspect-[16/9] sm:aspect-[2/1] lg:aspect-[16/6]" src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->image }}">
                              </a>
                          </div>
                          <div class="flex flex-col items-start space-y-[7px] lg:w-6/12 lg:mt-0 md:pl-4 md:ml-4">
                                    <div class=" flex flex-wrap gap-2 pl-2 lg:pl-0">
                                      @if ($publication->family)
                                      <a
                                      href="{{ route('publications.byFamily', ['family' => $publication->family]) }}"
                                      class=" bg-green-500 text-white px-2 py-1 md:text-sm font-semibold rounded-md" href="">
                                      {{ $publication->family->name }}
                                      </a>
                                      @endif
                                      @if ($publication->theme)
                                      @php
                                          // Get current ds query parameter value if it exists
                                          $ds = request()->has('ds') ? ['ds' => request()->ds] : [];
                                          // Build route parameters based on current path and ds parameter
                                          $routeParams = request()->is('families/*') 
                                                          ? array_merge(['family' => request()->family, 'theme' => $publication->theme->name], $ds) 
                                                          : array_merge(['theme' => $publication->theme->name], $ds);
                                      @endphp
                                  
                                      <a href="{{ route(request()->is('families/*') ? 'publications.byFamily' : 'index', $routeParams) }}" 
                                         class="bg-green-500 text-white px-2 py-1 md:text-sm font-semibold rounded-md">
                                          {{ $publication->theme->name }}
                                      </a>
                                      @endif
                                      @if ($publication->subtheme)
                                      @php
                                          // Get current ds query parameter value if it exists
                                          $ds = request()->has('ds') ? ['ds' => request()->ds] : [];
                                  
                                          // Build route parameters based on current path and ds parameter
                                          $routeParams = request()->is('families/*') 
                                                          ? array_merge(['family' => request()->family, 'subtheme' => $publication->subtheme->name], $ds) 
                                                          : array_merge(['subtheme' => $publication->subtheme->name], $ds);
                                      @endphp
                                  
                                      <a href="{{ route(request()->is('families/*') ? 'publications.byFamily' : 'index', $routeParams) }}" 
                                         class="bg-green-500 text-white mr-2 px-2 py-1 md:text-sm font-semibold rounded-md">
                                          {{ $publication->subtheme->name }}
                                      </a>
                                      @endif
                                      @if ($publication->latitude)
                                      <a target="_blank" href="http://maps.google.com/maps?q={{ $publication->latitude }},{{ $publication->longitude }}+(My+Point)&z=14&ll={{ $publication->latitude }},{{ $publication->longitude }}">
                                        <div class="w-8 h-8 md:hidden flex items-center justify-center rounded-md border border-green-500">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"/></svg>
                                      </div>
                                    </a>
                                    @endif
                                    </div>
                
                            <a href="{{ route('publications.show', ['publication' => $publication]) }}">
                              <p class="font-bold block text-slate-900 text-xl lg:text-2xl leading-tight pl-2 lg:pl-0">{{ $publication->title }}</p>
                            </a>
                              @if ($publication->subtitle)
                              <p class="text-md w-full block md:text-lg text-gray-800 pl-2 lg:pl-0">
                                {{ $publication->subtitle }}          
                              </p>
                              @endif
                              @if ($publication->startdate || $publication->ds)
                              <p class="text-md w-full block font-bold md:text-lg text-gray-700 pl-2 lg:pl-0">
                                  <time class="">
                                      <?php
                                      // Define an array of French month names
                                      $monthNames = [
                                          1 => 'janvier',
                                          2 => 'février',
                                          3 => 'mars',
                                          4 => 'avril',
                                          5 => 'mai',
                                          6 => 'juin',
                                          7 => 'juillet',
                                          8 => 'août',
                                          9 => 'septembre',
                                          10 => 'octobre',
                                          11 => 'novembre',
                                          12 => 'décembre'
                                      ];
                          
                                      if ($publication->startdate) {
                                          $startDate = \Carbon\Carbon::parse($publication->startdate)->locale('fr');
                                          $formattedStartDate = ucfirst($startDate->isoFormat('dddd DD ')) . $monthNames[$startDate->month] . ' ' ;
                          
                                          if ($publication->enddate) {
                                              $endDate = \Carbon\Carbon::parse($publication->enddate)->locale('fr');
                                              $formattedEndDate = ucfirst($endDate->isoFormat(' DD ')) . $monthNames[$endDate->month] . ' ' . $endDate->year . ' à ' . $endDate->format('H\:i\h');
                          
                                              // Output the date range
                                              echo "Du $formattedStartDate au $formattedEndDate";
                                          } else {
                                              // Output just the start date
                                              echo $formattedStartDate;
                                          }
                                      } elseif ($publication->ds) {
                                          $date = \Carbon\Carbon::parse($publication->ds)->locale('fr');
                                          $formattedDate = ucfirst($date->isoFormat('dddd DD ')) . $monthNames[$date->month] . ' ' . $date->year . ' à ' . $date->format('H\:i\h');
                          
                                          // Output the ds date
                                          echo $formattedDate;
                                      }
                                      ?>
                                  </time>
                              </p>
                          @endif
                          @if ($publication->city)
                          @php
                              // Get current ds query parameter value if it exists
                              $ds = request()->has('ds') ? ['ds' => request()->ds] : [];
                      
                              // Build route parameters based on current path and ds parameter
                              $routeParams = request()->is('families/*') 
                                              ? array_merge(['family' => request()->family, 'city' => $publication->city->name], $ds) 
                                              : array_merge(['city' => $publication->city->name], $ds);
                          @endphp
                      
                          <div class="pl-2 flex items-start lg:pl-0">
                              <a href="{{ route(request()->is('families/*') ? 'publications.byFamily' : 'index', $routeParams) }}" 
                                 class="text-md md:text-lg font-semibold flex text-black underline">
                                  {{ $publication->city->name }}
                              </a>
                              <span class="text-md mt-[3px] md:text-lg flex text-black">&nbsp;&nbsp;</span>
                              <span class="flex mt-[3px]">{{ $publication->address }}</span>
                          </div>
                      @else
                              <a class="text-md md:text-lg text-black underline pl-2 lg:pl-0">
                                Virtuelle
                              </a>
                              @endif
                            @if ($publication->duration)
                            <p class="text-md block w-full md:text-lg text-slate-600 pl-2 lg:pl-0">
                              Durée du {{ $publication->duration }} Minutes      
                            </p>
                            @endif
                            <div class=" flex justify-start items-center relative bg-yellow-200 z-20 px-2 ml-2 lg:ml-0 gradient-bg blur-sm bg-opacity-75">
                              @if ($publication->price)
                            <p class="text-md md:text-lg item-center font-bold text-yellow-200 pl-2 lg:pl-0">
                              À partir de : {{ $publication->price }} MAD
                            </p>
                            @else
                            <p class="text-md md:text-lg font-bold  text-yellow-200 pl-2 lg:pl-0">
                              Accès gratuit
                            </p>
                            @endif
                          </div>
                            <div class="flex z-30 px-2">
                              @if ($publication->price)
                            <p class="text-md md:text-lg -mt-8 md:-mt-9 font-bold text-black pl-2 lg:pl-0">
                              À partir de : {{ $publication->price }} MAD
                            </p>
                            @else
                            <p class="text-md md:text-lg font-bold -mt-8 md:-mt-9 text-black pl-2 lg:pl-0">
                              Accès gratuit
                            </p>
                            @endif
                            
                          </div>
                
                        
                
                          </div>
                          @if ($publication->latitude)
                          <a target="_blank" href="http://maps.google.com/maps?q={{ $publication->latitude }},{{ $publication->longitude }}+(My+Point)&z=14&ll={{ $publication->latitude }},{{ $publication->longitude }}">
                            <div class="w-7 h-7 hidden md:flex items-center justify-center rounded-md border border-[#10B981]">
                              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"/></svg>
                          </div>
                        </a>
                        @endif
                
                        </article>
                        
                        {{-- Fin du post --}}
                  @endforeach  
                  @endif


                </li>
              </ul>
          </div>
      </div>


        

      </div>
    </main>

    <footer class="bg-gray-50" aria-labelledby="footer-heading">
      <p id="footer-heading" class="sr-only">Footer</p>
      <div class="mx-auto px-4 md:ml-64 pt-10 sm:pt-12 lg:px-8 lg:pt-16">
        <div class="xl:grid grid-cols-2 xl:grid-cols-4 xl:gap-8">
          <div class="space-y-5 col-span-2">
            <a href="{{ route('index') }}" class="h-7 flex items-center justify-start ">
                <p href="#"  class="text-gray-900 font-bold text-3xl ">E</p>
                <img src="{{asset('img/logo-green-black.png')}}" alt="Logo" class="ml-1 h-7">
                <p href="#"  class="-ml-1 text-gray-900 font-bold text-3xl ">ent</p>
                <p href="#"  class="text-emerald-500 font-bold ml-1 text-3xl "> 31</p>
            </a>
            <p class="text-sm leading-6 text-gray-600">Get inspired, go out and enjoy</p>
            <div class="flex space-x-6">
              <a href="#" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Facebook</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Instagram</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">X</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">YouTube</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
                </svg>
              </a>
            </div>
          </div>
            <div class="col-span-2 grid md:ml-8 grid-cols-2 gap-8">
              <div class="mt-8 md:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-emerald-500">Redirection</h3>
                <ul role="list" class="mt-6 space-y-3">
                  <li>
                    <a href="{{ route('apropos') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">A propos</a>
                  </li>
                  <li>
                    <a href="{{ route('contact') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Contact</a>
                  </li>
                  <li>
                    <a href="{{ route('blogs.index') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blogs</a>
                  </li>
                </ul>
              </div>
              <div class="mt-8 md:ml-8 md:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-emerald-500">Policy</h3>
                <ul role="list" class="mt-6 space-y-3">
                  <li>
                    <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Revoir</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        <div class=" col-span-4 border-t border-gray-900/10 mt-4 pt-4 pb-4 ">
          <p class="text-xs leading-5 "><span class="text-emerald-500">&copy; 2024 Event31,</span> <span class="text-gray-500">Conception et design : <a href="https://edersys.ma/" target="_blank">E-dersys SARL</a></span></p>
        </div>
      </div>
      </div>
    </footer>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const pickerInput = document.getElementById('publicationDatePickerr');

    flatpickr(pickerInput, {
        dateFormat: "Y-m-d",
        enable: @json($validDates),  // Ensure the valid dates are formatted correctly and passed into the script
        onChange: function(selectedDates, dateStr, instance) {
            // Handle date changes, if needed
        }
    });

    // Attach this listener after initializing Flatpickr
    if (pickerInput) {
        pickerInput.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the click from propagating to parent elements
        });
    }
});
      </script>
          <script>
document.addEventListener("DOMContentLoaded", function() {
    const pickerInput = document.getElementById('publicationDatePickerrr');

    flatpickr(pickerInput, {
        dateFormat: "Y-m-d",
        enable: @json($validDates),  // Ensure the valid dates are formatted correctly and passed into the script
        onChange: function(selectedDates, dateStr, instance) {
            // Handle date changes, if needed
        }
    });

    // Attach this listener after initializing Flatpickr
    if (pickerInput) {
        pickerInput.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the click from propagating to parent elements
        });
    }
});
      </script>
 <script>
  document.addEventListener("DOMContentLoaded", function() {
      var validDates = @json($validDates);
      var selectedDate = "{{ $selectedDate }}";
      var dateIndex = validDates.indexOf(selectedDate);
      
      function navigateToNextDay(offset) {
          var newIndex = dateIndex + offset;
          if (newIndex >= 0 && newIndex < validDates.length) {
              var newDate = validDates[newIndex];
              var newURL = "{{ request()->is('families/*') ? route('publications.byFamily', ['family' => request()->family]) : route('index') }}?ds=" + newDate;
      
              var city = "{{ request()->input('city', '') }}";
              if (city) newURL += "&city=" + city;
      
              var search = "{{ request()->input('search', '') }}";
              if (search) newURL += "&search=" + search;
      
              window.location.href = newURL;
          } else {
              console.log("No further date available");
          }
      }
      
      flatpickr("#publicationDatePicker", {
          dateFormat: "Y-m-d",
          enable: validDates,
          onChange: function(selectedDates, dateStr, instance) {
              var newURL = "{{ request()->is('families/*') ? route('publications.byFamily', ['family' => request()->family]) : route('index') }}?ds=" + dateStr;
      
              var city = "{{ request()->input('city', '') }}";
              if (city) newURL += "&city=" + city;
      
              var search = "{{ request()->input('search', '') }}";
              if (search) newURL += "&search=" + search;
      
              window.location.href = newURL;
          }
      });
      
      if (dateIndex === 0) {
          document.getElementById("left-arrow").style.display = "none";
      }
      
      if (dateIndex === validDates.length - 1) {
          document.getElementById("right-arrow").style.display = "none";
      }
      
      document.getElementById("left-arrow").addEventListener("click", function() {
          navigateToNextDay(-1);
      });
      
      document.getElementById("right-arrow").addEventListener("click", function() {
          navigateToNextDay(1);
      });
      
      document.getElementById("clear-date").addEventListener("click", function() {
          var url = new URL(window.location.href);
          url.searchParams.delete("ds");
      
          window.location.href = url.toString();
      });
  });
</script>
    <script>
      new Glide('.glide', {
        type: 'carousel',
        perView: 2, // Nombre d'éléments visibles à la fois
        gap: 0.01, // Espace entre les éléments
        dragSpeed: 0.1,
        breakpoints: {
          800: {
            perView: 2
          },
          600: {
            perView: 2
          }
        }
      }).mount();
    </script>
</body>

</html>



