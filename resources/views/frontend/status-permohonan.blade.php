<x-layouts.frontend title="Status Permohonan">
  @if($permohonan)
    @php
      $pemohon = $permohonan->pemohon;
    @endphp
    <x-slot:afterTitle>
      <div class="text-center">
        <span class="font-bold badge badge-lg">Nomor: {{$permohonan->nomor}}</span>
        <span class="font-bold badge badge-lg uppercase gap-2">
          <x-lucide-history
            class="w-3 h-3 text-gray-500"/>
          {{$permohonan->status}}
        </span>
      </div>
    </x-slot:afterTitle>
    <div class="flex flex-col lg:flex-row gap-4">
      <div class=" w-full lg:w-5/12 bg-base-100 rounded-box shadow-lg p-6">
        <div class="text-xl font-bold pb-5">Informasi Pemohon</div>
        <x-list-detail :values="[
            ['Email',$pemohon->email],
            ['Nama',$pemohon->nama],
            ['No.HP',$pemohon->nohp],
            ['Alamat',$pemohon->alamat],
          ]"/>
      </div>

      <div class="bg-base-100 w-full lg:w-7/12 rounded-box shadow-lg p-5">
        <div class="text-xl font-bold pb-5">Permohonan</div>
        <x-list-detail>
          <x-list-detail.item label="Jenis" :value="$permohonan->jenis_pemohon_label"/>
          @if($dataField = \App\Models\Permohonan::dataPemohonJenisConfig($permohonan->jenis_pemohon))
            @foreach($dataField as $n => $f)
              <x-list-detail.item :label="$f['label']" :value="$permohonan->data[$n] ?? ''"/>
            @endforeach
          @endif

          <div class="font-bold pt-5 pb-2">Deskripsi Permohonan</div>
          <div class="border-l-4 pl-4 " x-init="window.editorViewer($el)">{{$permohonan->permohonan}}</div>
        </x-list-detail>
      </div>
    </div>

    <div class="bg-base-100 w-full rounded-box shadow-lg p-5 mt-10">
      <div class="text-xl font-bold pb-5">Trace Permohonan</div>
      <div class="overflow-auto w-full">
        <table class="table table-compact w-full align-top">
          <thead>
          <tr>
            <th class="text-center">Status</th>
            <th class="">Waktu</th>
            <th class="">Keterangan</th>
          </tr>
          </thead>
          <tbody>
          @foreach($permohonan->log as $log)
            <tr>
              <td class="text-center align-top">
                <span @class([
                "flex-1 badge uppercase badge-lg",
                'badge-primary badge-outline'=>$log->status === $permohonan::STATUS_VERIFIKASI,
                'badge-error'=>$log->status === $permohonan::STATUS_VERIFIKASI_TOLAK,
                'badge-primary'=>$log->status === $permohonan::STATUS_PROSES,
                'badge-info'=>$log->status === $permohonan::STATUS_TELAAH,
                'badge-success'=>$log->status === $permohonan::STATUS_SELESAI,
                'badge-warning'=>$log->status === $permohonan::STATUS_PERBAIKI,
                ])>{{$log->status}}</span>
              </td>
              <td class="align-top whitespace-nowrap">
                <div>{{$log->waktu->translatedFormat('l, d M Y H:i')}}</div>
                <div class="italic">({{$log->waktu->diffForHumans()}})</div>
              </td>
              <td class="align-top ">
                @switch($log->status)
                  @case($permohonan::STATUS_KONSEP)
                    Pemohon mengisi formulir permohonan
                    @break
                  @case($permohonan::STATUS_VALIDASI)
                    Pemohon menyatakan formulir telah sesuai dan mengirimkan formulir untuk diverifikasi.
                    @break
                  @case($permohonan::STATUS_PERBAIKI)
                    Organisasi bersangkutan sedang memperbaiki formulir data.
                    @break
                  @case($permohonan::STATUS_VERIFIKASI_TOLAK)
                    {{$log->keterangan}}
                    @break
                  @case($permohonan::STATUS_PROSES)
                    Formulir permohonan sedang di proses oleh Organisasi bersangkutan
                    ({{$permohonan->organisasi->nama}})
                    @break
                @endswitch
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <div class="bg-base-100 rounded-box shadow-lg p-6 max-w-xl mx-auto">
      <form action="{{route('frontend.status-permohonan')}}" method="post" class="flex gap-4 flex-col">
        @csrf
        <label for="nomor_permohonan" class="text-lg font-bold">Masukan nomor permohnan</label>
        <input
          id="nomor_permohonan"
          name="nomor_permohonan" type="text" class="input peer bg-base-200"
          placeholder="xxxxxx-xxxxxxx" required/>
        <button class="btn btn-primary normal-case">
          <x-lucide-search class="h-6 w-6"/>
          Lacak Permohonan
        </button>
        @error('nomor_permohonan')
        <div class="text-error">{{$message}}</div> @enderror
      </form>
    </div>
  @endif

</x-layouts.frontend>
