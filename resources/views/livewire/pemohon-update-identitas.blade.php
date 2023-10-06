<div class="flex flex-col gap-6 w-full">
  <form wire:submit="save">
    <div class="bg-base-100 rounded-box">
      <div class="p-4 flex flex-col gap-4 max-w-xl">
        <x-livewire.form.input wire:model="nama" label="Nama lengkap" required/>
        <x-livewire.form.input wire:model="nohp" label="Nomor HP" required x-mask="+62999999999999"/>
        <x-livewire.form.input wire:model="alamat" label="Alamat lengkap" required textarea/>

        <x-livewire.form.input
          wire:model="berkasKtp" label="KTP" required
          :file="array_merge($fileConfig,[
            'ket'=>'Scan KTP / Surat keterangan kependudukan dari Disdukcapil',
            'current' => $me && $me->ktp,
            ])">
          <div class="w-full max-h-80 overflow-auto bg-base-200 rounded-lg p-2">
            @if($berkasKtp)
              <img src="{{$berkasKtp->temporaryUrl()}}" class="w-full h-auto rounded-lg"/>
            @elseif($me && $me->ktp)
              <img src="{{$me->ktp->url}}" class="w-full h-auto rounded-lg"/>
            @endif
          </div>
        </x-livewire.form.input>
      </div>
      <div class="border-t p-4 text-lg flex gap-4 items-center">
        <button type="submit" class="btn btn-primary">Update</button>
        <div wire:loading wire:target="save">Menyimpan data...</div>
        @if(session('status'))
          <div wire:loading.class="hidden" class="text-success">{{session('status')}}</div>
        @endif
      </div>

    </div>
  </form>
</div>
