<div class="flex flex-col gap-6 w-full">
  <x-slot:global-informasi>
    Email user harus email yang aktif, agar dapat menerima pemberitahuan mengenai Permohonan yang harus diproses atau
    diperbaiki.
  </x-slot:global-informasi>
  <div class="bg-base-100 rounded-box">

    <x-livewire.data :data="$data">

      <x-slot:topleft>
        <a href="{{route('app.organisasi.user.form')}}" wire:navigate class="btn btn-sm btn-primary">Tambah</a>
      </x-slot:topleft>
      <x-slot:thead>
        <tr class="">
          <th class=""></th>
          <th class="w-1 text-right">#</th>
          <x-livewire.data.table-th field="email" sortable>EMAIL</x-livewire.data.table-th>
          <x-livewire.data.table-th field="name" sortable>NAMA</x-livewire.data.table-th>
          <x-livewire.data.table-th field="alamat">Organisasi</x-livewire.data.table-th>
        </tr>
      </x-slot:thead>
      <x-slot:tbody>
        @foreach($data as $row)
          <tr>
            <x-livewire.data.table-td-action :id="$row->id" update-route="app.organisasi.user.form"/>
            <td class="text-right">{{$data->firstItem() + $loop->index}}</td>
            <td class="w-1 whitespace-nowrap">{{$row->email}}</td>
            <td class="w-96">{{$row->name}}</td>
            <td>{{$row->organisasi->nama}}</td>
          </tr>
        @endforeach
      </x-slot:tbody>
    </x-livewire.data>
  </div>
</div>
