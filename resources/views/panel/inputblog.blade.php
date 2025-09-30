<x-app-layout>
  <!-- Page header -->

  <livewire:layout.blogsnav />
  @livewire('manage-blog', ['id' => request()->route('id'), 'selectedCity' => 1])

</x-app-layout>
