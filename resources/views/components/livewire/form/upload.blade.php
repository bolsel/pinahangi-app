@props(['id','name','file'])
@php
  $hide = $file['hideUpload'] ?? false;
@endphp
<div class="f-input peer @error($name) border-error focus:border-error @enderror">
  <div class="bg-base-100 rounded-box" x-data="drop_file_component('{{$name}}', $wire)">
    <div class="flex flex-col w-full">
      @isset($file['ket'])
        <div class="text-sm text-gray-600 mt-2">{{$file['ket']}}</div>
      @endisset
      {{$slot}}
      @if(isset($file['currentUrl']))
        <div class="mt-4">
          <a target="_blank" href="{{$file['currentUrl']}}"
             class="btn btn-sm btn-primary btn-outline normal-case">Lihat file</a>
        </div>
      @endif
      @if(!$hide)
        <label
          class="mt-4 flex flex-col w-full rounded-lg border-2 border-gray-200 hover:border-gray-300 border-dashed cursor-pointer relative"
          x-bind:class="isDropping ? 'bg-gray-200' : ''"
          x-on:drop="isDropping = false"
          x-on:drop.prevent="handleFileDrop($event)"
          x-on:dragover.prevent="isDropping = true"
          x-on:dragleave.prevent="isDropping = false">
          <input id="{{$id}}" @change="handleFileSelect" type="file" class="hidden"/>
          <div class="flex flex-row items-center">
            <div class="px-5">
              <x-lucide-upload class="w-6 h-6 text-gray-400"/>
            </div>
            <div class="p-3 text-gray-400 hover:text-gray-500">
              <p class="mb-1 text-sm "><span
                  class="font-semibold">Klik untuk memilih berkas</span> <em>atau drop file
                  kesini (max drop 1 file)</em>.
              </p>
              <p class="text-xs">
                @if(isset($file['mimes']) && $file['mimes'])
                  {{str($file['mimes'])->upper()->toString()}}
                @endif

                @if(isset($file['maxSize']) && $file['maxSize'])
                  (max: {{$file['maxSize']}}Kb  )
                @endif
              </p>
            </div>
          </div>
          <div class="rounded-full border border-gray-200 h-4 w-1/2 mb-2"
               x-show="isUploading">
            <div
              class="rounded-full text-xs h-full bg-primary text-white text-center"
              style="transition: width 1s"
              :style="`width: ${progress}%;`"
              x-html="`${progress}%`"
            ></div>
          </div>
        </label>
      @endif
    </div>
  </div>
</div>
