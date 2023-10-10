@props([
  'title',
  'afterTitle',
  'isHome'=>false
])
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#2563eb">
  <link rel="manifest" href="{{URL::to('/manifest.json')}}">
  <title>{{$title}}</title>
  <x-google-font font="raleway"/>
  @vite(['resources/css/frontend.scss', 'resources/js/frontend.js'])
</head>
<body x-data="front_home" @scroll.window="function(){scrollWatch(this)}">
<div class="main-front">
  <div class="min-h-screen flex flex-col" style="">
    <div id="navbar-wrapper" x-ref="navWrapper" class="navbar-wrapper">
      <nav class="navbar max-w-6xl">
        <div class="flex-1 md:gap-1 lg:gap-2 h-full">
          <a href="{{route('frontend.index')}}" class="h-full flex gap-2">
            <img src="{{URL::to('images/logo.png')}}" class="h-full"/>
            <div class="h-full flex items-center">
              <div class="flex flex-col leading-none">
                <div class="">
                  PEMERINTAH KABUPATEN
                </div>
                <div>BOLAANG MONGONDOW SELATAN</div>
              </div>
            </div>
          </a>
        </div>
        <div class="flex-0">
          <div class="items-center flex-none">
            <a href="{{route('login')}}"
               class="btn btn-xs lg:btn-md btn-ghost drawer-button normal-case">
              <x-lucide-user class="inline-block h-6 w-6 fill-current md:mr-2"/>
              <span class="hidden lg:block">Masuk</span>
            </a>
          </div>
        </div>
      </nav>
    </div>
    @if($isHome)
      <div
        class="from-primary to-secondary text-primary-content -mt-[4rem] grid grid-flow-row-dense place-items-center items-end bg-gradient-to-br pt-20">
        <div
          class="hero-content col-start-1 row-start-1 w-full max-w-6xl flex-col justify-between gap-10 pb-40 lg:flex-row lg:items-end lg:gap-0 xl:gap-20">
          <div class="lg:pb-20 order-last lg:order-first">
            <div class="mb-2 py-4 text-center lg:py-10 lg:text-left">
              <h1
                class="font-title mb-4 text-4xl font-extrabold sm:text-5xl lg:text-6xl drop-shadow-[3px_3px_1px_#844ba3]">
                PINAHANGI</h1>
              <h2
                class="font-title text-2xl font-bold sm:text-3xl lg:text-4xl">
                Aplikasi Informasi
              </h2>
              <h2 class="font-title text-xl font-bold sm:text-2xl lg:text-3xl">
                Humas dan Digitalisasi Informasi
              </h2>
            </div>
            <div class="mt-4 flex flex-1 justify-center space-x-2 lg:mt-6 lg:justify-start">
              <a href="{{route('frontend.status-permohonan')}}"
                 class="btn btn-ghost btn-active lg:btn-md normal-case"><span
                  class="inline">Lacak Permohonan</span>
              </a>
              <a
                href="{{route('register')}}" class="btn normal-case">Permohonan Informasi</a>
            </div>
          </div>
          <div class="lg:pb-20">
            <div class="w-full">
              <div>
                <div class="flex justify-center opacity-80 rounded-xl">
                  <div class="w-56 lg:w-72 rounded-xl">
                    <img class="drop-shadow-[0_1px_3px_#fff]" src="{{URL::to('images/pejabat.png')}}"/>
                  </div>
                </div>
                <div class="mb-2 text-center italic leading-4">
                  {{--                <h2 class="font-title text-lg font-extrabold sm:text-xl lg:text-2xl leading-4 block lg:hidden">--}}
                  {{--                  Pemerintah Kabupaten<br/>Bolaang Mongondow Selatan--}}
                  {{--                </h2>--}}
                  {{--                <div class="font-title text-lg font-bold sm:text-xl lg:text-2xl leading-4 mt-2 block lg:hidden">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</div>--}}
                </div>
                {{--              <img class="drop-shadow-xl" src="https://si-pinter.bolselkab.go.id/statics/images/sp.bupati.png"/>--}}
              </div>
            </div>
          </div>
        </div>
        <svg class="fill-secondary col-start-1 row-start-1 h-auto w-full" width="1600" height="595"
             viewBox="0 0 1600 595" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            style="fill-opacity:0.4;fill:red"
            d="M0 338L53.3 349.2C106.7 360.3 213.3 382.7 320 393.8C426.7 405 533.3 405 640 359.3C746.7 313.7 853.3 222.3 960 189.2C1066.7 156 1173.3 181 1280 159.2C1386.7 137.3 1493.3 68.7 1546.7 34.3L1600 0V595H1546.7C1493.3 595 1386.7 595 1280 595C1173.3 595 1066.7 595 960 595C853.3 595 746.7 595 640 595C533.3 595 426.7 595 320 595C213.3 595 106.7 595 53.3 595H0V338Z"></path>
        </svg>
      </div>
    @else
      <div
        class="from-primary to-secondary text-primary-content -mt-[4rem] grid place-items-center items-end bg-gradient-to-br pt-20">
        <div class="text-center pb-24 lg:gap-0 xl:gap-20">
          <div class="mb-2 py-4 text-center lg:py-10 lg:text-left">
            <h1
              class="font-title px-6 mb-2 text-2xl font-extrabold md:text-3xl lg:text-4xl max-w-4xl text-center">{{$title}}</h1>
            @isset($afterTitle)
              {{$afterTitle}}
            @endisset
          </div>
        </div>
      </div>
    @endif
    <div class="flex-1 bg-base-200 flex flex-col items-center gap-20 py-20 px-5">
      <div
        class="flex-1 text-base-content glass rounded-xl xl:rounded-box -mt-48 w-full max-w-6xl bg-opacity-60 p-5 pt-10">
        {{$slot}}
      </div>
    </div>
    <footer
      class="footer footer-center bg-base-200 text-base-content border-t-4 border-base-300 px-4 pt-4 pb-5">
      &copy; 2023 Dinas Komunikasi dan Informatika Kabupaten Bolaang Mongondow Selatan
    </footer>
  </div>
</div>
</body>
</html>
