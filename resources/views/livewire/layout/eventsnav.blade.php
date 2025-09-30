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
          @canany(['Lire Menu', 'Créer Menu', 'Modifier Menu', 'Supprimer Menu', 'Lire Type', 'Créer Type', 'Modifier Type', 'Supprimer Type', 'Lire Soustype', 'Créer Soustype', 'Modifier Soustype', 'Supprimer Soustype', 'Lire Ville', 'Créer Ville', 'Modifier Ville', 'Supprimer Ville', 'Lire Access', 'Créer Access', 'Modifier Access', 'Supprimer Access', 'Lire Organisme', 'Créer Organisme', 'Modifier Organisme', 'Supprimer Organisme'])
          <x-access-link :href="route('menus')" :active="(request()->routeIs('menus') || request()->routeIs('types') || request()->routeIs('subtypes') || request()->routeIs('cities')  || request()->routeIs('organisms') || request()->routeIs('inputorganism'))" >
            {{ __('Options') }}
          </x-access-link>
          @endcanany
          @canany(['Lire Publication', 'Créer Publication', 'Modifier Publication', 'Supprimer Publication'])
          <x-access-link :href="route('events')" :active="(request()->routeIs('events') || request()->routeIs('inputevent'))" >
            {{ __('Publications') }}
          </x-access-link>
          @endcanany

        </nav>
      </div>
    </div>
</div>