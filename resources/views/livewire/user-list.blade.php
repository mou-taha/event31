<div>
@can('Lire Utilisateur') 
    <!-- User List -->
    <ul role="list" class="grid grid-cols-1 sm:px-6 lg:px-8 px-4 mt-8 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($users as $user)
        <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
            <div x-data="{ isOpen: @entangle('isOpen') }" @click.away="isOpen = false">
                <a href="#" @click.prevent.debounce.50ms="$wire.openSlideOver({{ $user->id }}); isOpen = true; console.log('Clicked:', isOpen);">
                    <div class="flex w-full items-center justify-between space-x-6 p-6">
                        <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                                <h3 class="truncate text-sm font-medium text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</h3>
                                @if($user->roles->isNotEmpty())
                                <span class="inline-flex flex-shrink-0 items-center rounded-full bg-emerald-50 px-1.5 py-0.5 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                    {{ $user->roles->first()->name }}
                                </span>
                            @endif                     </div>
                            <p class="mt-1 truncate text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="{{ $user->image ? $user->image : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}" alt="">
                    </div>
                </a>
            </div>
            <div class="-mt-px flex divide-x divide-gray-200">
                <div class="flex w-0 flex-1">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $user->email }}" target="_blank" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                            <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                        </svg>
                        Email
                    </a>
                    
                </div>
                <div class="-ml-px flex w-0 flex-1">
                    @php
                    $phoneNumber = $user->phone;
                    if (substr($phoneNumber, 0, 1) === '0') {
                        $phoneNumber = '+212' . substr($phoneNumber, 1);
                    }
                @endphp
                
                <a href="tel:{{ $phoneNumber }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                    </svg>
                    Téléphone
                </a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>

    <!-- Slide-over panel -->
    <div x-data="{ isOpen: @entangle('isOpen') }" class="relative z-10" role="dialog" aria-modal="true" x-show="isOpen" style="display: none;">
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
                                    <h2 id="slide-over-heading" class="text-base font-semibold leading-6 text-gray-900">Profil</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button @click="isOpen = false" type="button" class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-emerald-500">
                                            <span class="absolute -inset-2.5"></span>
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
                                                                        <h3 class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $selectedUser->firstname }} {{ $selectedUser->lastname }}</h3>
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
                                                                    <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $user->email }}" class="inline-flex w-full flex-shrink-0 items-center justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 sm:flex-1">Message</a>
                                                                    @php
                                                                        $phoneNumber = $selectedUser->phone;
                                                                        if (substr($phoneNumber, 0, 1) === '0') {
                                                                            $phoneNumber = '+212' . substr($phoneNumber, 1);
                                                                        }
                                                                    @endphp
                                                                    <a href="tel:{{ $phoneNumber }}" class="inline-flex w-full flex-1 items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Téléphone</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="px-4 pb-5 pt-5 sm:px-0 sm:pt-5">
                                                        <dl class="space-y-8 px-4 sm:space-y-6 sm:px-6">
                                                            <div>
                                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Date de naissance</dt>

                                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                                                    <time datetime="{{ $selectedUser->birth }}">
                                                                        {{ \Carbon\Carbon::parse($selectedUser->birth)->format('F d, Y') }}
                                                                    </time>                                                                
                                                                </dd>
                                                            </div>
                                                            @if (!empty($selectedUser->phone))
                                                            <div>
                                                                @php
                                                                $phoneNumber = $selectedUser->phone;
                                                                
                                                                if (substr($phoneNumber, 0, 1) === '0') {
                                                                    // Replace the leading 0 with +212
                                                                    $phoneNumberF = '+212' . substr($phoneNumber, 1);
                                                                } else {
                                                                    // If the number is already formatted correctly, keep it as is
                                                                    $phoneNumberF = $phoneNumber;
                                                                }
                                                                
                                                                // Format the number to match the Moroccan phone number format (e.g., +212 6-XX-XX-XX-XX)
                                                                $phoneNumberF = preg_replace('/(\+212)(\d{1})(\d{2})(\d{2})(\d{2})(\d{2})/', '$1 $2$3-$4$5$6', $phoneNumberF);
                                                                @endphp
                                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Numéro de téléphone</dt>
                                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $phoneNumberF }}</dd>
                                                            </div>
                                                            @endif
                                                            @if (!empty($selectedUser->address))
                                                            <div>
                                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Adresse</dt>
                                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $selectedUser->address }}</dd>
                                                            </div>
                                                            @endif
                                                            @if (!empty($selectedUser->sex))
                                                            <div>
                                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Sexe</dt>
                                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $selectedUser->sex }}</dd>
                                                            </div>
                                                            @endif
                                                            @if (!empty($selectedUser->bio))
                                                            <div>
                                                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Biographie</dt>
                                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                                                    <p>{{ $selectedUser->bio }}</p>
                                                                </dd>
                                                            </div>
                                                            @endif
                                                        </dl>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            @endcan

                                            </div>
