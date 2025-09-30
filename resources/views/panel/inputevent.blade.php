<x-app-layout>
  <!-- Page header -->

  <livewire:layout.eventsnav />
  @livewire('manage-event', ['id' => request()->route('id')])
</x-app-layout>
