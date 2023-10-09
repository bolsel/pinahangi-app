<div class="flex flex-col gap-6 w-full">
  <x-slot:global-informasi>
    <ul class="list-disc">
      <li>Role <strong>Superuser</strong> dapat mengelola semua data. Termasuk juga dapat melakukan verifikasi dan
        telaah permohonan.
      </li>
      <li>Role <strong>Verifikasi</strong> dapat melakukan verifikasi permohonan.
      <li>Role <strong>Telaah</strong> dapat melakukan telaah permohonan.
      </li>
      <li>Email user harus email aktif. Agar dapat menerima pemberitahuan mengenai aktifitas permohonan.</li>
    </ul>
  </x-slot:global-informasi>
  <div class="bg-base-100 rounded-box">

    <x-livewire.data :data="$data">

      <x-slot:topleft>
        <a href="{{route('app.users.form')}}" wire:navigate class="btn btn-sm btn-primary">Tambah</a>
      </x-slot:topleft>
      <x-slot:thead>
        <tr class="">
          <th class=""></th>
          <th class="w-1 text-right">#</th>
          <x-livewire.data.table-th field="email" sortable>EMAIL</x-livewire.data.table-th>
          <x-livewire.data.table-th field="name" sortable>NAMA</x-livewire.data.table-th>
          <x-livewire.data.table-th field="role" sortable>ROLE</x-livewire.data.table-th>
        </tr>
      </x-slot:thead>
      <x-slot:tbody>
        @foreach($data as $row)
          <tr>
            <x-livewire.data.table-td-action :id="$row->id" update-route="app.users.form"/>
            <td class="text-right">{{$data->firstItem() + $loop->index}}</td>
            <td class="w-1 whitespace-nowrap">{{$row->email}}</td>
            <td class="w-96">{{$row->name}}</td>
            <td class="w-96">{{\App\Livewire\SystemUser::ROLE_LIST[$row->role] ?? $row->role}}</td>
          </tr>
        @endforeach
      </x-slot:tbody>
    </x-livewire.data>
  </div>
</div>
