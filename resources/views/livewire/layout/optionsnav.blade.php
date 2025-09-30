<?php

use Livewire\Volt\Component;

new class extends Component
{

}; ?>


<div>
  <div class="items-center justify-center md:justify-start flex">
    <nav class="flex justify-center md:justify-start space-x-4  pl-0 md:pl-5 md:rounded-br-xl w-full md:w-1/2 py-3" aria-label="Tabs">
      <!-- Current: "bg-emerald-100 text-emerald-700", Default: "text-gray-500 hover:text-gray-700" -->
      @canany(['Lire Menu', 'Créer Menu', 'Modifier Menu', 'Supprimer Menu'])
      <x-options-link :href="route('menus')" :active="request()->routeIs('menus')" >
        {{ __('Menus') }}
      </x-options-link>
      @endcanany
      @canany(['Lire Type', 'Créer Type', 'Modifier Type', 'Supprimer Type'])
      <x-options-link :href="route('types')" :active="request()->routeIs('types')" >
        {{ __('Types') }}
      </x-options-link>
      @endcanany
      @canany(['Lire Soustype', 'Créer Soustype', 'Modifier Soustype', 'Supprimer Soustype'])
      <x-options-link :href="route('subtypes')" :active="request()->routeIs('subtypes')" >
        {{ __('Sous-types') }}
      </x-options-link>
      @endcanany
      @canany(['Lire Ville', 'Créer Ville', 'Modifier Ville', 'Supprimer Ville'])
      <x-options-link :href="route('cities')" :active="request()->routeIs('cities')" >
        {{ __('Villes') }}
      </x-options-link>
      @endcanany
      @canany(['Lire Access', 'Créer Access', 'Modifier Access', 'Supprimer Access'])
      <x-options-link :href="route('prices')" :active="request()->routeIs('prices')" >
        {{ __('Prix') }}
      </x-options-link>
      @endcanany
      @canany(['Lire Organisme', 'Créer Organisme', 'Modifier Organisme', 'Supprimer Organisme'])
      <x-options-link :href="route('organisms')" :active="(request()->routeIs('inputorganism') || request()->routeIs('organisms'))" >
        {{ __('Organismes') }}
      </x-options-link>
      @endcanany
    </nav>
  </div>
</div>