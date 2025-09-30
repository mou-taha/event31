<div class="mx-auto mt-10 ring-1 ring-gray-300 bg-white sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-300">
        <thead>
            <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 sr-only text-left text-sm font-semibold text-gray-900 sm:pl-6">Event</th>

                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Event</th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Sous-titre</th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Actes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($favoriteEvents as $event)
                <tr>
                    <td class="relative py-4 pl-4 pr-3 text-sm sm:pl-6">
                        <div class="flex items-center">
                            <div class="shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-md" src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}">
                            </div>
                        </div>
                    </td>
                    <td class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">{{ $event->title }}</td>

                    <td class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">{{ $event->subtitle }}</td>
                    <td class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                        <div class="flex" x-data="{ favorited: {{ $event->isFavorited ? 'true' : 'false' }} }">
                            <a href="{{ url('/?search=' .  $event->title  . '&city=&date=&sort=ds') }}" class="text-gray-900 hover:text-emerald-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 21" stroke-width="1.5" stroke="currentColor">
                                    <path fill-rule="evenodd" d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm6.39-2.908a.75.75 0 01.766.027l3.5 2.25a.75.75 0 010 1.262l-3.5 2.25A.75.75 0 018 12.25v-4.5a.75.75 0 01.39-.658z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <button @click="favorited = !favorited; $wire.toggleHeart({{ $event->id }})" class="text-gray-900 hover:text-red-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
