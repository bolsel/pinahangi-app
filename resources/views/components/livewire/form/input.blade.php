@props([
    'label',
    'selectItems',
    'required'=>false,
    'textarea'=>false,
    'file'=>false,
    'editor'=>false,
    'attrs'=>[],
    'ket',
])
@php
  $name = $attributes->wire('model')->value();
  $id = 'wire-input-'.$name;
  $currentValue = $attributes->get('value', isset($this) && method_exists($this,'currentValue') ? $this->currentValue($name) : '');
@endphp
<div
  class="{{$attributes->class('relative')->get('class')}}">
  @if(isset($selectItems) && is_array($selectItems))
    <select
      id="{{$id}}"
      class="f-input peer @error($name) border-error focus:border-error @enderror"
      placeholder=" "
      aria-label="{{$name}}"
      {{$attributes}}
    >
      <option value="">Pilih {{$label}}</option>
      @foreach($selectItems as $key => $item)
        <option value="{{$key}}">
          {{ $item }}
        </option>
      @endforeach
    </select>
  @elseif($file !== false)
    <x-livewire.form.upload :id="$id" :name="$name" :file="$file" {{$attributes}}>{{$slot}}</x-livewire.form.upload>
  @elseif($editor !== false)
    <x-livewire.form.editor :id="$id" :name="$name" :label="$label" :editor="$editor" {{$attributes}}/>
  @elseif($textarea)
    <textarea
      id="{{$id}}"
      aria-label="{{$name}}"
      class="f-input peer @error($name) border-error focus:border-error @enderror"
      placeholder=" "
      {{$attributes}}
    >{{$attributes->get('value','')}}</textarea>
  @else
    <input
      type="{{$attributes->get('type','text')}}"
      id="{{$id}}"
      class="f-input peer @error($name) border-error focus:border-error @enderror"
      placeholder=" "
      @if($attributes->has('disabled')) title="Field ({{$label}}) tidak dapat diedit" @endif
      {{$attributes}}
    />
  @endif
  <label
    for="{{$id}}" @class(['f-input-label', '!text-lg'=>$file!==false||$editor!==false])>{{$label}}{{$required ? '*':''}}</label>
  @isset($ket)
    <div class="text-sm text-gray-500">{{$ket}}</div>
  @endisset
  @error($name) <span class="text-error text-sm">{{ Str::replace($name,$label,$message) }}</span> @enderror
</div>
