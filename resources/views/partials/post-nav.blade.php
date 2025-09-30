<nav class="bg-white flex w-full mx-auto items-center py-2">
        
    {{-- Button burger pour ouvrir le menu sur le mobile --}}
    <div class="w-4/12">
      <button @click="menuOpen = true" type="button" class="text-gray-700 w-1/6 md:hidden px-1">
        <span class="sr-only">Open sidebar</span>
        <img x-show="!menuOpen" src="{{asset('svg/menu/burger.svg')}}" alt="Logo" class="h-12">
      </button>
    </div>

    <!-- Logo au centre -->
    <a class="w-4/12 flex items-center justify-center ">
      <img src="{{asset('img/logo-green-black.png')}}" alt="Logo" class="h-8 md:h-10">
      <p href="#"  class="text-gray-900 font-bold text-3xl ">Event</p>
      <p href="#"  class="text-emerald-400 font-bold text-3xl ">31</p>
    </a>

    <!-- inscription et connexion  -->
    <div class="flex justify-end w-4/12 mr-2">
    </div>

</nav>

