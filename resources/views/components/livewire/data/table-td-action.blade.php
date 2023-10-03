@props(['id', 'updateRoute'=>''])
<td class="w-1">
  <div class="flex gap-2">
    @if($updateRoute)
      <a href="{{route($updateRoute,['id'=>$id])}}" class="flex cursor-pointer hover:underline" wire:navigate>
        <x-lucide-edit class="w-4 h-4"/>
        Edit
      </a>
    @endif
    @if($this->canHapus())
      <div class="flex text-error cursor-pointer hover:underline" @click="deleteId='{{$id}}'">
        <x-lucide-trash class="w-4 h-4"/>
        Hapus
      </div>
    @endif
  </div>
</td>
