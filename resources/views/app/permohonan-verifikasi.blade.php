<x-layouts.app title="Verifikasi Permohonan">
  <div class="flex flex-col gap-6 w-full">

    <div class="bg-base-100 rounded-box">
      <div class="border-b p-4 text-lg">Verifikasi Permohonan</div>
      <x-data.permohonan-detail
        :permohonan="$permohonan"
        with-waktu-permohonan
      />
      <div class="divider"></div>
      <div class="p-4">
        <livewire:permohonan-verifikasi-form :permohonan="$permohonan"/>
      </div>
    </div>

  </div>

</x-layouts.app>
