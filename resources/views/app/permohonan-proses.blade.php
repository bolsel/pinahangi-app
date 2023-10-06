<x-layouts.app title="Proses Permohonan">
  <div class="flex flex-col gap-6 w-full">
    <div class="bg-base-100 rounded-box">
      <div class="p-5">
        <x-data.permohonan-detail
          :permohonan="$permohonan"
          with-waktu-permohonan
          with-waktu-verifikasi
        />
      </div>
      @if($permohonan->is_perbaiki)
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
      @if($lastStatus = $permohonan->statusLog)
        <div class="border-y p-4 bg-secondary text-secondary-content flex items-center gap-2">
          Keterangan Verifikasi
        </div>
        <div class="p-4 flex flex-col gap-4">
          <x-field-data label="Diverifikasi Pada">
            <x-date-translated :value="$permohonan->waktu_verifikasi"/>
          </x-field-data>

          @if($lastStatus->keterangan)
            <x-field-data label="Keterangan">
              <div x-init="window.editorViewer($el)">{{$lastStatus->keterangan}}</div>
            </x-field-data>
          @endif
        </div>
      @endif
      <div class="border-y p-4 bg-secondary text-secondary-content flex items-center gap-2">
        <x-lucide-edit class="w-6 h-6"/>
        Proses
      </div>
      <div class="p-4">
        <livewire:permohonan-proses-form :permohonan="$permohonan"/>
      </div>
    </div>

  </div>

</x-layouts.app>
