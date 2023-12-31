<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include('meta-tags')
  <title>{{$title}}</title>
  <x-google-font font="raleway"/>
  @vite(['resources/css/auth.scss', 'resources/js/auth.js'])
</head>
<body>
<div class="main-auth">
  <div class="main-auth__side">
    <div class="absolute bg-gradient-to-b from-secondary to-primary opacity-75 inset-0 z-0"></div>
    <a href="{{route('frontend.index')}}" class="w-full side-logo  z-10 flex flex-col items-center">
      <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6 font-intro p-36">
        <img class="w-full" src="{{URL::to('/images/pinahangi.png')}}"/>
      </div>
    </a>
    <ul class="circles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>
  <div class="main-auth__content">
    <div class="content">
      {{$slot}}
    </div>
  </div>
</div>
</body>
</html>
