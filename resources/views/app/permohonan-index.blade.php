<x-layouts.app title="Permohonan">
  <div class="flex flex-col gap-6 w-full">
    @if(Gate::check('roleIsUser'))
      @php
        $permohonanAktif = \App\Models\Pemohon::me()->permohonanAktif;
      @endphp
      <div>
        <a
          @if($permohonanAktif) disabled @endif
        href="{{route('app.permohonan-baru')}}" wire:navigate
          class="btn btn-primary normal-case">
          Buat Permohonan Baru
        </a>
      </div>
    @endif
    <div class="bg-base-100 rounded-box">
      <div class="border-b p-4 text-lg">Semua Permohonan</div>

      @if($data)
        <div class="overflow-auto">
          <table class="table border-b">
            <thead>
            <tr>
              <th class="w-1"></th>
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
                <td>
                  <a href="{{route('app.permohonan.detail', ['permohonan'=>$row])}}"
                     class="btn btn-xs normal-case">Detail</a>
                </td>
                <td>{{ $data->firstItem() + $loop->index }}</td>
                <td>{{$row->pemohon->nama}}</td>
                <td>{{Str::headline($row->status)}}</td>
                <td>{{$row->jenis_pemohon_label}}</td>
                <td>
                  <x-date-translated :value="$row->waktu_permohonan" no-humans/>
                </td>
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
