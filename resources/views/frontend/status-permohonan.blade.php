<x-layouts.frontend title="Status Permohonan">
  @if($permohonan)
    @php
      $pemohon = $permohonan->pemohon;
    @endphp

    <x-slot:afterTitle>
      <div class="text-center">
        <span class="font-bold badge badge-lg">Nomor: {{$permohonan->nomor}}</span>
        <span class="font-bold badge badge-lg uppercase gap-2">
          <x-lucide-history
                  class="w-3 h-3 text-gray-500"/>
          {{$permohonan->status}}
        </span>
      </div>
    </x-slot:afterTitle>
    <div class="flex flex-col gap-4">
      <div class="bg-base-100 rounded-box p-3">
        <x-data.permohonan-detail :permohonan="$permohonan"/>
      </div>

      <div class="bg-base-100 rounded-box shadow-sm">
        <div class="border-b p-4 text-lg font-semibold">Trace Permohonan</div>
        <x-data.permohonan-trace :permohonan="$permohonan"/>
      </div>
    </div>
  @else
    <div class="bg-base-100 rounded-box shadow-lg p-6 max-w-xl mx-auto">
      <form action="{{route('frontend.status-permohonan')}}" method="post" class="flex gap-4 flex-col">
        @csrf
        <label for="nomor_permohonan" class="text-lg font-bold">Masukan nomor permohnan</label>
        <input
                id="nomor_permohonan"
                name="nomor_permohonan" type="text" class="input peer bg-base-200"
                placeholder="xxxxxx-xxxxxxx" required/>
        <button class="btn btn-primary normal-case">
          <x-lucide-search class="h-6 w-6"/>
          Lacak Permohonan
        </button>
        @error('nomor_permohonan')
        <div class="text-error">{{$message}}</div> @enderror
      </form>
    </div>
  @endif

</x-layouts.frontend>
