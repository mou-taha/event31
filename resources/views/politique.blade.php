
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



      <div class="mt-36 lg:mt-32">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 ">
          <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
              <div class="divide-y divide-gray-200 lg:col-span-9">
                <!-- Profile section -->
                <div class="px-4 py-1 sm:p-4">
                        <h1 class="text-2xl font-bold mb-4">Politique de confidentialité</h1>
                        <p class="mb-4">La présente politique de confidentialité décrit comment Event31 recueille, utilise et protège les informations que vous fournissez lorsque vous utilisez notre site web <a href="https://event31.com" class="text-emerald-600">https://event31.com</a>. Nous nous engageons à protéger votre vie privée. Si vous avez des questions concernant notre politique de confidentialité, veuillez nous contacter à <a href="mailto:contact@event31.com" class="text-emerald-600">contact@event31.com</a>.</p>
                        
                        <h2 class="text-xl font-semibold mb-2">1. Collecte des informations</h2>
                        <p class="mb-4">Nous recueillons les informations suivantes lorsque vous utilisez notre Site :</p>
                        
                        <h3 class="text-lg font-semibold mb-2">1.1 Informations personnelles</h3>
                        <p class="mb-4">Lorsque vous vous inscrivez à notre newsletter, remplissez un formulaire de contact ou demandez des informations sur nos événements, nous pouvons recueillir des informations telles que votre nom, votre adresse e-mail, votre numéro de téléphone, vos préférences en matière d'événements, etc.</p>
                        
                        <h3 class="text-lg font-semibold mb-2">1.2 Informations de navigation</h3>
                        <p class="mb-4">Nous recueillons des informations sur votre utilisation du Site, telles que les pages que vous visitez, les événements que vous consultez, votre adresse IP, votre type de navigateur, votre fournisseur d'accès à Internet, etc.</p>
                        
                        <h2 class="text-xl font-semibold mb-2">2. Utilisation des informations</h2>
                        <p class="mb-4">Nous utilisons les informations que nous recueillons pour les finalités suivantes :</p>
                        
                        <h3 class="text-lg font-semibold mb-2">2.1 Fourniture de services</h3>
                        <p class="mb-4">Pour vous fournir des informations sur nos événements, répondre à vos demandes de renseignements et vous aider dans votre recherche d'événements.</p>
                        
                        <h3 class="text-lg font-semibold mb-2">2.2 Amélioration du service</h3>
                        <p class="mb-4">Pour améliorer notre Site et nos services, analyser les tendances d'utilisation, comprendre les préférences de nos utilisateurs et personnaliser leur expérience.</p>
                        
                        <h3 class="text-lg font-semibold mb-2">2.3 Communication marketing</h3>
                        <p class="mb-4">Pour vous contacter concernant des offres spéciales, des promotions, des événements ou d'autres informations que nous pensons pouvoir vous intéresser, sous réserve de votre consentement lorsque cela est requis par la loi.</p>
                        
                        <h2 class="text-xl font-semibold mb-2">3. Protection des informations</h2>
                        <p class="mb-4">Nous nous engageons à protéger vos informations personnelles et à les garder en sécurité. Nous mettons en place des mesures de sécurité appropriées pour protéger vos informations contre tout accès non autorisé, utilisation abusive, divulgation ou altération.</p>
                        
                        <h2 class="text-xl font-semibold mb-2">4. Partage des informations</h2>
                        <p class="mb-4">Nous ne vendrons, ne louerons ni ne partagerons vos informations personnelles avec des tiers sans votre consentement, sauf dans les cas suivants :</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Lorsque cela est nécessaire pour fournir nos services, comme dans le cas des rappels des organisateurs d'événements pour vous aider à trouver un événement.</li>
                            <li>Lorsque cela est requis par la loi ou pour se conformer à une obligation légale.</li>
                        </ul>
                        
                        <h2 class="text-xl font-semibold mb-2">5. Vos droits</h2>
                        <p class="mb-4">Vous avez le droit de demander l'accès, la rectification, la suppression ou la limitation du traitement de vos informations personnelles. Vous pouvez également vous opposer au traitement de vos informations personnelles ou retirer votre consentement à tout moment lorsque cela est applicable par la loi. Pour exercer vos droits, veuillez nous contacter à <a href="mailto:contact@event31.com" class="text-emerald-600">contact@event31.com</a>.</p>
                        
                        <h2 class="text-xl font-semibold mb-2">6. Consentement</h2>
                        <p class="mb-4">En utilisant notre Site, vous consentez à notre politique de confidentialité et à nos conditions d'utilisation.</p>
                        
                        <h2 class="text-xl font-semibold mb-2">7. Mises à jour de la politique de confidentialité</h2>
                        <p class="mb-4">Nous pouvons mettre à jour notre politique de confidentialité de temps à autre pour refléter les changements dans nos pratiques en matière de confidentialité. Nous vous recommandons de consulter régulièrement cette page pour vous tenir informé des modifications. Les modifications entreront en vigueur dès leur publication sur le Site.</p>
                        
                        <h2 class="text-xl font-semibold mb-2">8. Contactez-nous</h2>
                        <p class="mb-4">Si vous avez des questions ou des préoccupations concernant notre politique de confidentialité, veuillez nous contacter à <a href="mailto:contact@event31.com" class="text-emerald-600">contact@event31.com</a>.</p>
                        
                        <p class="text-sm text-gray-600">Dernière mise à jour : 05/06/2024</p>
  
                </div>
              </div>          
            </div>
          </div>
        </div>
      </div>
      <footer class="bg-white border mt-8">
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
    <button id="backToTopBtn" class="hidden fixed bottom-5 right-5 z-50 rounded-full bg-emerald-600 p-3 text-white shadow hover:bg-emerald-700 transition duration-300 ease-in-out">
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



