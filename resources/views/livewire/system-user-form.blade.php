<x-livewire.form cancel-route="app.users.index">
  <div class="flex flex-col gap-4 max-w-lg">
    <x-livewire.form.input wire:model="email" label="Email" required/>
    <x-livewire.form.input wire:model="name" label="Nama" required/>
    <x-livewire.form.input wire:model="role" label="Role" :select-items="$role_list"/>
    <x-livewire.form.input wire:model="password" label="Password" type="password" :required="$current===null"/>

  </div>
</x-livewire.form>
