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
          <x-date-translated :value="$log->waktu"/>
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
