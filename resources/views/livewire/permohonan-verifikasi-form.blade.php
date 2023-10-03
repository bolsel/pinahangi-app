<div x-data="{
    status:null,
    status_terima: $wire.get('status_terima'),
    status_tolak: $wire.get('status_tolak'),
    isTerima: function(){
        return this.status === this.status_terima;
    },
    isTolak: function(){
        return this.status === this.status_tolak
    },
    setStatus: function(val){
        $wire.set('status',val,false);
        this.status = val
    }
}">
  <ul class="menu bg-base-200 menu-horizontal rounded-box gap-2">
    <li>
      <a :class="{active:isTerima()}"
         x-on:click="setStatus(status_terima)">
        <x-lucide-check-circle class="h-5 w-5"/>
        Terima Formulir
      </a>
    </li>
    <li>
      <a :class="{active:isTolak()}"
         x-on:click="setStatus(status_tolak)">
        <x-lucide-x-circle class="h-5 w-5"/>
        Tolak Formulir
      </a>
    </li>
  </ul>
  @php
    $organisasi_list = \App\Models\Organisasi::selectOptionValues();
  @endphp
  <div class="mt-4 max-w-lg" x-show="status">
    <form wire:submit="send" class="flex flex-col gap-4">

      <x-livewire.form.input
        wire:model="keterangan" label="Keterangan"
        :editor="['client'=>['height'=>'250px']]"/>
      <div x-show="isTerima()">
        <x-livewire.form.input
          wire:model="organisasi_id" label="Organisasi"
          :select-items="$organisasi_list"
          ket="Formulir akan dilanjutkan ke organisasi ini"
        />
      </div>
      <button class="btn btn-primary" wire:loading.attr="disabled">
        <span wire:loading.class.remove="hidden" class="hidden loading loading-spinner"></span>
        Verifikasi
      </button>
    </form>
  </div>
</div>
