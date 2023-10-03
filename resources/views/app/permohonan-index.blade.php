<x-layouts.app title="Permohonan">
  <div class="flex flex-col gap-6 w-full">

    <div class="bg-base-100 rounded-box">
      <div class="border-b p-4 text-lg">Semua Permohonan</div>

      @if($data)
        <div class="overflow-auto">
          <table class="table border-b">
            <thead>
            <tr>
              <th class="w-1">#</th>
              <th>NAMA PEMOHON</th>
              <th>STATUS</th>
              <th>JENIS PEMOHON</th>
              <th>WAKTU PERMOHONAN</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
              <tr>
                <td>{{ $data->firstItem() + $loop->index }}</td>
                <td>{{$row->pemohon->nama}}</td>
                <td>{{$row['status']}}</td>
                <td>{{$row['jenis_pemohon']}}</td>
                <td>{{$row['send_at']}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="p-2">
          {{$data->links()}}
        </div>
      @else
        <div class="p-3">Belum ada permohonan</div>
      @endif
    </div>

  </div>

</x-layouts.app>
