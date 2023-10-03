<x-livewire.form cancel-route="app.organisasi.user">
  <div class="flex flex-col gap-4 max-w-lg">
    <x-livewire.form.input wire:model="email" label="Email" required/>
    <x-livewire.form.input wire:model="name" label="Nama" required/>
    <x-livewire.form.input wire:model="organisasi_id" label="Organisasi"
                           :select-items="\App\Models\Organisasi::selectOptionValues()"/>
    <x-livewire.form.input wire:model="password" label="Password" type="password" :required="$current===null"/>

  </div>
</x-livewire.form>
