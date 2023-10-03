@props(['label','value' => null])
<div {{$attributes->merge(['class'=>'flex flex-col border border-b-2 border-base-200 rounded-t-lg px-2 py-1'])}}>
    <div
            class="text-sm font-semibold">
        {{$label}} <span class="font-bold">:</span>
    </div>
    <div class="pl-1">{{$value ?? $slot}}</div>
</div>
