<nav class="bg-white flex w-full mx-auto items-center py-2">  
    {{-- Button burger pour ouvrir le menu sur le mobile --}}
    <div class="w-4/12">
      <button @click="menuOpen = true" type="button" class="text-gray-700 w-2/6 mt-1 items-center md:hidden px-1">
        <span class="sr-only"> sidebar</span>
        <img x-show="!menuOpen" src="{{asset('svg/menu/burger.svg')}}" alt="Logo" class="h-10 w-10">
      </button>
    </div>
    <!-- Logo au centre -->
    <a  href="{{ route('index') }}" class="w-4/12 flex items-center justify-center ">
      <p href="#"  class="text-gray-900 font-bold text-3xl ">E</p>
      <img src="{{asset('img/logo-green-black.png')}}" alt="Logo" class="ml-1 h-7">
      <p href="#"  class="-ml-1 text-gray-900 font-bold text-3xl ">ent</p>
      <p href="#"  class="text-emerald-500 font-bold ml-1 text-3xl "> 31</p>
    </a>
    <!-- inscription et connexion  -->
    <div class="flex h-8 items-center justify-end w-4/12 mr-2">
      <!-- burgger  +  Search bar -->
  <!-- burgger -->
  <!-- Search bar + notification + profile -->
  <div class="flex w-full md:mt-4">
    <!-- Search bar -->
    <div class="flex w-10/12 items-center justify-center">
      <img src="{{asset('logo/logo.png')}}" class="flex h-12 items-center justify-center" alt="">
    </div>
   
    <!--notification + Profile dropdown -->
    <div class="ml-1 flex flex-row w-[64px] md:w-64 items-center justify-end">
      @auth
      <div class="ml-4 flex items-center md:ml-6">
        
        @livewire('event-notifications')
        <!-- Profile dropdown -->
        <div class="relative z-40 ml-3">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <div>
                        <button type="button" class="relative md:hidden flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 lg:rounded-md lg:p-2 lg:hover:bg-gray-50" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5 lg:hidden"></span>
                            <img class="h-8 w-16 rounded-full" src="{{ auth()->user()->image ? auth()->user()->image : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541'  }}" alt="">
                            <span class="text-md font-semibold text-gray-500 ml-8" ></span>
                            <svg class="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button type="button" class="relative hidden md:flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 lg:rounded-md lg:p-2 lg:hover:bg-gray-50" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                          <span class="absolute -inset-1.5 lg:hidden"></span>
                          <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->image ? auth()->user()->image : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541'  }}" alt="">
                          <span class="text-md  font-semibold  text-gray-500 ml-2" x-data="{{ json_encode(['name' => auth()->user()->username]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></span>
                          <svg class="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                          </svg>
                      </button>
                    </div>
                </x-slot>
                <div class="absolute right-0 z-40 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <x-slot name="content">
                        <x-dropdown-link :href="route('settings')" >
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('dashboard')" >
                          {{ __('Tableau de bord') }}
                      </x-dropdown-link>
                      <x-dropdown-link :href="route('favorites')" >
                        {{ __('Mes Favoris') }}
                    </x-dropdown-link>
                        <!-- Authentication -->
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                          @csrf
                      </form>
                      <button type="button" class="w-full text-start" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <x-dropdown-link>
                              {{ __('Se déconnecter') }}
                          </x-dropdown-link>
                      </button>
                    </x-slot>
                </div>
            </x-dropdown>
        </div>
    </div>
          @else
            <a class="hidden md:flex"  href="{{ route('login') }}">
              <p class="px-2 text-md font-semibold leading-6 text-emerald-600">Connexion</p>
            </a>
            <a class="md:hidden items-center text-emerald-600"  href="{{ route('login') }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
              </svg>              
          </a>
            @if (Route::has('register'))
              <a class="hidden md:flex text-md font-semibold leading-6 text-emerald-600"  href="{{ route('register') }}">
                Inscription
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-1 group-hover:ml-2 group-hover:mr-0 transition-all">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>              
              </a>
              <a class="md:hidden items-center text-emerald-600"  href="{{ route('register') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>                
              </a>
            @endif
        @endauth
    </div>
  </div>

</div>

</nav>

