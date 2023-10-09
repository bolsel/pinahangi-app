<div class="flex flex-col gap-6 w-full">
  <x-slot:global-informasi>
    Setelah menambahkan organisasi baru, tambahkan juga user Organisasi pada menu <a
      class="link link-hover link-primary"
      href="{{route('app.organisasi.user')}}">Organisasi User</a>. User perlu dibuat untuk melakukan proses permohonan.
  </x-slot:global-informasi>
  <div class="bg-base-100 rounded-box flex flex-col">

    <x-livewire.data :data="$data">
      <x-slot:topleft>
        <a wire:navigate href="{{route('app.organisasi.form')}}" class="btn btn-sm btn-primary">Tambah</a>
      </x-slot:topleft>
      <x-slot:thead>
        <tr class="">
          <th class=""></th>
          <th class="w-1 text-right">#</th>
          <x-livewire.data.table-th field="id" sortable class="w-1 text-right">ID</x-livewire.data.table-th>
          <x-livewire.data.table-th field="nama" sortable>NAMA</x-livewire.data.table-th>
          <x-livewire.data.table-th field="alamat">ALAMAT</x-livewire.data.table-th>
          <x-livewire.data.table-th class="justify-center items-center">USER</x-livewire.data.table-th>
        </tr>
      </x-slot:thead>
      <x-slot:tbody>
        @foreach($data as $row)
          <tr>
            <x-livewire.data.table-td-action :id="$row->id" update-route="app.organisasi.form"/>
            <td class="text-right">{{$data->firstItem() + $loop->index}}</td>
            <td class="w-1 text-center">{{$row->id}}</td>
            <td class="w-96">{{$row->nama}}</td>
            <td>
              <div class="truncate w-40">{{$row->alamat}}</div>
            </td>
            <td class="text-center">
              @php
                $count_user =$row->users()->count();
              @endphp
              <span @class(['text-error'=>$count_user < 1])>
                {{$count_user}}
              </span>
            </td>
          </tr>
        @endforeach
      </x-slot:tbody>
    </x-livewire.data>
  </div>
</div>
