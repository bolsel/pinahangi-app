@props([
    'data',
    'canDelete'=>true,
    'canSearch'=>true,
    'topleft'
])

<div class="flex flex-col relative w-full h-full" x-data="{deleteId:null}">
  <div class="flex justify-between p-4">
    <div class="w-3/6">
      @isset($topleft)
        {{$topleft}}
      @endisset
    </div>
    <div class="w-3/6 flex justify-end">
      @if($canSearch)
        <input wire:model.live.debounce.250ms="search_query" placeholder="Cari data"
               class="w-full max-w-lg input input-sm input-bordered"/>
      @endif
    </div>
  </div>
  @if (session('status'))
    <div class="toast toast-top toast-center absolute z-20" x-data="{ show: true }" x-show="show"
         x-init="setTimeout(() => show = false, 3000)" x-transition>
      <div class="alert alert-success">
        <div>{{ session('status') }}</div>
        <button class="btn btn-ghost btn-xs btn-circle" @click="show=false">
          <x-lucide-x class="w-4 h-4"/>
        </button>
      </div>
    </div>
  @endif

  @if($canDelete)
    <div class="absolute w-full h-full bg-base-300 bg-opacity-50 z-10"
         x-show="deleteId" x-transition
    >
    </div>
    <div class="absolute w-full h-full z-10"
         x-show="deleteId"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90">
      <div class="flex justify-center items-center w-full h-full">
        <div class="card w-96 shadow-xl bg-base-100">
          <div class="card-body items-center text-center">
            <h2 class="card-title">Hapus Item</h2>
            <p>Hapus item yang dipilih?</p>
            <div class="card-actions justify-end">
              <button class="btn btn-sm btn-error" wire:click.prevent="doHapusItem(deleteId)">Ya Hapus</button>
              <button class="btn btn-sm btn-ghost" @click="deleteId=null">Batal</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
  <div class="hidden absolute w-full h-full bg-base-200 bg-opacity-50 z-10" wire:loading.class.remove="hidden">
    <div class="flex justify-center items-center w-full h-full">
      <x-lucide-loader-2
        class="animate-spin w-24 h-24 text-base-300"/>
    </div>
  </div>
  <div class="overflow-x-auto w-full">
    <table class="table table-hover border-y">
      <thead>
      {{$thead}}
      </thead>
      <tbody>
      {{$tbody}}
      </tbody>
    </table>
  </div>
  @if($data instanceof \Illuminate\Contracts\Pagination\Paginator)
    <div class="p-3">
      {{ $data->links() }}
    </div>
  @endif

</div>

