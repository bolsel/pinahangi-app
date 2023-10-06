@props(['values'=>null, 'title'=>null, 'mergeSlot'=>true])
<div {{$attributes}}>
  @if($title)
    <div class="border-b-2 border-primary/60 text-lg font-bold px-4 py-2">{{$title}}</div>
  @endif
  @if($values)
    @foreach($values as $row)
      @if($row)
        <x-list-detail.item :label="$row[0]" :value="$row[1]"/>
      @endif
    @endforeach
    @if($mergeSlot)
      {{$slot}}
    @endif
  @else
    {{$slot}}
  @endif
</div>
