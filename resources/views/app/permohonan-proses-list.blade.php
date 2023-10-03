<x-layouts.app :title="($perbaiki ? 'Perbaiki':'Proses').'  Permohonan'">
  <div class="flex flex-col gap-6 w-full">

    <div class="bg-base-100 rounded-box">
      <div class="border-b p-4 text-lg">Permohonan Perlu {{($perbaiki ? 'Diperbaiki':'Diproses')}}</div>

      @if($data && $data->count())
        <div class="overflow-auto">
          <table class="table">
            <thead>
            <tr>
              <th class="w-1 text-center"></th>
              <th class="w-1">#</th>
              <th>NOMOR PERMOHONAN</th>
              <th>NAMA PEMOHON</th>
              <th>JENIS PEMOHON</th>
              <th>WAKTU PERMOHONAN</th>
              <th>WAKTU VERIFIKASI</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
              <tr>
                <td>
                  <a wire:navigate href="{{route('app.permohonan.proses', ['permohonan'=>$row])}}"
                     class="btn btn-sm btn-outline btn-primary normal-case">
                    {{$perbaiki ? 'Perbaiki' : 'Proses'}}
                  </a>
                </td>
                <td>{{ $data->firstItem() + $loop->index }}</td>
                <td>{{$row->nomor}}</td>
                <td>{{$row->pemohon->nama}}</td>
                <td>{{$row->jenis_pemohon_label}}</td>
                <td>{{$row->waktu_permohonan}}</td>
                <td>{{$row->waktu_verifikasi}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="p-2">
          {{$data->links()}}
        </div>
      @else
        <div class="p-3">Belum ada permohonan untuk diproses</div>
      @endif
    </div>

  </div>

</x-layouts.app>
