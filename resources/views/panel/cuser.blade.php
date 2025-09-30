<x-app-layout>
  <!-- Page header -->
  <div class="bg-white shadow">
    <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
      <div class="py-4 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
        <div class="min-w-0 flex-1">
          <!-- Profile -->
          <div class="flex items-center">
            <div class="flex items-center justify-center">
              <svg class="h-6 w-6 flex-shrink-0 text-gray-900" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
              </svg>                
              <h1 class="ml-1 text-xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9">user</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-4">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 ">
      <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
          @livewire('chat')
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
