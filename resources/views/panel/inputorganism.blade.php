<x-app-layout>
  <livewire:layout.eventsnav />
  <livewire:layout.optionsnav />  
  @livewire('manage-organism', ['id' => request()->route('id')])
</x-app-layout>
