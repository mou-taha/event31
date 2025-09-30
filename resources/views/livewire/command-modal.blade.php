<div x-data="{ open: false, search: '', items: [], filteredItems: [] }" @keydown.window.ctrl.q.prevent="open = !open; filterItems()" x-show="open" x-cloak class="relative z-10" role="dialog" aria-modal="true" @click.outside="open = false" x-init="filteredItems = items = [
        { name: 'Liste des publications', route: '{{ route('events') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 text-opacity-40 group-hover:text-white', iconPath: 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z' },
        { name: 'Nouvelle publication', route: '{{ route('inputevent') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z' },
        @can('Lire Menu')                
        { name: 'Menus', route: '{{ route('menus') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5' },
        @endcan
        @can('Lire Type')                
        { name: 'Types', route: '{{ route('types') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5' },
        @endcan
        @can('Lire Soustype')                
        { name: 'Sous-types', route: '{{ route('subtypes') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M3.75 9h16.5m-16.5 6.75h16.5' },
        @endcan
        @can('Lire Ville')         
        { name: 'Villes', route: '{{ route('cities') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819' },
        @endcan
        @can('Lire Organisme')  
        { name: 'Organismes', route: '{{ route('organisms') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21' },
        @endcan
        @can('Lire Access') 
        { name: 'Accés', route: '{{ route('prices') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z' },
        @endcan
        @can('Lire Blog') 
        { name: 'Liste des blogs', route: '{{ route('blogs') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z' },
        @endcan
        @canany(['Créer Blog', 'Modifier Blog'])
        { name: 'Nouveau blog', route: '{{ route('inputblog') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z' },
        @endcan
        @can('Lire Categorie') 
        { name: 'Categories', route: '{{ route('categories') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75' },
        @endcan
        @can('Lire Tag') 
        { name: 'Tags', route: '{{ route('tags') }}', iconClasses: 'h-6 w-6 flex-none text-gray-900 group-hover:text-white text-opacity-40', iconPath: 'M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5' }
        @endcan
    ];">
  <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity"></div>
  
  <div class="fixed inset-0 z-10 w-screen overflow-y-auto justify-center p-4 sm:p-6 md:p-2">
    <div x-show="open" class="mx-auto max-w-2xl transform divide-y divide-gray-500 divide-opacity-10 overflow-hidden rounded-xl bg-white bg-opacity-80 shadow-2xl ring-1 ring-black ring-opacity-5 backdrop-blur backdrop-filter transition-all">
      <div class="relative">
        <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-900 text-opacity-40" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
        </svg>
        <input type="text" x-model="search" @input="filterItems" class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 focus:ring-0 sm:text-sm" placeholder="Search">
      </div>

      <ul class="divide-y divide-gray-500 divide-opacity-10 overflow-y-auto">
        <li class="p-2" x-show="filteredItems.length > 0">
          <h2 class="mb-2 mt-2 px-3 text-md font-semibold text-gray-900">Raccourcis</h2>
          <ul class="text-sm text-gray-700">
            <template x-for="item in filteredItems" :key="item.name">
              <li class="">
                <a :href="item.route"  class="group flex cursor-default select-none items-center rounded-md px-3 py-2 hover:text-white hover:bg-emerald-500">
                  <svg :class="item.iconClasses" class="h-6 w-6 flex-none text-gray-900 text-opacity-40 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path :d="item.iconPath" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <span class="ml-3 flex-auto truncate" x-text="item.name"></span>
                  <span class="ml-3 hidden group-hover:flex flex-none text-white">Sauter à</span>
                </a>
              </li>
            </template>
          </ul>
        </li>
      </ul>

      <div x-show="filteredItems.length === 0" class="px-6 py-14 text-center rounded-xl sm:px-14">
        <svg class="mx-auto h-6 w-6 text-gray-900 text-opacity-40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
        </svg>
        <p class="mt-4 text-sm text-gray-900">We couldn't find any projects with that term. Please try again.</p>
      </div>
    </div>
  </div>
</div>

<script>
  function filterItems() {
      this.filteredItems = this.items.filter(item => item.name.toLowerCase().includes(this.search.toLowerCase()));
  }
</script>
