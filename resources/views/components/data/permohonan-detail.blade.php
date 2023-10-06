@php
  $pemohon = $permohonan->pemohon;
@endphp
<div class="gap-4 flex flex-col">
  <div class="grid lg:grid-cols-2 gap-4">
    <x-list-detail
      title="Permohonan"
      class="border shadow-sm rounded-box"

    >
      @if(!$isHide('nomor'))
        <x-list-detail.item label="Nomor" :value="$permohonan->nomor ?? 'Belum ada nomor permohonan'"/>
      @endif
      @if(!$isHide('tgl_permohonan'))
        <x-list-detail.item label="Tgl Permohonan">
          <x-date-translated :value="$permohonan->waktu_permohonan"/>
        </x-list-detail.item>
      @endif
      <x-list-detail.item label="Jenis Permohonan" :value="$permohonan->jenis_pemohon_label"/>
      @if($dataField = \App\Models\Permohonan::dataPemohonJenisConfig($permohonan->jenis_pemohon))
        @foreach($dataField as $n => $f)
          <x-list-detail.item :label="$f['label']" :value="$permohonan->data[$n] ?? ''"/>
        @endforeach
        @if($berkasJenis = $permohonan->berkasJenis)
          <x-list-detail.item label="Berkas Pendukung">
            <a target="_blank" href="{{$berkasJenis->url}}" class="btn btn-xs normal-case">Lihat</a>
          </x-list-detail.item>
        @endif
      @endif
      <div class="p-5">
        <div class="font-bold">Permohonan Informasi</div>
        <div class="border-l-4 pl-4 " x-init="window.editorViewer($el)">{{$permohonan->permohonan}}</div>
      </div>
    </x-list-detail>
    <x-list-detail class="border shadow-sm rounded-box" title="Identitas Pemohon" :values="[
            ['Email', $pemohon->email],
            ['Nama', $pemohon->nama],
            ['No.HP', $pemohon->nohp],
            ['Alamat', $pemohon->alamat],
          ]">
      <x-list-detail.item label="Scan KTP" no-border>
        <img class="rounded-xl p-2" src="{{$pemohon->ktp?->url}}"/>
      </x-list-detail.item>
    </x-list-detail>
  </div>
</div>
