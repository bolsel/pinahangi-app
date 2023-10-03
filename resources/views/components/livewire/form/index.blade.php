@props([
    'cancelRoute'
])
<div class="flex flex-col w-full gap-6">
  <form wire:submit="save">
    <div class="flex flex-col w-full bg-base-100 rounded-box shadow-xl relative">
      <div class="p-4">
        {{$slot}}
      </div>
      <div class="divider"></div>
      <div class="p-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{route($cancelRoute)}}" wire:navigate class="btn btn-ghost">Batal</a>
      </div>
    </div>
  </form>
</div>
