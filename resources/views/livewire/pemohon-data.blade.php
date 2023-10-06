<div class="flex flex-col gap-6 w-full">

  <div class="bg-base-100 rounded-box flex flex-col">

    <x-livewire.data :data="$data">
      <x-slot:thead>
        <tr class="">
          <th class="w-1 text-right">#</th>
          <x-livewire.data.table-th field="u.email" sortable>EMAIL</x-livewire.data.table-th>
          <x-livewire.data.table-th field="u.name" sortable>NAMA</x-livewire.data.table-th>
          <x-livewire.data.table-th field="nohp">NO. HP</x-livewire.data.table-th>
          <x-livewire.data.table-th field="alamat">ALAMAT</x-livewire.data.table-th>
          <th>LENGKAP</th>
        </tr>
      </x-slot:thead>
      <x-slot:tbody>
        @foreach($data as $row)
          <tr>
            <td class="text-right">{{$data->firstItem() + $loop->index}}</td>
            <td class="w-1 whitespace-nowrap">{{$row->user->email}}</td>
            <td class="w-96 whitespace-nowrap">{{$row->user->name}}</td>
            <td class="whitespace-nowrap">{{$row->nohp}}</td>
            <td>
              <div class="truncate w-40">{{$row->alamat}}</div>
            </td>
            <td>
              {{$row->identitas_lengkap ? 'Ya':'Belum'}}
            </td>
          </tr>
        @endforeach
      </x-slot:tbody>
    </x-livewire.data>
  </div>
</div>
