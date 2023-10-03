<x-layouts.app title="Pemberitahuan">
  <div class="flex flex-col gap-6 w-full">

    <div class="flex flex-col gap-2">
      @if($pemberitahuan->count())
        @foreach($pemberitahuan as $row)
          @php
            if(!$row->read()){
                $row->markAsRead();
            }
          @endphp
          <div class="card bg-base-100 shadow-md">
            <div class="card-body p-4">
              <div
                class="text-sm italic badge badge-ghost text-md">{{\Carbon\Carbon::parse($row->data['time'])->translatedFormat('l, d M Y H:i')}}</div>

              <h2 class="font-semibold">{!! Str::markdown($row->data['title']??'') !!}</h2>
              <div class="border-l-4 pl-2 " x-init="editorViewer($el)">{!! $row->data['desc']??'' !!}</div>
            </div>
          </div>
        @endforeach
        {{$pemberitahuan->links()}}
      @else
        <div class="p-3">Belum ada pemberitahuan</div>
      @endif
    </div>

  </div>

</x-layouts.app>
