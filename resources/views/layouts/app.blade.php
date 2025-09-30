<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <livewire:styles />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/css/tom-select.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .highlight {
            background-color: yellow;
        }
        .highlight-current {
            background-color: orange;
        }
        body {
            overflow-y: scroll;
        }
        .nav-arrows {
            display: flex;
            justify-content: end;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            z-index: 1000;
        }
        .nav-arrows a {
            background: #fff;
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .nav-arrows a:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }
    </style>
</head>
<body class="font-sans antialiased">
    @livewire('command-modal')

    <div class="min-h-screen bg-gray-100">
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <livewire:layout.navigation />

        <!-- Page Content -->
        <div class="flex flex-1 flex-col lg:pl-64">
            <div class="flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:border-none">
                <!--BURGGER -->
                <button @click="open = true" class="border-r border-gray-200 px-4 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                </button>
                <!-- Search bar -->
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
                                <input id="search-field" class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm" placeholder="Rechercher un mot" type="search" oninput="highlightText()">
                            </div>
                        </form>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        @livewire('event-notifications')
                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <div>
                                        <button type="button" class="relative flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 lg:rounded-md lg:p-2 lg:hover:bg-gray-50" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                            <span class="absolute -inset-1.5 lg:hidden"></span>
                                            <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->image ? auth()->user()->image : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541'  }}" alt="">
                                            <span class="text-md font-semibold text-gray-500 ml-2" x-data="{{ json_encode(['name' => auth()->user()->username]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></span>
                                            <svg class="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </x-slot>
                                <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                    <!-- Active: "bg-gray-100", Not Active: "" -->
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('index')" >
                                            {{ __('Website') }}
                                        </x-dropdown-link>
                                        <!-- Authentication -->
                                        <button wire:click="logout" class="w-full text-start">
                                            <x-dropdown-link>
                                                {{ __('Se déconnecter') }}
                                            </x-dropdown-link>
                                        </button>
                                    </x-slot>
                                </div>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </div>
            <main class="flex-1 pb-8">
                {{ $slot }}
            </main>
        </div>
    </div>


    <livewire:scripts/>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        let currentHighlight = -1;
        let highlights = [];

        Livewire.on('message.processed', () => {
            let select = document.getElementById('permissions');
            if (select) {
                if (select.tomselect) {
                    select.tomselect.destroy();
                }
                new TomSelect('#permissions', {
                    plugins: ['remove_button'],
                    maxItems: null,
                    valueField: 'id',
                    labelField: 'name',
                    searchField: 'name'
                });
            }
        });

        function highlightText() {
            // Get the search query
            let query = document.getElementById('search-field').value;

            // Remove previous highlights
            let highlightedElements = document.querySelectorAll('.highlight');
            highlightedElements.forEach(element => {
                let parent = element.parentNode;
                parent.replaceChild(document.createTextNode(element.textContent), element);
                parent.normalize();
            });

            highlights = [];
            currentHighlight = -1;

            if (query) {
                // Create a regular expression to search for the query, case insensitive
                let regex = new RegExp(`(${query})`, 'gi');

                // Find all text nodes in the document
                let walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);

                let node;
                while (node = walker.nextNode()) {
                    let parent = node.parentNode;
                    if (parent && parent.nodeName !== 'SCRIPT' && parent.nodeName !== 'STYLE' && parent.nodeName !== 'INPUT') {
                        // Get the node text content and apply the regex
                        let text = node.nodeValue;
                        if (regex.test(text)) {
                            let span = document.createElement('span');
                            span.innerHTML = text.replace(regex, '<span class="highlight">$1</span>');
                            parent.replaceChild(span, node);

                            span.querySelectorAll('.highlight').forEach(highlight => {
                                highlights.push(highlight);
                            });
                        }
                    }
                }

                // Display navigation arrows if there are multiple highlights
                if (highlights.length > 1) {
                    document.getElementById('nav-arrows').style.display = 'flex';
                } else {
                    document.getElementById('nav-arrows').style.display = 'none';
                }

                navigateHighlights(1); // Highlight the first match if any
            }
        }

        function navigateHighlights(direction) {
            if (highlights.length === 0) return;

            if (currentHighlight >= 0) {
                highlights[currentHighlight].classList.remove('highlight-current');
            }

            currentHighlight += direction;

            if (currentHighlight < 0) {
                currentHighlight = highlights.length - 1;
            } else if (currentHighlight >= highlights.length) {
                currentHighlight = 0;
            }

            highlights[currentHighlight].classList.add('highlight-current');
            highlights[currentHighlight].scrollIntoView({ behavior: 'smooth', block: 'center' });

            document.getElementById('prev-arrow').disabled = highlights.length <= 1;
            document.getElementById('next-arrow').disabled = highlights.length <= 1;
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
</body>
</html>