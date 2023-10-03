<x-livewire.data :data="$data" :can-delete="false">
  <x-slot:thead>
    <tr class="">
      <th class=""></th>
      <th class="w-1 text-right">#</th>
      <x-livewire.data.table-th field="id" sortable class="w-1 text-right">ID</x-livewire.data.table-th>
      <x-livewire.data.table-th field="nama" sortable>NAMA</x-livewire.data.table-th>
      <x-livewire.data.table-th field="alamat">ALAMAT</x-livewire.data.table-th>
    </tr>
  </x-slot:thead>
  <x-slot:tbody>
    @foreach($data as $row)
      <tr>
        <td class="text-right">{{$loop->index + 1}}</td>
        <td class="w-1 text-center">{{$row->id}}</td>
        <td class="w-96">{{$row->nama}}</td>
        <td>{{$row->alamat}}</td>
      </tr>
    @endforeach
  </x-slot:tbody>
</x-livewire.data>
