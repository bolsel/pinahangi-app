@php
  $pemohon = $permohonan->pemohon;
@endphp
<div class="p-4 gap-4 flex flex-col lg:flex-row w-full">
  <x-data.pemohon-data-detail class="w-full lg:w-3/6 xl:w-2/6" :pemohon="$pemohon"/>

  <div class="w-full lg:w-3/6 xl:w-4/6 flex flex-col gap-4">
    <x-field-data label="Jenis Permohonan" :value="\App\Models\Pemohon::JENIS[$permohonan->jenis_pemohon]"/>
    @if($permohonan->jenis_pemohon !== \App\Models\Pemohon::JENIS_PERORANGAN)
      @foreach(\App\Models\Permohonan::dataPemohonJenisConfig($permohonan->jenis_pemohon) as $_name => $conf)
        <x-field-data :label="$conf['label']" :value="$permohonan->data[$_name] ?? ''"/>
      @endforeach
      <x-field-data label="Scan berkas pendukung">
        <a href="{{$permohonan->berkasJenis?->url}}" target="_blank"
           class="btn btn-sm btn-outline btn-primary normal-case">Lihat
          file</a>
      </x-field-data>
    @endif

    <x-field-data label="Permohonan Informasi">
      <div x-init="window.editorViewer($el)">{{$permohonan->permohonan}}</div>
    </x-field-data>
    @if($withWaktuPermohonan)
      <x-field-data label="Waktu Permohonan">
        <div>{{$permohonan->waktu_permohonan?->translatedFormat('l, d M Y H:i')}}</div>
        <div>({{$permohonan->waktu_permohonan?->diffForHumans()}})</div>
      </x-field-data>
    @endif
    @if($withWaktuVerifikasi)
      <x-field-data label="Diverifikasi pada">
        <div>{{$permohonan->waktu_verifikasi?->translatedFormat('l, d M Y H:i')}}</div>
        <div>({{$permohonan->waktu_verifikasi?->diffForHumans()}})</div>
      </x-field-data>
    @endif
    {{$slot}}
  </div>
</div>
