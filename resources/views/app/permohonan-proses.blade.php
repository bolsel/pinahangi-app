<x-layouts.app title="Proses Permohonan">
  <div class="flex flex-col gap-6 w-full">

    <div class="bg-base-100 rounded-box">
      <div class="border-b p-4 text-lg">Permohonan</div>
      <x-data.permohonan-detail
        :permohonan="$permohonan"
        with-waktu-permohonan
        with-waktu-verifikasi
      />
      @if($permohonan->isPerbaiki())
        <div class="border-y p-4 bg-secondary text-secondary-content flex items-center gap-2">
          <x-lucide-info class="w-6 h-6"/>
          Perbaikan
        </div>

        <div class="p-4 flex flex-col gap-4">
          <x-field-data label="Keterangan">
            <div x-init="window.editorViewer($el)">{{$permohonan->statusLog->keterangan ?? "..."}}</div>
          </x-field-data>
        </div>
      @endif
      <div class="border-y p-4 bg-secondary text-secondary-content flex items-center gap-2">
        <x-lucide-settings-2 class="w-6 h-6"/>
        Proses
      </div>
      <div class="p-4">
        <livewire:permohonan-proses-form :permohonan="$permohonan"/>
      </div>
    </div>

  </div>

</x-layouts.app>
