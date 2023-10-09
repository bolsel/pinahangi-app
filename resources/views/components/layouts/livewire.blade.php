<x-layouts.app :is-livewire="true" :title="$title ?? ''">
  @isset($globalInformasi)
    <x-slot:global-informasi>
      {{$globalInformasi}}
    </x-slot:global-informasi>
  @endisset
  {{ $slot }}
</x-layouts.app>
