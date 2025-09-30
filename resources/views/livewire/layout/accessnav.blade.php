<?php

use Livewire\Volt\Component;

new class extends Component
{

}; ?>

<div class="lg:col-span-9 xl:col-span-6">
    <div class=" sm:px-0">
      <div class="">
        <nav class="isolate flex divide-x divide-gray-200 shadow" aria-label="Tabs">
          <!-- Current: "text-gray-900", Default: "text-gray-500 hover:text-gray-700" -->
          @can('Lire Utilisateur')
          <x-access-link :href="route('access')" :active="request()->routeIs('access')" >
            {{ __('Utilisateurs') }}
          </x-access-link>
          @endcan
          @can('Lire Role')
          <x-access-link :href="route('roles')" :active="request()->routeIs('roles')" >
            {{ __('Roles') }}
          </x-access-link>
          @endcan
          @can('Lire Permission')
          <x-access-link :href="route('permissions')" :active="request()->routeIs('permissions')" >
            {{ __('Permissions') }}
          </x-access-link>
          @endcan
        </nav>
      </div>
    </div>
</div>