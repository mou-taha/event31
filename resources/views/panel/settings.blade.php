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
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                </svg>                
                <h1 class="ml-1 text-xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9">Settings</h1>
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
              <livewire:layout.settingsnav />
              @livewire('settings-form')
            </div>
          </div>
        </div>
      </div>
</x-app-layout>
