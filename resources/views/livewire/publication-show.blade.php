<div x-data="{ sidebarOpen: false, menuOpen: false }" x-cloak class="h-full z-10 bg-gray-50">
  <header class="bg-white fixed top-0 left-0 right-0 z-30">
    @include('partials.default-nav') 
        <!-- Menu centré -->
    <div class="hidden md:flex pb-3 pt-3 shadow-sm justify-center">
        <ul class="flex items-center space-x-6">
            <li class="relative">
                <a href="{{ route('index') }}" class="nav-link font-semibold {{ request()->routeIs('index') ? 'text-emerald-500' : 'text-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-gray-500 after:transition-all after:duration-300 hover:after:w-full">Accueil</a>
            </li>
            @foreach ($menus as $menu)
            <li class="relative">
              <a href="{{ route('menus.index', ['id' => $menu->id]) }}"
                id="menu-{{ $menu->id }}"
                class="nav-link font-semibold 
                    {{ Request::route('id') == $menu->id ? 'text-emerald-500 after:bg-emerald-500' : 'text-gray-500 after:bg-gray-500' }} 
                    text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:transition-all after:duration-300 hover:after:w-full">
                  {{ $menu->name }}
              </a>
            </li>
          @endforeach
            <li class="relative">
              <a href="{{ route('blogs.index') }}" class="nav-link font-semibold {{ request()->routeIs('blogs.index') ? 'text-emerald-500' : 'text-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-gray-500 after:transition-all after:duration-300 hover:after:w-full">Blogs</a>
            </li>
            <!-- <li class="relative">
                <a href="#" class="bg-emerald-500 hover:bg-emerald-700 text-white px-4 pb-2 pt-1 text-md font-semibold rounded-md">Ajouter un event</a>
            </li> -->
        </ul>
    </div>
</header>
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
                          <a href="" class="text-gray-600 bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
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



        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-4 mt-0 md:mt-4 lg:mt-4">
    
            <div class="space-y-10 md:space-y-16">
      
                <section class="mt-20 md:mt-28">
                    <div class="container md:px-6 pb-10 mx-auto">
                      <div class=" justify-center flex">
                      <h1 class=" md:mt-6 mb-4 text-2xl md:text-4xl font-bold leading-tight text-gray-900">
                        {{ $details['event']->title }}
                    </h1>
                  </div>
                        <div class="lg:flex lg:-mx-6">
                            <div class="lg:w-[840px] lg:px-6">
                                <img class="object-cover object-center w-full h-45 xl:h-[28rem] rounded-xl" src="{{ asset('storage/' . $details['event']->image) }}" alt="{{ $details['event']->image }}">
                                <div>
      
                                    <p class="max-w-lg mt-4 md:mt-6 text-lg font-semibold leading-tight text-gray-900">
                                        Description
                                    </p>
                                    <p class="mt-4 inline">{!! nl2br(e($details['event']->content)) !!}</p>
      
                                    
                            
                                </div>
                            </div>
        
                            <div class="flex justify-center rounded-xl mt-5 md:mt-0 md:ml-4 p-6 ring-1 xl:p-6 md:h-[447px] bg-gray-900 ring-gray-900">
                              <div class="text-center ">
                                @if ($details['datestart'])  
                                <p id="tier-enterprise" class="text-base font-semibold leading-8 text-white">{{ ucfirst(\Carbon\Carbon::parse($details['datestart'])->locale('fr')->isoFormat('dddd DD-MM-YYYY [à]')) }} {{ \Carbon\Carbon::parse($details['datestart'])->locale('fr')->format('H:i') }}</p>
                                @endif
                                  @if ($details['city'])
                                  <p class="text-sm leading-6 text-white">
                                  <span class="font-semibold text-emerald-500">{{ $details['city'] }} :</span>
                                  <a target="_blank" href="http://maps.google.com/maps?q={{ $details['latitude'] }},{{ $details['longitude'] }}+(My+Point)&z=14&ll={{ $details['latitude'] }},{{ $details['longitude'] }}" class="underline">  {{ $details['address'] }}</a>
                                  </p>
                                  @else
                                  <p class="text-sm leading-6 text-white">L'évènement virtuelle</p>
                                  @endif 
                                  <div x-data="{ open: false }" class="relative w-full inline-block pr-3 lg:pr-0 text-left">
                                  @if ($details['prices']->isEmpty())
                                  <p class="mt-4 flex justify-between px-4 w-full rounded-md py-2 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-gray-700 text-white  focus-visible:outline-white">Accès gratuit</p>
                                @elseif ($details['prices']->count() == 1)
                                  <p class="mt-4 flex justify-between px-4 w-full rounded-md py-2 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-gray-700 text-white  focus-visible:outline-white">
                                      A partir de : {{ $details['prices'][0]->pivot->cost }} MAD
                                  </p>
                                @else
                                  <button @click="open = !open" class="mt-4 flex justify-between px-4 w-full rounded-md py-2 text-center text-sm font-semibold  leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-gray-700 text-white  focus-visible:outline-white">
                                    A partir de : {{ $details['lowest_cost'] }} MAD
                                  </button>
                                  <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-gray-700 ring-1 ring-black ring-opacity-5">
                                      <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                          @foreach ($details['prices'] as $price)
                                              <a class="block px-4 {{ $loop->last ? '' : 'border-b-2 border-b-white' }} py-2 text-xs md:text-sm font-semibold text-white" role="menuitem">
                                                  {{ $price->name }} : {{ $price->pivot->cost }} MAD
                                              </a>
                                          @endforeach
                                      </div>
                                  </div>
                              @endif
                              </div>
                                  <a href="{{ $details['event']->link }}" target="_blank" class="mt-4 block rounded-md py-1 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-emerald-600 text-white hover:text-white hover:bg-emerald-400 focus-visible:outline-white">Participer</a>
                                <div class="mt-2">

                              @if ($details['datestart'])  
                              <div class="mt-6 flex flex-col items-center ml-2">
                                <p class="text-white uppercase text-sm">Temps restant avant l'évènement</p>
                                <div class="flex items-center justify-center space-x-2 mt-2" x-data="timer(new Date('{{ $details['datestart'] }}'))" x-init="init();">
                                    <div class="flex flex-col items-center">
                                        <span x-text="time().days" class="text-xl lg:text-4xl text-white">00</span>
                                        <span class="text-white text-sm mt-2">Jours</span>
                                    </div>
                                    <span class="w-[1px] h-24 bg-emerald-500"></span>
                                    <div class="flex flex-col items-center">
                                        <span x-text="time().hours" class="text-xl lg:text-4xl text-white">23</span>
                                        <span class="text-white text-sm mt-2">Heures</span>
                                    </div>
                                    <span class="w-[1px] h-24 bg-emerald-500"></span>
                                    <div class="flex flex-col items-center">
                                        <span x-text="time().minutes" class="text-xl lg:text-4xl text-white">59</span>
                                        <span class="text-white text-sm mt-2">Minutes</span>
                                    </div>
                                    <span class="w-[1px] h-24 bg-emerald-500"></span>
                                    <div class="flex flex-col items-center">
                                        <span x-text="time().seconds" class="text-xl lg:text-4xl text-white">28</span>
                                        <span class="text-white text-sm mt-2">Seconds</span>
                                    </div>
                                </div>                      
                            <script>
                              function timer(expiry) {
                                  return {
                                      expiry: expiry,
                                      remaining: null,
                                      init() {
                                          this.setRemaining()
                                          setInterval(() => {
                                              this.setRemaining();
                                          }, 1000);
                                      },
                                      setRemaining() {
                                          const diff = this.expiry - new Date().getTime();
                                          this.remaining = parseInt(diff / 1000);
                                      },
                                      days() {
                                          return {
                                              value: this.remaining / 86400,
                                              remaining: this.remaining % 86400
                                          };
                                      },
                                      hours() {
                                          return {
                                              value: this.days().remaining / 3600,
                                              remaining: this.days().remaining % 3600
                                          };
                                      },
                                      minutes() {
                                          return {
                                              value: this.hours().remaining / 60,
                                              remaining: this.hours().remaining % 60
                                          };
                                      },
                                      seconds() {
                                          return {
                                              value: this.minutes().remaining,
                                          };
                                      },
                                      format(value) {
                                          return ("0" + parseInt(value)).slice(-2)
                                      },
                                      time() {
                                          return {
                                              days: this.format(this.days().value),
                                              hours: this.format(this.hours().value),
                                              minutes: this.format(this.minutes().value),
                                              seconds: this.format(this.seconds().value),
                                          }
                                      },
                                  }
                              }
                            </script>
                              @endif
                              <div class="mt-5">
                                <p class="text-md font-semibold leading-8 text-gray-500">Partager l'évenement</p>
                                <div class="flex justify-center mt-2 space-x-6">
                                  <a rel="noreferrer" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('show', [$details['type'], $details['id']]) }}&title={{ $details['event']->title }}" class="text-gray-600 hover:text-white">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                    </svg>
                                  </a>
                                  <a href="https://twitter.com/intent/tweet?url={{ route('show', [$details['type'], $details['id']]) }}&text={{ $details['event']->title }}" rel="noreferrer" target="_blank" class="text-gray-600 hover:text-white">
                                    <span class="sr-only">X</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                      <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
                                    </svg>
                                  </a>
                                  <a href="https://api.whatsapp.com/send?text={{$details['event']->title}}%3A%20%0A{{ route('show', [$details['type'], $details['id']]) }}" rel="noreferrer" target="_blank" class="text-gray-600 hover:text-white">
                                    <span class="sr-only">Whatsapp</span>
                                    <svg fill="currentColor" aria-hidden="true" viewBox="0 0 24 24" class="h-6 w-6">             
                                      <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path>
                                    </svg>
                                  </a>
                                </div>
                              </div>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </section>
              </div>
            </div>
        
                  {{--la partie du détail--}}
        
      
      <div class="flex justify-center">
        <img src="{{asset('img/logo-green-black.png')}}" alt="Logo" class="h-8 md:h-10">
      </div>
      <div class="flex justify-center">
        <p class="max-w-2xl text-3xl px-4 tracking-tight text-gray-900 lg:col-span-2 xl:col-auto">Autres événements</p>
      </div>
      <div class="flex justify-center">
        <p class="max-w-2xl text-lg px-4 tracking-tight text-gray-900 lg:col-span-2 xl:col-auto">Trier par date</p>
      </div>
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-4 md:mt-4 lg:mt-4"> 
        <div class="space-y-10 md:space-y-16">
            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-20 gap-y-20">
              @foreach($latestSix as $item)
              <div class="shadow-md border rounded-lg xl:h-full md:h-full">
                        <a  href="{{ route('show', [$item['type'], $item['id']]) }}" class="aspect-w-16 h-[140px] aspect-h-9 block overflow-hidden">                
                            <img class="object-cover w-full h-full rounded-tl-lg rounded-tr-lg" src="{{ asset('storage/' . $item['event']->image) }}" alt="{{ $item['event']->image }}" />
                        </a>
                        <div class="mt-2 ml-2">
                            <div class="flex justify-start">
                                @if ($item['event']->family)
                                    <a href="" class="bg-gray-900 text-white mb-2 mt-1 px-2 py-1 text-xs md:text-sm font-semibold rounded-md">
                                        {{ $item['event']->family->name }}
                                    </a>
                                @endif
                                @if ($item['event']->theme)
                                    <a href="" class="bg-gray-900 text-white ml-2 mb-2 mt-1 px-2 py-1 text-xs md:text-sm font-semibold rounded-md">
                                        {{ $item['event']->theme->name }}
                                    </a>
                                @endif
                                @if ($item['event']->subtheme)
                                    <a href="" class="bg-gray-900 text-white mb-2 ml-2 mt-1 px-2 py-1 text-xs md:text-sm font-semibold rounded-md">
                                        {{ $item['event']->subtheme->name }}
                                    </a>
                                @endif
                            </div>
                            <a  href="{{ route('show', [$item['type'], $item['id']]) }}">
                                <h5 class="mb-3 text-lg font-bold tracking-tight text-gray-900">{{ $item['event']->title }}</h5>
                            </a>
                        </div>
                        <div class="flex ml-2 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-5 w-5 mb-3 -mt-3 text-green-600 group-hover:text-green-600" fill="currentColor">
                                <path d="M176 256C176 211.8 211.8 176 256 176C300.2 176 336 211.8 336 256C336 300.2 300.2 336 256 336C211.8 336 176 300.2 176 256zM256 0C273.7 0 288 14.33 288 32V66.65C368.4 80.14 431.9 143.6 445.3 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H445.3C431.9 368.4 368.4 431.9 288 445.3V480C288 497.7 273.7 512 256 512C238.3 512 224 497.7 224 480V445.3C143.6 431.9 80.14 368.4 66.65 288H32C14.33 288 0 273.7 0 256C0 238.3 14.33 224 32 224H66.65C80.14 143.6 143.6 80.14 224 66.65V32C224 14.33 238.3 0 256 0zM128 256C128 326.7 185.3 384 256 384C326.7 384 384 326.7 384 256C384 185.3 326.7 128 256 128C185.3 128 128 185.3 128 256z"/>
                            </svg>
                            @if ($item['city'])
                                <a>
                                    <p class="mb-3 -mt-3 ml-1 text-sm font-bold tracking-tight text-gray-900">{{ $item['city'] }}</p>
                                </a>
                                <p class="mb-3 -mt-3 ml-1 text-sm tracking-tight text-gray-600">{{ $item['address'] }}</p>
                            @else
                                <a>
                                    <p class="mb-3 -mt-3 ml-1 text-sm font-bold tracking-tight text-gray-900">Event :</p>
                                </a>
                                <p class="mb-3 -mt-3 ml-1 text-sm tracking-tight text-gray-600">Virtual</p>
                            @endif
                        </div>
                        <div class="flex mt-3 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-4 w-4 ml-[2px] -mt-3 text-green-600 group-hover:text-green-600" fill="currentColor">
                                <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
                            </svg>
                            <div x-data="timer(new Date('{{ $item['datestart'] }}'))" x-init="init();" class="flex">
                                <div class="flex ml-1">
                                    <p x-text="time().days" class="mb-3 -mt-[18px] ml-1 text-lg font-bold tracking-tight text-gray-900">00</p>
                                    <p class="mb-3 -mt-3 ml-1 text-sm tracking-tight text-gray-600">j</p>
                                </div>
                                <div class="flex ml-1">
                                    <p x-text="time().hours" class="mb-3 -mt-[18px] ml-1 text-lg font-bold tracking-tight text-gray-900">00</p>
                                    <p class="mb-3 -mt-3 ml-1 text-sm tracking-tight text-gray-600">h</p>
                                </div>
                                <div class="flex ml-1">
                                    <p x-text="time().minutes" class="mb-3 -mt-[18px] ml-1 text-lg font-bold tracking-tight text-gray-900">00</p>
                                    <p class="mb-3 -mt-3 ml-1 text-sm tracking-tight text-gray-600">m</p>
                                </div>
                                <div class="flex ml-1">
                                    <p x-text="time().seconds" class="mb-3 -mt-[18px] ml-1 text-lg font-bold tracking-tight text-gray-900">00</p>
                                    <p class="mb-3 -mt-3 ml-1 text-sm tracking-tight text-gray-600">s</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex mt-4 ml-2">
                            @if ($item['lowest_cost'])
                                <div class="w-full">
                                    <p class="mb-3 -mt-3 ml-1 text-md tracking-tight text-gray-600">À partir de :</p>
                                    <div class="grid-cols-4 justify-between flex">
                                        <div class="flex col-span-1 items-end">
                                            <p class="mb-3 -mt-3 font-bold text-3xl tracking-tight text-green-600">{{ $item['lowest_cost'] }}</p>
                                            <p class="mb-3 -mt-3 ml-1 font-bold text-md tracking-tight text-green-600">MAD</p>
                                        </div>
                                        <div class="col-span-1">
                                            <a class="mb-3 items-end mr-4 -mt-3 md:ml-[56px] bg-green-700 text-white px-4 py-1 text-md font-semibold rounded-md" href="{{ $item['event']->title }}">
                                                Participer
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="w-full">
                                    <p class="mb-3 -mt-3 ml-1 text-md tracking-tight text-gray-600">Accès :</p>
                                    <div class="grid-cols-4 justify-between flex">
                                        <div class="flex col-span-1">
                                            <p class="mb-3 -mt-3 ml-1 font-bold text-3xl tracking-tight text-green-600">Gratuit</p>
                                        </div>
                                        <div class="col-span-1">
                                            <a class="mb-3 items-end mr-4 -mt-3 md:ml-[56px] bg-green-700 text-white px-4 py-1 text-md font-semibold rounded-md" href="">
                                                Participer
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
      
      
          <footer class="bg-white mt-16 border">
            <div class="mx-auto max-w-7xl overflow-hidden px-6 py-6 sm:py-8 lg:px-8">
              <nav class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12" aria-label="Footer">
                <div class="pb-6">
                  <a href="{{ route('index') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Accueil</a>
                </div>
                <div class="pb-6">
                  <a href="" class="text-sm leading-6 text-gray-600 hover:text-gray-900">A propos</a>
                </div>
                <div class="pb-6">
                  <a href="" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Contact</a>
                </div>
                <div class="pb-6">
                  <a href="" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blog</a>
                </div>
                <div class="pb-6">
                  <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy</a>
                </div>
                <div class="pb-6">
                  <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms</a>
                </div>
              </nav>
              <div class="mt-10 flex justify-center space-x-10">
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
                  <span class="sr-only">GitHub</span>
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                  </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                  <span class="sr-only">YouTube</span>
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
                  </svg>
                </a>
              </div>
              <p class="mt-10 text-center text-xs leading-5 text-gray-500">&copy; 2024 Event31, Inc. All rights reserved.</p>
            </div>
          </footer>  
      

</div>