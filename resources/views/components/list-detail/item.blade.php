@props(['label', 'value'=>null, 'noBorder'=>false])
<div @class(["flex flex-col lg:flex-row py-2 lg:items-start lg:justify-center", 'border-b' =>!$noBorder])>
  <div class="px-2 italic font-semibold lg:w-4/12 lg:text-right">{{$label}}</div>
  <div class="hidden lg:block lg:mx-1">:</div>
  <div class="ml-5 lg:ml-0 lg:w-8/12">
    {{$value ?? $slot}}
  </div>
</div>
