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
                Lanjutkan ke pemohon
            </a>
        </li>
        <li>
            <a :class="{active:isTolak()}"
               x-on:click="setStatus(status_tolak)">
                <x-lucide-x-circle class="h-5 w-5"/>
                Kembalikan untuk diperbaiki
            </a>
        </li>
    </ul>
    @error('status')
    <div class="text-error">Pilih status terlebih dahulu</div> @enderror
    @php
        $organisasi_list = \App\Models\Organisasi::selectOptionValues();
    @endphp
    <div class="mt-4 max-w-lg">
        <form wire:submit="send" class="flex flex-col gap-4">
            <x-livewire.form.input
                    wire:model="keterangan" label="Keterangan"
                    :editor="['client'=>['height'=>'250px']]"/>
            <button class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.class.remove="hidden" class="hidden loading loading-spinner"></span>
                Telaah Permohonan
            </button>
        </form>
    </div>
</div>
