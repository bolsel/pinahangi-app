<div class="flex flex-col gap-6 w-full">
  @if(!$me->identitas_lengkap)
    <div class="alert alert-info">Lengkapi terlebih dahulu data identitas anda.</div>
    @livewire('PemohonUpdateIdentitas',['redirectTo'=>route('app.permohonan-baru')])
  @else
    @if($id && $status === \App\Models\Permohonan::STATUS_VALIDASI)
      <div class="bg-base-100 rounded-box">
        <div class="border-b p-4 text-lg">Validasi Permohonan</div>
        <div class="p-4">
          <x-data.permohonan-detail :permohonan="$id" :hides="['nomor', 'tgl_permohonan']"/>
        </div>
        <div class="border-t p-4 flex flex-row gap-4">
          <button wire:click="updateFormulir" class="btn normal-case">Ubah Formulir</button>
          <button type="button" class="btn btn-primary normal-case" wire:click="send">Kirim Permintaan Informasi
          </button>
        </div>
      </div>
    @else
      <form wire:submit="save" class="flex flex-col xl:flex-row gap-6">
        <div class="w-full max-w-md">
          <div class="bg-base-100 rounded-box">
            <div class="border-b p-4 text-lg">Identitas Pemohon</div>
            <x-data.pemohon-data-detail class="p-4 max-w-md" :pemohon="$me"/>
          </div>
        </div>
        <div class="flex-1">
          <div class="bg-base-100 rounded-box">
            <div class="border-b p-4 text-lg">Formulir Permohonan Informasi</div>
            <div class="p-4 flex flex-col gap-4 ">
              <x-livewire.form.input
                wire:model.live="jenis_pemohon"
                label="Jenis Pemohon"
                :select-items="\App\Models\Pemohon::JENIS"/>

              <div class="relative">
                <div
                  wire:target="jenis_pemohon"
                  wire:loading.class.remove="hidden"
                  class="bg-base-200 absolute z-20 w-full h-full rounded-t-lg flex items-center justify-center hidden">
                  <x-lucide-loader-2 class="w-10 h-10 text-gray-400 animate-spin"/>
                </div>
                @if($jenis_pemohon && in_array($jenis_pemohon, [\App\Models\Pemohon::JENIS_BADAN_HUKUM,\App\Models\Pemohon::JENIS_KELOMPOK]))
                  @php
                    if($jenis_pemohon === \App\Models\Pemohon::JENIS_BADAN_HUKUM){
                      $labelJenis = 'Akta pendirian badan hukum yang telah mendapatkan pengesahan dari Kemenkumham';
                    }
                    elseif($jenis_pemohon === \App\Models\Pemohon::JENIS_KELOMPOK){
                      $labelJenis = 'Surat kuasa khusus dari pemberi kuasa dan penerima kuasa';
                    }
                    $_fields = \App\Models\Permohonan::dataPemohonJenisConfig($jenis_pemohon);
                  @endphp
                  <div class="flex flex-col gap-4">
                    @foreach($_fields as $_name => $conf)
                      <x-livewire.form.input
                        wire:model="data.{{$_name}}" label="{{$conf['label']}}"
                        :required="$conf['required']"
                        :textarea="$conf['textarea'] ?? false"
                      />
                    @endforeach
                    <x-livewire.form.input
                      wire:model.live="berkasJenis" label="Unggah Berkas" required
                      :file="[
                        'ket'=>$labelJenis,
                        'mimes'=>'jpg,png,jpeg,pdf',
                        'maxSize'=>'3072',
                        'currentUrl' => $berkasJenis instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
                            ? $berkasJenis->temporaryUrl() : ($currentPermohonan && $currentPermohonan->berkasJenis ? $currentPermohonan->berkasJenis->url : null)
                      ]"
                    >
                    </x-livewire.form.input>
                  </div>
                @endif
              </div>
              <x-livewire.form.input wire:model.live.debounce.200ms="permohonan" label="Permohonan Informasi"
                                     required
                                     :editor="[]"/>
            </div>
            <div class="border-t p-4 text-lg text-right">
              <button class="btn btn-primary">Kirim Permohonan Informasi</button>
            </div>
          </div>

        </div>
      </form>
    @endif
  @endif
</div>
