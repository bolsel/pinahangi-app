@props(['value', 'noHumans'=>false])
<div class="flex flex-col">
  <div>{{$value ? $value->translatedFormat('l, d M Y H:i') : '-'}}</div>
  @if($value && !$noHumans)
    <div>({{$value->diffForHumans()}})</div>
  @endif
</div>
