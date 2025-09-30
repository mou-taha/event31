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
          @can('Lire Blog')
          <x-access-link :href="route('blogs')" :active="(request()->routeIs('blogs') || request()->routeIs('inputblog'))" >
            {{ __('Blogs') }}
          </x-access-link>
          @endcan
          @can('Lire Categorie')
          <x-access-link :href="route('categories')" :active="request()->routeIs('categories')" >
            {{ __('Catégorie') }}
          </x-access-link>
          @endcan
          @can('Lire Tag')
          <x-access-link :href="route('tags')" :active="request()->routeIs('tags')" >
            {{ __('Tags') }}
          </x-access-link>
          @endcan
        </nav>
      </div>
    </div>
</div>