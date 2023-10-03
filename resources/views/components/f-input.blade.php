@props([
    'name', 'label','select-items','value'
])
@php
  $isRequired = $attributes->get('required', false);
  $isDisabled = $attributes->get('disabled', false);
  $currentValue = $attributes->get('value', isset($this) && method_exists($this,'currentValue') ? $this->currentValue($name) : '');
@endphp

<div
  class="{{$attributes->class('relative')->get('class')}}" {{$attributes->except(['select-items','label','name','class','required'])}}>
  @if($attributes->get('select-items'))
    <select wire:model="{{$name}}" type="text" id="{{$name}}" name="{{$name}}"
            class="f-input peer @error($name) border-error focus:border-error @enderror"
            placeholder=" "
            value="{{ $currentValue }}"
            @if($isRequired) required @endif
    >
      @if($attributes->get('select-pilih-item',true))
        <option value="">Pilih Item</option>
      @endif
      @if(is_array($attributes->get('select-items')))
        @foreach($attributes->get('select-items') as $key => $item)
          <option @if($key === $currentValue) selected @endif value="{{$key}}">
            {{ $item }}
          </option>
        @endforeach
      @else
        @foreach($attributes->get('select-items') as $item)
          <option value="{{$item->id }}">
            {{ $item->{$attributes->get('select-item-option-label', 'id')} }}
          </option>
        @endforeach
      @endif
    </select>
  @elseif($attributes->get('textarea'))
    <textarea wire:model="{{$name}}" id="{{$name}}" name="{{$name}}"
              class="f-input peer @error($name) border-error focus:border-error @enderror"
              placeholder=" "
              @if($isRequired) required @endif
    >{{ $currentValue }}</textarea>
  @else
    <input wire:model="{{$name}}" type="{{$attributes->get('type','text')}}" id="{{$name}}" name="{{$name}}"
           class="f-input peer @error($name) border-error focus:border-error @enderror"
           placeholder=" "
           value="{{ $currentValue }}"
           @if($isRequired) required @endif
           @if($isDisabled) disabled title="Field ({{$label}}) tidak dapat diedit" @endif
      {{$attributes}}
    />
  @endif
  <label for="{{$name}}" class="f-input-label">{{$label}}{{$isRequired ? ' *':''}}</label>
  @error($name) <span class="text-error">{{ $message }}</span> @enderror
</div>
