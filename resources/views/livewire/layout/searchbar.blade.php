<div x-data="{ showSidebar: false }" class="flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:border-none">
    <button type="button" class="border-r border-gray-200 px-4 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden" @click="showSidebar = !showSidebar">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
        </svg>
    </button>

    <!-- Sidebar goes here, conditionally visible with Alpine.js -->
    <div x-show="showSidebar" class="lg:hidden">
        <!-- Sidebar content... -->
    </div> 
    
    <!-- Rest of the content continues... -->
    <div class="flex flex-1 justify-between px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
        <div class="flex flex-1">
            <form class="flex w-full md:ml-0" action="#" method="GET">
                <label for="search-field" class="sr-only">Search</label>
                <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="search-field" name="search-field" class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm" placeholder="Search transactions" type="search">
                </div>
            </form>
        </div>
        
        <!-- Additional content... -->
        <div class="ml-4 flex items-center md:ml-6">
            <button type="button" class="relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">View notifications</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </button>

            <!-- Profile dropdown with Alpine.js -->
            <div x-data="{ showDropdown: false }" class="relative ml-3">
                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 lg:rounded-md lg:p-2 lg:hover:bg-gray-50" id="user-menu-button" aria-expanded="false" aria-haspopup="true" @click="showDropdown = !showDropdown">
                    <span class="absolute -inset-1.5 lg:hidden"></span>
                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    <span class="ml-3 hidden text-sm font-medium text-gray-700 lg:block"><span class="sr-only">Open user menu for </span>Emilia Birch</span>
                    <svg class="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01-1.08" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div x-show="showDropdown" @click.away="showDropdown = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>