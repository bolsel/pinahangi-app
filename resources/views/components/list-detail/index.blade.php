@props(['values'=>null])
<div {{$attributes}}>
  @if($values)
    @foreach($values as $row)
      @if($row)
        <x-list-detail.item :label="$row[0]" :value="$row[1]"/>
      @endif
    @endforeach
  @else
    {{$slot}}
  @endif
</div>
