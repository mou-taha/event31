<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <livewire:styles />


        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data="{ open: false, activeTab: 'null' }">
    <div class="bg-white">
        <!-- Mobile menu -->
        <div  class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
            <!-- Off-canvas menu backdrop -->
            <div x-show="open" class="fixed inset-0 bg-black bg-opacity-25 transition-opacity ease-linear duration-300"></div>
            <div x-show="open" class="fixed inset-0 z-40 flex">
                <!-- Off-canvas menu -->
                <div x-show="open" class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl transition ease-in-out duration-300 transform">
                    <div class="flex px-4 pb-2 pt-5">
                        <button type="button" class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400" @click="open = false">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Links -->
                    <div class="mt-2">
                        <div class="border-b border-gray-200">
                            <div class="-mb-px flex space-x-8 px-4" aria-orientation="horizontal" role="tablist">
                                <button

                                @click="activeTab = 'women'" :class="{'border-indigo-600 text-indigo-600': activeTab === 'women', 'border-transparent text-gray-900': activeTab !== 'women'}" class="flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium">Women</button>
                                <button

                                @click="activeTab = 'men'" :class="{'border-indigo-600 text-indigo-600': activeTab === 'men', 'border-transparent text-gray-900': activeTab !== 'men'}" class="flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium">Men</button>
                            </div>
                        </div>
                        <!-- 'Women' tab panel -->
                        <div x-show="activeTab === 'women'" class="space-y-10 px-4 pb-8 pt-10" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <div class="grid grid-cols-2 gap-x-4">
                                <div class="group relative text-sm">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                        <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg"  class="object-cover object-center">
                                    </div>
                                    <a href="#" class="mt-6 block font-medium text-gray-900">
                                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                        New Arrivals
                                    </a>
                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                </div>
                                <div class="group relative text-sm">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                        <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg" alt="Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees." class="object-cover object-center">
                                    </div>
                                    <a href="#" class="mt-6 block font-medium text-gray-900">
                                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                        Basic Tees
                                    </a>
                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                </div>
                            </div>
                            <div>
                                <p id="women-clothing-heading-mobile" class="font-medium text-gray-900">Clothing</p>
                                <ul role="list" aria-labelledby="women-clothing-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Tops</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Dresses</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Pants</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Denim</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Sweaters</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">T-Shirts</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Jackets</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Activewear</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Browse All</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <p id="women-accessories-heading-mobile" class="font-medium text-gray-900">Accessories</p>
                                <ul role="list" aria-labelledby="women-accessories-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Watches</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Wallets</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Bags</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Sunglasses</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Hats</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Belts</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <p id="women-brands-heading-mobile" class="font-medium text-gray-900">Brands</p>
                                <ul role="list" aria-labelledby="women-brands-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Full Nelson</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">My Way</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Re-Arranged</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Counterfeit</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Significant Other</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- 'Men' tab panel -->
                        <div x-show="activeTab === 'men'" class="space-y-10 px-4 pb-8 pt-10" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <div class="grid grid-cols-2 gap-x-4">
                                <div class="group relative text-sm">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                        <img src="https://tailwindui.com/img/ecommerce-images/product-page-04-detail-product-shot-01.jpg" class="object-cover object-center">
                                    </div>
                                    <a href="#" class="mt-6 block font-medium text-gray-900">
                                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                        New Arrivals
                                    </a>
                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                </div>
                                <div class="group relative text-sm">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                        <img src="https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-06.jpg" alt="Three shirts in gray, white, and blue arranged on table with same line drawing of hands and shapes overlapping on front of shirt." class="object-cover object-center">
                                    </div>
                                    <a href="#" class="mt-6 block font-medium text-gray-900">
                                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                        Artwork Tees
                                    </a>
                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                </div>
                            </div>
                            <div>
                                <p id="men-clothing-heading-mobile" class="font-medium text-gray-900">Clothing</p>
                                <ul role="list" aria-labelledby="men-clothing-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Tops</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Pants</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Sweaters</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">T-Shirts</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Jackets</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Activewear</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Browse All</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <p id="men-accessories-heading-mobile" class="font-medium text-gray-900">Accessories</p>
                                <ul role="list" aria-labelledby="men-accessories-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Watches</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Wallets</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Bags</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Sunglasses</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Hats</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Belts</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <p id="men-brands-heading-mobile" class="font-medium text-gray-900">Brands</p>
                                <ul role="list" aria-labelledby="men-brands-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Re-Arranged</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Counterfeit</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">Full Nelson</a>
                                    </li>
                                    <li class="flow-root">
                                        <a href="#" class="-m-2 block p-2 text-gray-500">My Way</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                        <div class="flow-root">
                            <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Company</a>
                        </div>
                        <div class="flow-root">
                            <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Stores</a>
                        </div>
                    </div>
                    <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                        <div class="flow-root">
                            <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Create an account</a>
                        </div>
                        <div class="flow-root">
                            <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Sign in</a>
                        </div>
                    </div>
                    <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                        <!-- Currency selector IN MOBILE -->
                        <form>
                            <div class="inline-block">
                                <label for="mobile-currency" class="sr-only">Currency</label>
                                <div class="group relative -ml-2 rounded-md border-transparent focus-within:ring-2 focus-within:ring-white">
                                    <select id="mobile-currency" name="currency" class="flex items-center rounded-md border-transparent bg-none py-0.5 pl-2 pr-5 text-sm font-medium text-gray-700 focus:border-transparent focus:outline-none focus:ring-0 group-hover:text-gray-800">
                                        <option>CAD</option>
                                        <option>USD</option>
                                        <option>AUD</option>
                                        <option>EUR</option>
                                        <option>GBP</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center">
                                        <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <header class="relative bg-white">
            <nav aria-label="Top">
                <!-- Top navigation -->
                <div class="bg-gray-900">
                    <div class="mx-auto flex h-10 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                        <!-- Currency selector -->
                        <form class="hidden lg:block lg:flex-1">
                            <div class="flex">
                                <label for="desktop-currency" class="sr-only">Currency</label>
                                <div class="group relative -ml-2 rounded-md border-transparent bg-gray-900 focus-within:ring-2 focus-within:ring-white">
                                    <select id="desktop-currency" name="currency" class="flex items-center rounded-md border-transparent bg-gray-900 bg-none py-0.5 pl-2 pr-5 text-sm font-medium text-white focus:border-transparent focus:outline-none focus:ring-0 group-hover:text-gray-100">
                                        <option>CAD</option>
                                        <option>USD</option>
                                        <option>AUD</option>
                                        <option>EUR</option>
                                        <option>GBP</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center">
                                        <svg class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <p class="flex-1 text-center text-sm font-medium text-white lg:flex-none">Get free delivery on orders over $100</p>

                        <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                            <a href="#" class="text-sm font-medium text-white hover:text-gray-100">Create an account</a>
                            <span class="h-6 w-px bg-gray-600" aria-hidden="true"></span>
                            <a href="#" class="text-sm font-medium text-white hover:text-gray-100">Sign in</a>
                        </div>
                    </div>
                </div>

                <!-- Secondary navigation -->
                <div class="bg-white">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="border-b border-gray-200">
                            <div class="flex h-16 items-center justify-between">
                                <!-- Logo (lg+) -->
                                <div class="hidden lg:flex lg:items-center">
                                    <a href="#">
                                        <span class="sr-only">Your Company</span>
                                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
                                    </a>
                                </div>

                                <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                                    <div class="flex h-full space-x-8">
                                        <div class="flex">
                                            <div class="relative flex">
                                                <button
                                                @click="activeTab = 'women'"
                                                type="button" class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out" 
                                                :class="{'border-indigo-600 text-indigo-600': activeTab === 'women', 'border-transparent text-gray-900': activeTab !== 'women'}"
                                                aria-expanded="false">Women</button>
                                            </div>
                                            <div  x-show="activeTab === 'women'" class="absolute inset-x-0 top-full text-sm text-gray-500">
                                                <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>
                                                <div class="relative bg-white">
                                                    <div class="mx-auto max-w-7xl px-8">
                                                        <div class="grid grid-cols-2 gap-x-8 gap-y-10 py-16">
                                                            <div class="col-start-2 grid grid-cols-2 gap-x-8">
                                                                <div class="group relative text-base sm:text-sm">
                                                                    <div class="aspect-square overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                                                        <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg" alt="Models sitting back to back, wearing Basic Tee in black and bone." class="object-cover object-center">
                                                                    </div>
                                                                    <a href="#" class="mt-6 block font-medium text-gray-900">
                                                                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                                                        New Arrivals
                                                                    </a>
                                                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                                                </div>
                                                                <div class="group relative text-base sm:text-sm">
                                                                    <div class="aspect-square overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                                                        <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg" alt="Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees." class="object-cover object-center">
                                                                    </div>
                                                                    <a href="#" class="mt-6 block font-medium text-gray-900">
                                                                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                                                        Basic Tees
                                                                    </a>
                                                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                                                </div>
                                                            </div>
                                                            <div class="row-start-1 grid grid-cols-3 gap-x-8 gap-y-10 text-sm">
                                                                <div>
                                                                    <p id="Clothing-heading" class="font-medium text-gray-900">Clothing</p>
                                                                    <ul role="list" aria-labelledby="Clothing-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Tops</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Dresses</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Pants</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Denim</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Sweaters</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">T-Shirts</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Jackets</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Activewear</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Browse All</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div>
                                                                    <p id="Accessories-heading" class="font-medium text-gray-900">Accessories</p>
                                                                    <ul role="list" aria-labelledby="Accessories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Watches</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Wallets</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Bags</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Sunglasses</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Hats</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Belts</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div>
                                                                    <p id="Brands-heading" class="font-medium text-gray-900">Brands</p>
                                                                    <ul role="list" aria-labelledby="Brands-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Full Nelson</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">My Way</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Re-Arranged</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Counterfeit</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Significant Other</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <div class="relative flex">
                                                <button

                                                @click="activeTab = 'men'"
                                                type="button" class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                                :class="{'border-indigo-600 text-indigo-600': activeTab === 'men', 'border-transparent text-gray-900': activeTab !== 'men'}"
                                                aria-expanded="false">Men</button>
                                            </div>
                                            <div  x-show="activeTab === 'men'" class="absolute inset-x-0 top-full text-sm text-gray-500">
                                                <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>
                                                <div class="relative bg-white">
                                                    <div class="mx-auto max-w-7xl px-8">
                                                        <div class="grid grid-cols-2 gap-x-8 gap-y-10 py-16">
                                                            <div class="col-start-2 grid grid-cols-2 gap-x-8">
                                                                <div class="group relative text-base sm:text-sm">
                                                                    <div class="aspect-square overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                                                        <img src="https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-05.jpg"  class="object-cover object-center">
                                                                    </div>
                                                                    <a href="#" class="mt-6 block font-medium text-gray-900">
                                                                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                                                        New Arrivals
                                                                    </a>
                                                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                                                </div>
                                                                <div class="group relative text-base sm:text-sm">
                                                                    <div class="aspect-square overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                                                        <img src="https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-06.jpg" class="object-cover object-center">
                                                                    </div>
                                                                    <a href="#" class="mt-6 block font-medium text-gray-900">
                                                                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                                                        Artwork Tees
                                                                    </a>
                                                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                                                </div>
                                                            </div>
                                                            <div class="row-start-1 grid grid-cols-3 gap-x-8 gap-y-10 text-sm">
                                                                <div>
                                                                    <p id="Clothing-heading" class="font-medium text-gray-900">Clothing</p>
                                                                    <ul role="list" aria-labelledby="Clothing-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Tops</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Pants</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Sweaters</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">T-Shirts</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Jackets</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Activewear</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Browse All</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div>
                                                                    <p id="Accessories-heading" class="font-medium text-gray-900">Accessories</p>
                                                                    <ul role="list" aria-labelledby="Accessories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Watches</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Wallets</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Bags</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Sunglasses</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Hats</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Belts</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div>
                                                                    <p id="Brands-heading" class="font-medium text-gray-900">Brands</p>
                                                                    <ul role="list" aria-labelledby="Brands-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Re-Arranged</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Counterfeit</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">Full Nelson</a>
                                                                        </li>
                                                                        <li class="flex">
                                                                            <a href="#" class="hover:text-gray-800">My Way</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Company</a>
                                        <a href="#" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Stores</a>
                                    </div>
                                </div>
                                <!-- Mobile menu and search (lg-) -->
                                <div class="flex flex-1 items-center lg:hidden">
                                    <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                                    <button type="button" class="-ml-2 rounded-md bg-white p-2 text-gray-400" @click="open = true">
                                        <span class="sr-only">Open menu</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                        </svg>
                                    </button>
                                    <!-- Search -->
                                    <a href="#" class="ml-2 p-2 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Search</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg>
                                    </a>
                                </div>
                                <!-- Logo (lg-) -->
                                <a href="#" class="lg:hidden">
                                    <span class="sr-only">Your Company</span>
                                    <img src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" class="h-8 w-auto">
                                </a>
                                <div class="flex flex-1 items-center justify-end">
                                    <div class="flex items-center lg:ml-8">
                                        <div class="flex space-x-8">
                                            <div class="hidden lg:flex">
                                                <a href="#" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                                    <span class="sr-only">Search</span>
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <a href="#" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                                    <span class="sr-only">Account</span>
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <span class="mx-4 h-6 w-px bg-gray-200 lg:mx-6" aria-hidden="true"></span>
                                        <div class="flow-root">
                                            <a href="#" class="group -m-2 flex items-center p-2">
                                                <svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                </svg>
                                                <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                                                <span class="sr-only">items in cart, view bag</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>
    <div class="bg-red-500 h-8 fixed lg:hidden bottom-0 w-full flex items-center justify-center">
     <button class="flex  text-center text-gray-900 text-lg">
      filter
     </button>
    </div>
    <livewire:scripts />

    </body>
</html>