<div class="p-5 flex flex-col gap-4">
  @if(!$permohonan->kepuasan)
    @if(Gate::check('roleIsUser'))
      <div>Berikan kepuasan anda untuk permohonan ini.</div>
      <form wire:submit="send">
        <div
          class="flex flex-col gap-6 justify-start items-start w-full max-w-md"
          x-data="{rating:$wire.get('puas')}"
        >
          <ul class="menu bg-base-100 menu-horizontal rounded-box gap-2">
            <li wire:click="setPuas(true)">
              <a @class(['border rounded-box','active'=>$puas===true])>
                <x-lucide-smile class="h-6 w-6"/>
                PUAS
              </a>
            </li>
            <li wire:click="setPuas(false)">
              <a @class(['border rounded-box','active'=>$puas===false])>
                <x-lucide-frown class="h-6 w-6"/>
                TIDAK PUAS
              </a>
            </li>
          </ul>
          @error('puas')
          <div class="text-error">Pilih kepuasan</div> @enderror
          <div wire:loading.class.remove="hidden" wire:target="setPuas" class="hidden loading loading-bars"></div>
          @if(isset($puas))
            <div class="w-full">
              <x-livewire.form.input
                wire:model="keterangan"
                label="Keterangan"
                required="{{$puas === false}}"
                :editor="['client'=>['height'=>'250px']]"
              />
            </div>
            <button type="submit" class="btn btn-primary">
              <div wire:loading.class.remove="hidden" wire:target="send" class="hidden loading loading-spinner"></div>
              <x-lucide-send class="w-6 h-6"/>
              Kirim Kepuasan
            </button>
          @endif
        </div>
      </form>
    @else
      Pemohon belum memberikan tanggapan kepuasan untuk permohonan ini.
    @endif
  @else
    <div>
      Pemohon menyatakan
      <span
      @class(["badge badge-lg", $permohonan->kepuasan->puas ? 'badge-success' : 'badge-warning'])>
        {{$permohonan->kepuasan->puas ? 'PUAS':'TIDAK PUAS'}}
      </span> untuk permohonan ini.
    </div>
    @if($_ket = $permohonan->kepuasan->keterangan)
      <x-field-data label="Keterangan">
        <div x-init="window.editorViewer($el)">{{$_ket}}</div>
      </x-field-data>
    @endif
  @endif
</div>
