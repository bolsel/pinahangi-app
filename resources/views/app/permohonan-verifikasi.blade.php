<x-layouts.app title="Verifikasi Permohonan">
  <div class="flex flex-col gap-6 w-full">

    <div class="bg-base-100 rounded-box">
      <div class="p-5">
        <x-data.permohonan-detail
          :permohonan="$permohonan"
          with-waktu-permohonan
        />
      </div>

      <div class="border-y p-4 bg-secondary text-secondary-content flex items-center gap-2">
        <x-lucide-edit class="w-6 h-6"/>
        Verifikasi
      </div>
      <div class="p-4">
        <livewire:permohonan-verifikasi-form :permohonan="$permohonan"/>
      </div>
    </div>

  </div>

</x-layouts.app>
