@props(['pemohon'])
<div {{$attributes->merge(['class'=>'flex flex-col gap-4'])}}>
  <x-field-data label="Email Pemohon" :value="$pemohon->user->email"/>
  <x-field-data label="Nama Lengkap Pemohon" :value="$pemohon->nama"/>
  <x-field-data label="Nomor HP Pemohon" :value="$pemohon->nohp"/>
  <x-field-data label="Alamat lengkap Pemohon" :value="$pemohon->alamat"/>
  @if($pemohon->ktp)
    <x-field-data label="Scan KTP">
      <div class="overflow-auto h-48 w-full my-2">
        <a href="{{$pemohon->ktp->url}}" target="_blank" class="h-full w-full ">
          <img class="rounded-lg" src="{{$pemohon->ktp->url}}"/>
        </a>
      </div>
    </x-field-data>
  @endif
</div>
