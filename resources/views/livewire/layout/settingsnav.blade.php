<?php

use Livewire\Volt\Component;

new class extends Component
{

}; ?>
<aside class="py-6 lg:col-span-3">
  <nav class="space-y-1">
    <!-- Current: "border-teal-500 bg-teal-50 text-teal-700 hover:bg-teal-50 hover:text-teal-700", Default: "border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900" -->
    <x-settings-link :href="route('settings')" :active="request()->routeIs('settings')" >
      <x-settings-svg :href="route('settings')" :active="request()->routeIs('settings')" >
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
      </x-settings-svg>
          {{ __('Profile') }}
    </x-settings-link>
    <x-settings-link :href="route('settingsaccount')" :active="request()->routeIs('settingsaccount')" >
      <x-settings-svg :href="route('settingsaccount')" :active="request()->routeIs('settingsaccount')" >
          <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
      </x-settings-svg>
          {{ __('Compte') }}
    </x-settings-link>
    <x-settings-link :href="route('settingspassword')" :active="request()->routeIs('settingspassword')" >
      <x-settings-svg :href="route('settingspassword')" :active="request()->routeIs('settingspassword')" >
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
      </x-settings-svg>
          {{ __('Mot de passe') }}
    </x-settings-link>
  </nav>
</aside>