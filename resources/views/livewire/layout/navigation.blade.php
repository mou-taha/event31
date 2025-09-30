<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
 
        $this->redirect('/', navigate: true);
    }
}; ?>


<div x-data="{ open: false }" class="min-h-full"><!-- <html class="h-full bg-gray-100"><body class="h-full">-->
    <!-- mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class=" hidden relative z-40 lg:hidden" role="dialog" aria-modal="true">
      <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity ease-linear duration-300"></div>
      <div class="fixed inset-0 z-40 flex transition ease-in-out duration-300 transform">
        <div class="relative flex w-full max-w-xs flex-1 flex-col bg-emerald-700 pb-4 pt-5">
          <div class="absolute right-0 top-0 -mr-12 pt-2">
            <!-- Close button -->
            <button @click="open = false" class="relative ml-1 flex h-10 w-10 items-center justify-center rounded-full bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white shadow-lg transition-colors duration-200">
              <span class="sr-only">Close sidebar</span>
              <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="flex ml-3 flex-shrink-0 items-center">
            <a href="{{ route('dashboard') }}" >
              <div class="h-7 flex items-center justify-start ">
                <p href="#"  class="text-emerald-200 font-bold text-xl ">E</p>
                <img src="{{asset('img/logo-green-black.png')}}" alt="Logo" class="ml-[3px] h-5">
                <p href="#"  class=" text-emerald-200 font-bold text-xl ">ent</p>
                <p href="#"  class="text-emerald-500 font-bold ml-1 text-xl "> 31</p>
            </div>            
          </a>
          </div>
          <nav class="mt-5 h-full flex-shrink-0 divide-y divide-emerald-800 overflow-y-auto" aria-label="Sidebar">
            <div class="space-y-1 px-2">
              <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                {{ __('Tableau de bord') }}
              </x-nav-link>
              @canany(['Lire Utilisateur', 'Lire Permission', 'Lire Role'])
              <x-nav-link :href="route('access')" :active="(request()->routeIs('access') || request()->routeIs('permissions') || request()->routeIs('roles'))" >
                  <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />                </svg>
                  {{ __('Gestion des accès') }}
              </x-nav-link>
              @endcanany
              @canany(['Lire Blog', 'Lire Categorie', 'Lire Tag'])
              <x-nav-link :href="route('blogs')" :active="(request()->routeIs('blogs') || request()->routeIs('categories') || request()->routeIs('tags') || request()->routeIs('inputblog'))" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                </svg>
                {{ __('Gestion des blogs') }}
              </x-nav-link>
              @endcanany
              <x-nav-link :href="route('events')" :active="(request()->routeIs('events') || request()->routeIs('menus') || request()->routeIs('types') || request()->routeIs('subtypes') || request()->routeIs('cities') || request()->routeIs('organisms') || request()->routeIs('inputorganism') || request()->routeIs('prices') || request()->routeIs('inputevent'))" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                </svg>          
                {{ __('Gestion des publications') }}
              </x-nav-link>
              @can('Lire Utilisateur')                
              <x-nav-link :href="route('users')" :active="request()->routeIs('users')" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />                </svg>
                {{ __('Liste des utilisateurs') }}
              </x-nav-link>
              @endcan
              @can('Lire Organisme')  
              <x-nav-link :href="route('org')" :active="request()->routeIs('org')" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
                {{ __('Liste des organismes') }}
              </x-nav-link>
              @endcan
              <x-nav-link :href="route('favorites')" :active="request()->routeIs('favorites')" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                {{ __('Mes Favoris') }}
              </x-nav-link>
            </div>
            <div class="mt-6 pt-6">
              <div class="space-y-1 px-2">
                <x-nav-link :href="route('settings')" :active="(request()->routeIs('settings') || request()->routeIs('settingsaccount') || request()->routeIs('settingspassword'))" >
                  <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                  </svg>
                  {{ __('Paramètres') }}
                </x-nav-link>
                <a href="{{route('cadmin')}}"  class="group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6 text-emerald-100 hover:bg-emerald-600 hover:text-white">
                  <svg class="mr-4 h-6 w-6 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                  </svg>
                  Contact
                </a>
                <x-nav-link :href="route('privacy')" :active="(request()->routeIs('privacy'))" >
                  <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                  </svg>
                  {{ __('Confidentialité') }}
                </x-nav-link>
              </div>
            </div>
          </nav>
        </div>
        <div class="w-14 flex-shrink-0" aria-hidden="true">
      <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
      </div>
    </div>
  
  
    <!--desktop -->
    <div class="hidden  lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
      <div class="flex flex-grow flex-col overflow-y-auto bg-emerald-700 pb-4 pt-5">
        <div class="flex flex-shrink-0 items-center px-4">
          <a href="{{ route('index') }}" >
            <a href="{{ route('index') }}" >
              <div class="h-7 flex items-center justify-start ">
                <p href="#"  class="text-emerald-200 font-bold text-xl ">E</p>
                <img src="{{asset('img/logo-green-black.png')}}" alt="Logo" class="ml-[3px] h-5">
                <p href="#"  class=" text-emerald-200 font-bold text-xl ">ent</p>
                <p href="#"  class="text-emerald-500 font-bold ml-1 text-xl "> 31</p>
            </div>            
          </a>
          </a>
        </div>
        <nav class="mt-5 flex flex-1 flex-col divide-y divide-emerald-800 overflow-y-auto" aria-label="Sidebar">
          <div class="space-y-1 px-2">
              <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                {{ __('Tableau de bord') }}
              </x-nav-link>
              @canany(['Lire Utilisateur', 'Lire Permission', 'Lire Role'])
              <x-nav-link :href="route('access')" :active="(request()->routeIs('access') || request()->routeIs('permissions') || request()->routeIs('roles'))" >
                  <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />                </svg>
                  {{ __('Gestion des accès') }}
              </x-nav-link>
              @endcanany
              @canany(['Lire Blog', 'Lire Categorie', 'Lire Tag'])
              <x-nav-link :href="route('blogs')" :active="(request()->routeIs('blogs') || request()->routeIs('categories') || request()->routeIs('tags') || request()->routeIs('inputblog'))" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                </svg>
                {{ __('Gestion des blogs') }}
              </x-nav-link>
              @endcanany
              <x-nav-link :href="route('events')" :active="(request()->routeIs('events') || request()->routeIs('menus') || request()->routeIs('types') || request()->routeIs('subtypes') || request()->routeIs('cities') || request()->routeIs('organisms') || request()->routeIs('inputorganism') || request()->routeIs('prices') || request()->routeIs('inputevent'))" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                </svg>          
                {{ __('Gestion des publications') }}
              </x-nav-link>
              @can('Lire Utilisateur')                
              <x-nav-link :href="route('users')" :active="request()->routeIs('users')" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />                </svg>
                {{ __('Liste des utilisateurs') }}
              </x-nav-link>
              @endcan
              @can('Lire Organisme')  
              <x-nav-link :href="route('org')" :active="request()->routeIs('org')" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
                {{ __('Liste des organismes') }}
              </x-nav-link>
              @endcan
              <x-nav-link :href="route('favorites')" :active="request()->routeIs('favorites')" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                {{ __('Mes Favoris') }}
              </x-nav-link>
          </div>
          <div class="mt-6 pt-6">
            <div class="space-y-1 px-2">
              <x-nav-link :href="route('settings')" :active="(request()->routeIs('settings') || request()->routeIs('settingsaccount') || request()->routeIs('settingspassword'))" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                </svg>
                {{ __('Paramètres') }}
              </x-nav-link>
              <a href="{{route('cadmin')}}"  class="group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6 text-emerald-100 hover:bg-emerald-600 hover:text-white">
                <svg class="mr-4 h-6 w-6 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                </svg>
                Contact
              </a>
              <x-nav-link :href="route('privacy')" :active="(request()->routeIs('privacy'))" >
                <svg class="mr-4 h-6 w-6 flex-shrink-0 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
                {{ __('Confidentialité') }}
              </x-nav-link>
            </div>
          </div>
        </nav>
      </div>
    </div>
  

