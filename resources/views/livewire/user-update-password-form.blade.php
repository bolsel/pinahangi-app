<x-livewire.form cancel-route="app.index" save-label="Update Password">
  <div class="flex flex-col gap-4">
    <x-livewire.form.input wire:model="password_lama" label="Password lama" required type="password"/>
    <x-livewire.form.input wire:model="password" label="Password baru" required type="password"/>
    <x-livewire.form.input wire:model="password_confirmation" label="Ulangi Password baru" required type="password"/>
  </div>
</x-livewire.form>
