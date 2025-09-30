
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <livewire:styles />
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                      <a href="{{ route('index') }}" class="nav-link font-semibold {{ request()->routeIs('index') ? 'text-emerald-500' : 'text-gray-500' }} text-md relative transition ease-in-out duration-300 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-gray-500 after:transition-all after:duration-300 hover:after:w-full">Accueil</a>
                  </li>
                  @foreach ($menus as $menu)
                  <li class="relative">
                      <a href="{{ route('menus.index', ['id' => $menu->id]) }}"
                         id="menu-{{ $menu->id }}"
                         class="nav-link font-semibold 
                                {{ (Request::segment(2) == $menu->slug || Request::segment(2) == $menu->id) ? 'text-emerald-500 after:bg-emerald-500' : 'text-gray-500 after:bg-gray-500' }} 
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
              <div class="flex grow flex-col z-50 gap-y-5 overflow-y-auto bg-white -pt-4 px-2 pb-4">
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
                        <a  href="{{ route('menus.index', ['id' => $menu->id]) }}" class="{{ request()->route('menus.index') && request()->route('id') == $menu->id ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-900' }}">{{ $menu->name }}</a>
                    </li>
                @endforeach
            </ul>

          </div>
          </div>
      </div>



      <div class="bg-white">
        <!-- Header -->
    
      
        <main class="isolate -mt-16 md:-mt-10">
          <!-- Hero section -->
          <div class="relative isolate -z-10 overflow-hidden bg-gradient-to-b from-green-100/">
            <div class="absolute inset-y-0 right-1/2 -z-10 -mr-96 w-[200%] origin-top-right skew-x-[-30deg] bg-white shadow-xl shadow-emerald-600/10 ring-1 ring-emerald-50 sm:-mr-80 lg:-mr-96" aria-hidden="true"></div>
            <div class="mx-auto max-w-7xl px-6 py-32 sm:py-40 lg:px-8">
              <div class="mx-auto max-w-2xl lg:mx-0 lg:grid lg:max-w-none lg:grid-cols-2 lg:gap-x-16 lg:gap-y-6 xl:grid-cols-1 xl:grid-rows-1 xl:gap-x-8">
                <h1 class="max-w-2xl text-4xl py-2 font-bold tracking-tight text-gray-900 sm:text-5xl lg:col-span-2 xl:col-auto">A propos</h1>
                <div class="mt-6 max-w-xl lg:mt-0 xl:col-end-1 xl:row-start-1">
                  <p class="text-lg leading-8 text-gray-600">
                   <span class="font-bold text-emerald-600">Event31</span> est une plateforme marocaine qui vise à faciliter le partage, la découverte et l'organisation d'événements locaux à proximité de manière <span class="font-bold text-emerald-600">simple et intuitive.</span><br>
        Notre histoire a commencé avec un groupe de partage d'événements sur WhatsApp, qui a rapidement connu un vif succès. Cependant, nous avons réalisé que WhatsApp avait ses limites. C'est ainsi qu'est née cette plateforme, en tant que complément à notre groupe WhatsApp, offrant une meilleure organisation et une <span class="font-bold text-emerald-600">meilleure visibilité pour tous les événements.</span></p>
                </div>
                <img src="{{asset('img/1.jpg')}}" alt="image-1" class="mt-10 aspect-[6/5] w-full max-w-lg rounded-2xl object-cover sm:mt-16 lg:mt-0 lg:max-w-none xl:row-span-2 xl:row-end-2 xl:mt-36">
              </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 -z-10 h-24 bg-gradient-to-t from-white sm:h-32"></div>
          </div>
      
          <!-- Timeline section -->
          <div class="mx-auto -mt-8 max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-8 overflow-hidden lg:mx-0 lg:max-w-none lg:grid-cols-4">
              <div>
                <time datetime="2021-08" class="flex items-center text-xl font-bold leading-6 text-emerald-600">
                  <svg viewBox="0 0 4 4" class="mr-4 h-1 w-1 flex-none" aria-hidden="true">
                    <circle cx="2" cy="2" r="2" fill="currentColor" />
                  </svg>
                  Events
                  <div class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0" aria-hidden="true"></div>
                </time>
                <p class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Profitez des meilleures expériences.</p>
                <p class="mt-1 text-base leading-7 text-gray-600">Que vous soyez seul, entre amis ou en famille, Event31 vous offre un accès privilégié à une diversité d'événements : spectacles, concerts, conférences, forums, marchés, activités en plein air, et bien plus encore. Restez informés pour ne rien manquer !.</p>
              </div>
              <div>
                <time datetime="2021-12" class="flex items-center text-xl font-bold leading-6 text-emerald-600">
                  <svg viewBox="0 0 4 4" class="mr-4 h-1 w-1 flex-none" aria-hidden="true">
                    <circle cx="2" cy="2" r="2" fill="currentColor" />
                  </svg>
                  Familles & loisirs
                  <div class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0" aria-hidden="true"></div>
                </time>
                <p class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Les meilleurs moments d’une vie.</p>
                <p class="mt-1 text-base leading-7 text-gray-600">Pour une vie de famille épanouie et stimulante, il est essentiel d'explorer de nouvelles activités et expériences avec vos enfants. Chercher et découvrir de nouvelles idées peut être laborieux et demande de la patience. Laissez-vous inspirer par Event31 et concentrez-vous sur la création de souvenirs inoubliables.</p>
              </div>
              <div>
                <time datetime="2022-02" class="flex items-center text-xl font-bold leading-6 text-emerald-600">
                  <svg viewBox="0 0 4 4" class="mr-4 h-1 w-1 flex-none" aria-hidden="true">
                    <circle cx="2" cy="2" r="2" fill="currentColor" />
                  </svg>
                  Kids
                  <div class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0" aria-hidden="true"></div>
                </time>
                <p class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Elargissez votre palette d’activités.</p>
                <p class="mt-1 text-base leading-7 text-gray-600">Pour garantir l'épanouissement des enfants, il existe une variété d'activités pour stimuler leur développement et leur bien-être. Event31 vous aidera explorez les choix qui s’offrent à votre famille. Il ne reste plus qu’à proposer et vous laisser surprendre par les choix de vos enfants.</p>
              </div>
              <div>
                <time datetime="2022-12" class="flex items-center text-xl font-bold leading-6 text-emerald-600">
                  <svg viewBox="0 0 4 4" class="mr-4 h-1 w-1 flex-none" aria-hidden="true">
                    <circle cx="2" cy="2" r="2" fill="currentColor" />
                  </svg>
                  Voyages
                  <div class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0" aria-hidden="true"></div>
                </time>
                <p class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Parcourez le royaume.</p>
                <p class="mt-1 text-base leading-7 text-gray-600">En solo, en famille, en quête de luxe, d'aventure, de détente ou en mode fan club, les partenaires d'Event31 proposent des escapades riches en expériences et à des tarifs compétitifs, permettant à chacun de trouver son voyage idéal.</p>
              </div>
              <div>
                <time datetime="2022-12" class="flex items-center text-xl font-bold leading-6 text-emerald-600">
                  <svg viewBox="0 0 4 4" class="mr-4 h-1 w-1 flex-none" aria-hidden="true">
                    <circle cx="2" cy="2" r="2" fill="currentColor" />
                  </svg>
                  Formations
                  <div class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0" aria-hidden="true"></div>
                </time>
                <p class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Explorez et saisissez la meilleure opportunité</p>
                <p class="mt-1 text-base leading-7 text-gray-600">L'évolution permanente de nos connaissances et compétences nous donne de nouvelles perspectives, élargit notre compréhension du monde et renforce notre résilience face aux défis de la vie. Event31 peut contribuer à ce changement en vous offrant un large choix de formations, ateliers et séminaires dans divers thèmes.</p>
              </div>
              <div>
                <time datetime="2022-12" class="flex items-center text-xl font-bold leading-6 text-emerald-600">
                  <svg viewBox="0 0 4 4" class="mr-4 h-1 w-1 flex-none" aria-hidden="true">
                    <circle cx="2" cy="2" r="2" fill="currentColor" />
                  </svg>
                  Bon plans
                  <div class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0" aria-hidden="true"></div>
                </time>
                <p class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Faites-vous plaisir à petits prix</p>
                <p class="mt-1 text-base leading-7 text-gray-600">Les bons plans express vous permettront de programmer le jour même une sortie au restaurant, un moment de soins et de bien-être, et plein d’autres activités, à des prix avantageux.</p>
              </div>
            </div>
          </div>
      
      
          <!-- Content section -->
          <div class="mt-32 overflow-hidden sm:mt-40">
            <div class="mx-auto max-w-7xl px-6 lg:flex lg:px-8">
              <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-12 gap-y-16 lg:mx-0 lg:min-w-full lg:max-w-none lg:flex-none lg:gap-y-8">
                <div class="lg:col-end-1 lg:w-full lg:max-w-lg lg:pb-8">
                  <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">A qui s'adresse Event31 ?</h2>
                  <p class="mt-6 text-xl leading-8 text-gray-600">Event31 s’adresse à tous les âges et nationalités, que vous soyez déjà au Maroc ou en projet de séjour. Que vous cherchiez des évènements culturels, professionnels ou de loisirs dans les différentes régions du royaume, Event31 est là pour vous.</p>
                </div>
                <div class="flex flex-wrap items-start justify-end gap-6 sm:gap-8 lg:contents">
                  <div class="w-0 flex-auto lg:ml-auto lg:w-auto lg:flex-none lg:self-end">
                    <img src="{{asset('img/2.jpg')}}" alt="image-2" class="aspect-[7/5] w-[37rem] max-w-none rounded-2xl bg-gray-50 object-cover">
                  </div>
                  <div class="contents lg:col-span-2 lg:col-end-2 lg:ml-auto lg:flex lg:w-[37rem] lg:items-start lg:justify-end lg:gap-x-8">
                    <div class="order-first flex w-64 flex-none justify-end self-end lg:w-auto">
                      <img src="{{asset('img/3.jpg')}}" alt="image-3" class="aspect-[4/3] w-[24rem] max-w-none flex-none rounded-2xl bg-gray-50 object-cover">
                    </div>
                    <div class="flex w-96 flex-auto justify-end lg:w-auto lg:flex-none">
                      <img src="{{asset('img/4.jpg')}}" alt="image-4" class="aspect-[7/5] w-[37rem] max-w-none flex-none rounded-2xl bg-gray-50 object-cover">
                    </div>
                    <div class="hidden sm:block sm:w-0 sm:flex-auto lg:w-auto lg:flex-none">
                      <img src="{{asset('img/5.jpg')}}" alt="image-5" class="aspect-[4/3] w-[24rem] max-w-none rounded-2xl bg-gray-50 object-cover">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      
          <!-- Stats -->
          <div class="mx-auto mt-32 max-w-7xl px-6 sm:mt-40 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
              <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Notre objectif</h3>
              <p class="mt-6 text-base leading-7 text-gray-600"><span class="font-bold text-gray-700">On fait quoi aujourd’hui ?</span><br/>
                <span class="mt-3">Nous offrons une plateforme aux organisateurs d'événements pour promouvoir leurs activités, et facilitons ainsi la découverte d’événements, d’activités, de formations, etc.</span>
                </p>
            </div>
          </div>      
    
              <div class="mx-auto mt-10 max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                <p class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Pourquoi assister à des événements quand on pourrait rester confortablement chez soi ? </p>  
                  <ul> 
                  <li class="mt-6 text-lg leading-8 flex text-gray-600">•	Rencontrer de nouvelles personnes et développer son réseau professionnel ou social.</li>
                  <li class="mt-3 text-lg leading-8 flex text-gray-600">•	Acquérir de nouvelles connaissances grâce à des conférences, des ateliers ou des expositions.</li>
                  <li class="mt-3 text-lg leading-8 flex text-gray-600">•	Se divertir et se détendre en assistant à des concerts, des festivals ou des événements sportifs.</li>
                  <li class="mt-3 mb-6 text-lg leading-8 flex text-gray-600">•	Renforcer son sentiment d'appartenance à une communauté en prenant part à des événements qui nous passionnent.</li>
                </ul>
                </div>
              </div>
    
        </main>
      
        <!-- Footer -->
      </div>
      <footer class="bg-white border">
        <div class="mx-auto max-w-7xl overflow-hidden px-6 py-6 sm:py-8 lg:px-8">
          <nav class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12" aria-label="Footer">
            <div class="pb-6">
              <a href="{{ route('index') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Accueil</a>
            </div>
            <div class="pb-6">
              <a href="{{ route('apropos') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">A propos</a>
            </div>
            <div class="pb-6">
              <a href="{{ route('contact') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Contact</a>
            </div>
            <div class="pb-6">
              <a href="{{ route('blogs.index') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blog</a>
            </div>
            <div class="pb-6">
              <a href="{{ route('conditions') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Conditions</a>
            </div>
            <div class="pb-6">
              <a href="{{ route('politique') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Politique</a>
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
              <span class="sr-only">YouTube</span>
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
          <p class="mt-10 text-center text-xs leading-5 text-gray-500"><span class="text-emerald-500">&copy; 2024 Event31,</span> <span class="text-gray-500">Conception et design : <a href="https://edersys.ma/" target="_blank">E-dersys SARL</a></span></p>
        </div>
      </footer>  
      </div>



</div>        <button id="backToTopBtn" class="hidden fixed bottom-5 right-5 z-50 rounded-full bg-emerald-600 p-3 text-white shadow hover:bg-emerald-700 transition duration-300 ease-in-out">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5V6m0 0L5.25 12.75M12 6l6.75 6.75" />
      </svg>
    </button>
    <livewire:scripts/>    <button id="backToTopBtn" class="hidden fixed bottom-5 right-5 z-50 rounded-full bg-emerald-600 p-3 text-white shadow hover:bg-emerald-700 transition duration-300 ease-in-out">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5V6m0 0L5.25 12.75M12 6l6.75 6.75" />
      </svg>
    </button>
    <livewire:scripts/>
  </body>
  
</html>



