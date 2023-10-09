@php
  $_user = Auth::user();
@endphp
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> {{$title ? $title .' | '.config('app.name', 'PINAHANGI') : config('app.name', 'PINAHANGI')}}</title>
  <x-google-font font="inter"/>
  @livewireStyles
  @vite($viteAssets)
</head>
<body class="bg-base-200">
<div class="drawer lg:drawer-open ">
  <input id="drawer" type="checkbox" class="drawer-toggle">
  <div class="drawer-content flex flex-col min-h-screen">
    <div class="
  sticky top-0 z-30 flex h-16 w-full justify-center bg-opacity-90 backdrop-blur transition-all duration-100 bg-gradient-to-r from-primary to-secondary text-primary-content
  shadow-sm
  ">
      <nav class="navbar w-full ">
        <div class="flex flex-1 md:gap-1 lg:gap-2">
          <span
            class="tooltip tooltip-bottom before:text-xs before:content-[attr(data-tip)]" data-tip="Menu">
            <label
              aria-label="Open menu" for="drawer" class="btn btn-square btn-ghost drawer-button lg:hidden">
              <x-lucide-menu class="inline-block h-5 w-5 stroke-current md:h-6 md:w-6"/>
            </label>
          </span>
          <div class="w-full max-w-sm flex text-xl">
            {{$title}}
          </div>
        </div>
        <div class="flex-0">
          <div class="tooltip tooltip-bottom" data-tip="Pemberitahuan">
            <a href="{{route('app.pemberitahuan')}}" class="btn btn-ghost normal-case">
              <x-lucide-bell class="h-5 w-5 fill-current"/>
              @if($menus = $_user->unreadNotifications()->count())
                <div class="badge">{{$menus}}</div>
              @endif
            </a>
          </div>
          <div class="dropdown dropdown-end">
            <div tabindex="0" class="tooltip tooltip-bottom" data-tip="Akun">
              <button class="btn btn-ghost normal-case">
                <x-lucide-user class="h-5 w-5 fill-current"/>
              </button>
            </div>
            <div
              class="dropdown-content card card-compact bg-base-200 text-base-content rounded-t-box top-px mt-16 w-56 overflow-y-auto shadow">
              <div class="card-body border-b">
                <h3 class="card-title">{{$_user->name}}</h3>
                <p>{{$_user->email}}</p>
                @if(Gate::check('roleIsOrganisasi'))
                  <p>{{$_user->organisasi->nama}}</p>
                @endif
              </div>
              <ul class="menu gap-1" tabindex="0">
                @if(Gate::check('roleIsUser'))
                  <li>
                    <a href="{{route('app.pemohon-identitas-update')}}" class="flex gap-2">
                      <x-lucide-user class="w-4 h-4"/>
                      Update identitas
                    </a>
                  </li>
                @endif
                <li>
                  <a href="{{route('app.update-password')}}" class="flex gap-2">
                    <x-lucide-key class="w-4 h-4"/>
                    Ganti kata sandi
                  </a>
                </li>
                <li
                  x-data
                  @click.prevent="document.getElementById('logout-form').submit();"
                >
                  <button
                    class="flex gap-2"
                  >
                    <x-lucide-log-out class="w-4 h-4"/>
                    Keluar
                  </button>
                </li>
              </ul>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <div class="max-w-[100vw] flex-1 p-6 pb-16">
      @if (session('global-info'))
        <div class="alert alert-info shadow-lg mb-4" x-data="{ show: true }" x-show="show" x-transition>
          <div></div>
          <div>{{session('global-info')}}</div>
          <button class="btn btn-ghost btn-xs btn-circle" @click="show=false">
            <x-lucide-x class="w-4 h-4"/>
          </button>
        </div>
      @endif
      @isset($globalInformasi)
        <div x-data="{maximize:$persist(true).as('global-informasi-{{md5(Route::current()->getName())}}')}"
             class="w-full mb-5 bg-base-100 shadow-md rounded-b-box flex flex-col lg:flex-row gap- border-t-2 relative">
          <div class="flex flex-col lg:w-2/12">
            <div class="rounded-r-box py-2 inline-flex gap-2 justify-start items-center pl-3 group cursor-pointer"
                 @click="maximize = !maximize">
              <button class="btn btn-outline btn-sm btn-circle">
                <template x-if="!maximize">
                  <x-lucide-maximize title="Maximize" class="w-4 h-5"/>
                </template>
                <template x-if="maximize">
                  <x-lucide-minimize title="Minimalis" class="w-4 h-5"/>
                </template>
              </button>
              <span class="group-hover:underline">Informasi</span>
            </div>
            <div class="flex justify-center pb-0 lg:pb-3" x-show="maximize">
              <x-lucide-help-circle class="stroke-gray-400 w-10 h-10 lg:w-24 lg:h-24"/>
            </div>
          </div>
          <div class="p-5 flex-1" x-transition x-show="maximize">
            {{$globalInformasi}}
          </div>
        </div>
      @endisset
      {{$slot}}
    </div>
  </div>
  <div class="drawer-side z-40">
    <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
    <aside class="bg-base-100 w-80 border-r h-full">
      <div
        class="flex flex-col sticky top-0 z-20 items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur shadow-sm">
        <a href="{{route('app.index')}}" class="flex items-center gap-2">
          <img alt="logo" src="{{URL::to('/images/logo.png')}}" class="w-8"/>
          <div class="flex flex-col items-start">
            <div
              class="font-intro text-3xl text-primary font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-secondary to-primary"> {{config('app.name')}}</div>
          </div>
        </a>
        <div class="hidden lg:flex text-center">{{config('app.name_full')}}</div>
      </div>

      <div class="h-4"></div>
      <x-side-menu-list/>
    </aside>
  </div>

</div>
@livewireScriptConfig
</body>
</html>
