@props(['id','name','editor','label'])

<div class="f-input peer @error($name) border-error focus:border-error @enderror">
  <div class="flex flex-col gap-4 mt-2">
    <input type="hidden" {{$attributes}}/>
    <div class=""
         wire:key="{{ rand().time() }}"
         x-init="wireEditor($el, {
           name: '{{$name}}',
            wire: $wire,
            merge: {{json_encode($editor['client'] ?? [])}}
         })"
    >
    </div>
  </div>
</div>
