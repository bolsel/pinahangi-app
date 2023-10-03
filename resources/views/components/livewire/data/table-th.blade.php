@props([
    'field','sortable'
])
@php
  $isSortable = isset($sortable);
@endphp
<th
  @if($isSortable) wire:click="setFilterSort('{{$field}}')" @endif
  {{$attributes->merge(['class'=>'group'])}}
>
  <div class="flex gap-2">
    <span>{{$slot}}</span>
    @if($isSortable)
      <span class="w-4 h-4 tooltip tooltip-bottom" data-tip="Sort">
      @if(ltrim($this->filterSort, '-') === $field)
          @if($this->isFilterSortDesc())
            <x-lucide-sort-desc class="w-4 h-4"/>
          @else
            <x-lucide-sort-asc class="w-4 h-4"/>
          @endif
        @else
          <x-lucide-sort-asc class="hidden group-hover:block w-4 h-4"/>
        @endif
    </span>
    @endif
  </div>
</th>
