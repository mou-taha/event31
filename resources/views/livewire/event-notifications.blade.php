<div x-data="{ show: @entangle('show') }" @click.away="show = false" class="relative">
    <button type="button" class="relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2" @click="show = !show">
        <span class="absolute -inset-1.5"></span>
        <span class="sr-only">View notifications</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
        @if($unseenEventsCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $unseenEventsCount }}</span>
        @endif
    </button>

    <aside x-show="show" x-cloak class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center lg:fixed lg:bottom-0 lg:right-0 lg:top-16 lg:w-96 lg:overflow-hidden lg:border-l lg:border-white/5 lg:rounded-lg" @click.away="show = false" x-transition>
        <div class="relative bg-white rounded-lg overflow-hidden w-full h-full">
            <header class="flex items-center justify-between border-b border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8 bg-emerald-500 text-white">
                <h2 class="text-base font-semibold leading-7">Flux d'activité</h2>
                <button href="#" class="text-sm font-semibold leading-6 text-white" @click="show = !show">Fermer</button>
            </header>
            <ul role="list" class="divide-y divide-gray-200 overflow-y-auto h-96">
                @if(Auth::user()->can('Lire Utilisateur'))
                    @foreach($events as $event)
                        <li class="px-4 py-4 sm:px-6 lg:px-8 {{ $event->seen ? 'bg-white' : 'bg-gray-100' }}">
                            <div class="flex items-center gap-x-3">
                                <a  href="">
                                    <img src="{{ $event->user->image ? asset($event->user->image) : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}" alt="" class="h-10 w-10 flex-none rounded-full bg-gray-800">
                                </a>
                                <a  href="" @click.prevent.debounce.50ms="$wire.openSlideOver({{ $event->user->id }}); isOpen = true;">
                                    @if ($event->user->firstname)
                                    <h3 class="flex-auto truncate text-sm font-semibold leading-6">{{ $event->user->firstname }} {{ $event->user->lastname }}</h3>
                                    @else    
                                    <h3 class="flex-auto truncate text-sm font-semibold leading-6">{{ $event->user->username }}</h3>
                                    @endif
                                </a>
                                <time datetime="{{ $event->created_at }}" class="flex-none text-xs text-gray-600">{{ $event->created_at->diffForHumans() }}</time>
                            </div>
                            <a  href="{{ 'http://localhost:8000/inputevent/'.$event->id }}"><span class="mt-3 truncate text-sm font-semibold text-gray-900">New event : </span><span class="mt-3 truncate text-sm text-gray-700">{{ $event->title }}</span></a>
                        </li>
                    @endforeach
                @else
                    @foreach($events as $event)
                        <li class="px-4 py-4 sm:px-6 lg:px-8 {{ $event->seen ? 'bg-white' : 'bg-gray-100' }}">
                            <div class="flex items-center gap-x-3">
                                <h3 class="flex-auto truncate text-sm font-semibold leading-6">Event31 stuff</h3>
                                <time datetime="{{ $event->created_at }}" class="flex-none text-xs text-gray-600">{{ $event->created_at->diffForHumans() }}</time>
                            </div>
                            <span class="mt-3 truncate text-sm font-semibold text-gray-900">Votre publication a été approuvée par Event31 stuff.</span>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="flex justify-end p-4 bg-gray-50">
                <button class="px-4 py-2 bg-emerald-500 text-white rounded" wire:click="markAsSeen">Marquer tout comme vu</button>
            </div>
        </div>
    </aside>

    <div x-data="{ isOpen: @entangle('isOpen') }" class="relative z-40" role="dialog" aria-modal="true" x-show="isOpen" style="display: none;">
        <!-- Background backdrop -->
        <div class="fixed inset-0 transition-opacity duration-500" x-show="isOpen" @click="isOpen = false">
            <div class="absolute inset-0 bg-transparent bg-opacity-75 backdrop-blur-sm"></div>
        </div>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                    <div class="pointer-events-auto w-screen max-w-md" x-show="isOpen" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" @click.away="isOpen = false">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white">
                            <div class="px-4 py-6 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 id="slide-over-heading" class="text-base font-semibold leading-6 text-gray-900">Profile</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button @click="isOpen = false" type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @if($selectedUser)
                                <div class="pb-1 sm:pb-6">
                                    <div>
                                        <div class="relative h-40 sm:h-56">
                                            <img class="absolute h-full w-full object-cover" src="{{ $selectedUser->image ? $selectedUser->image : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}" alt="">
                                        </div>
                                        <div class="mt-6 px-4 sm:mt-8 sm:flex sm:items-end sm:px-6">
                                            <div class="sm:flex-1">
                                                <div>
                                                    <div class="flex items-center">
                                                        @if ($selectedUser->firstname)
                                                        <h3 class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $selectedUser->firstname }} {{ $selectedUser->lastname }}</h3>
                                                        @else
                                                        <h3 class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $selectedUser->username }}</h3>
                                                        @endif
                                                        <span class="ml-2.5 inline-block h-2 w-2 flex-shrink-0 rounded-full bg-green-400">
                                                            <span class="sr-only">Online</span>
                                                        </span>
                                                    </div>
                                                    <div class="flex">
                                                        <p class="text-sm text-gray-500">{{ '@' . $selectedUser->username }}</p>
                                                        <p class="text-sm ml-2 text-gray-500">{{ $selectedUser->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="mt-5 flex flex-wrap space-y-3 sm:space-x-3 sm:space-y-0">
                                                    <a  href="mailto:{{ $selectedUser->email }}" class="inline-flex w-full flex-shrink-0 items-center justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 sm:flex-1">Message</a>
                                                    <a  href="tel:{{ $selectedUser->phone }}" class="inline-flex w-full flex-1 items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Call</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-5 pt-5 sm:px-0 sm:pt-5">
                                        <dl class="space-y-8 px-4 sm:space-y-6 sm:px-6">
                                            @if ($selectedUser->birth)    
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Birthday</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                                    <time datetime="{{ $selectedUser->birth }}">
                                                        {{ \Carbon\Carbon::parse($selectedUser->birth)->format('F d, Y') }}
                                                    </time>                                                                
                                                </dd>
                                            </div>
                                            @endif
                                            @if ($selectedUser->address)    
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Location</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $selectedUser->address }}</dd>
                                            </div>
                                            @endif
                                            @if ($selectedUser->sex)    
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Sexe</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $selectedUser->sex }}</dd>
                                            </div>
                                            @endif
                                            @if ($selectedUser->bio)    
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Bio</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $selectedUser->bio }}</dd>
                                            </div>
                                            @endif
                                        </dl>
                                    </div>
                                </div>
                                @else
                                <div class="px-4 py-6 sm:px-6">
                                    <p class="text-sm text-gray-500">No user selected</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
