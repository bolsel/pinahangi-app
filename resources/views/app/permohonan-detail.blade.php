<x-layouts.app title="Detail Permohonan">
  <div class="flex flex-col gap-6 w-full">
    <div class="bg-base-100 rounded-box shadow-sm">
      <div class="p-5">
        <x-data.permohonan-detail
          :permohonan="$permohonan"
        />
      </div>
    </div>

    @if($permohonan->status === $permohonan::STATUS_SELESAI)
      <div class="bg-base-100 rounded-box shadow-sm">
        <div class="bg-primary text-primary-content rounded-t-box border-b p-4 text-lg font-semibold">Informasi Dari
          Organisasi
        </div>
        <div class="p-5 flex flex-col gap-4">

          <x-field-data label="Organisasi" :value="$permohonan->organisasi->nama"/>
          <x-field-data label="Informasi">
            <div x-init="window.editorViewer($el)">{{$permohonan->informasi ?? "-"}}</div>
          </x-field-data>
          <x-field-data label="Dokumen">
            <div class="flex flex-col gap-1 mt-3">
              @foreach($permohonan->dataFiles as $file)
                <div>
                  <a class="link link-primary link-hover break-words" target="_blank"
                     href="{{$file->url}}">{{$file->name}}</a>
                </div>
              @endforeach
            </div>
          </x-field-data>
        </div>
      </div>
      <div class="bg-base-100 rounded-box shadow-sm">
        <div class="bg-primary text-primary-content rounded-t-box border-b p-4 text-lg font-semibold">
          Kepuasan Permohonan
        </div>
        @livewire('PermohonanPuas',['permohonan'=>$permohonan])
      </div>
    @endif

    <div class="bg-base-100 rounded-box shadow-sm">
      <div class="border-b p-4 text-lg font-semibold">Trace Permohonan</div>
      <x-data.permohonan-trace :permohonan="$permohonan"/>
    </div>
  </div>
</x-layouts.app>
