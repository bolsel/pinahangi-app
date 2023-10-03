<x-layouts.app title="Permohonan Informasi">
  <div class="flex flex-col gap-6 w-full">
    <div>
      <a
        @if($permohonanAktif) disabled @endif
      href="{{route('app.permohonan-baru')}}" wire:navigate
        class="btn btn-primary normal-case">
        Buat Permohonan Baru
      </a>
    </div>
    @if($permohonanAktif)
      <div class="bg-base-100 rounded-box">
        <div class="border-b p-4 text-lg">Dalam Proses</div>
        <div class="p-4 gap-4 flex flex-col lg:flex-row w-full">

        </div>
      </div>
    @endif


    <div class="bg-base-100 rounded-box">
      <div class="border-b p-4 text-lg">Semua Permohonan</div>
      @if($semua)
        <table class="table">
          <thead>
          <tr>
            <th class="w-1">#</th>
            <th>STATUS</th>
            <th>JENIS PEMOHON</th>
            <th>WAKTU PERMOHONAN</th>
          </tr>
          </thead>
          <tbody>
          @foreach($semua as $row)
            <tr>
              <td>{{ $semua->firstItem() + $loop->index }}</td>
              <td>{{$row['status']}}</td>
              <td>{{$row['jenis_pemohon']}}</td>
              <td>{{$row->waktu_permohonan}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
        <div class="p-2">
          {{$semua->links()}}
        </div>
      @else
        <div class="p-3">Belum ada permohonan</div>
      @endif
    </div>
  </div>
</x-layouts.app>
