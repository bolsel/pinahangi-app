@props(['label', 'value'=>null])
<div class="flex flex-col border-b lg:flex-row py-2 lg:items-center lg:justify-center">
  <div class="px-2 italic font-semibold lg:w-5/12 lg:text-right">{{$label}}</div>
  <div class="hidden lg:block lg:mx-1">:</div>
  <div class="ml-5 lg:ml-0 lg:w-7/12">
    {{$value ?? $slot}}
  </div>
</div>
