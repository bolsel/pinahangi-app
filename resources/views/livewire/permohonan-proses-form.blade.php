<div>
  <div class="mt-4" x-data="{
      dataKeys:['base'],
      addData(){
        this.dataKeys.push((Math.random() + 1).toString(36).substring(7));
      }
    }
  ">
    <form wire:submit="save" class="">
      <div class="flex flex-col  gap-4">
        <x-livewire.form.input
          wire:model="informasi" label="Informasi"
          :editor="['client'=>['height'=>'300px']]"/>

        @if($permohonan->is_perbaiki)
          <x-field-data label="Dokumen Sebelumnya">
            <div class="flex flex-col gap-1 mt-3">
              @foreach($permohonan->dataFiles as $file)
                <div class="flex gap-3">
                  <a class="link link-hover break-words" target="_blank"
                     href="{{$file->url}}">{{$file->name}}</a>
                  <button type="button"
                          wire:click="hapusDataFile({{$file->id}})"
                          class="btn btn-xs btn-error btn-outline">Hapus
                  </button>
                </div>
              @endforeach
            </div>
          </x-field-data>
          <div wire:loading.class.remove="hidden" wire:target="hapusDataFile"
               class="hidden loading loading-bars"></div>
        @endif
        @foreach($dataKeys as $k)
          @php
            $_data = isset($data[$k]) && $data[$k] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
                            ? $data[$k] : null
          @endphp
          <x-livewire.form.input
            wire:model="data.{{$k}}" label="Dokumen"
            :file="[
                                'mimes'=>'jpg,png,pdf',
                                'maxSize'=>'10485',
                                'hideUpload'=>$_data !== null
                            ]">
            @if($_data)
              <div class="flex flex-col items-start gap-2 mt-4">
                <div>{{$_data->getClientOriginalName()}}</div>
                <a target="_blank" href="{{$data[$k]->temporaryUrl()}}"
                   class="btn btn-xs btn-primary btn-outline normal-case">Lihat file</a>
              </div>
            @endif
          </x-livewire.form.input>
        @endforeach
        <div wire:loading.class.remove="hidden" wire:target="addDataKeys"
             class="hidden loading loading-bars"></div>
        <div>
          <button type="button" class="btn btn-outline btn-primary btn-sm normal-case"
                  wire:click="addDataKeys">Tambah Dokumen
          </button>
        </div>
        <div class="divider"></div>
        <div>
          <button class="btn btn-primary" wire:loading.attr="disabled">
            <span wire:loading.class.remove="hidden" class="hidden loading loading-spinner"></span>
            Proses Permohonan
          </button>
        </div>

      </div>
    </form>
  </div>
</div>
