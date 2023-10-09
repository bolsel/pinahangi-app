<ul class="menu px-4 py-0">
  <li>
    <a href="{{route('app.index')}}">
            <span>
              <x-lucide-home class="w-6 h-6 stroke-current"/>
            </span>
      <span class="">Dashboard</span>
    </a>
  </li>
  @php
    $menus = collect();
    if(Gate::check('su')){
        $menus->push(
            'Data',
            ['label'=>'Organisasi','route'=>route('app.organisasi.index'), 'icon'=> svg('lucide-building','w-6 h-6 stroke-current')],
            ['label'=>'Pemohon','route'=>route('app.pemohon.index'), 'icon'=> svg('lucide-user', 'w-6 h-6 stroke-current')],
            'User',
            ['label'=>'System User','route'=>route('app.users.index'), 'icon'=> svg('lucide-building','w-6 h-6 stroke-current')],
            ['label'=>'Organisasi User','route'=>route('app.organisasi.user'), 'icon'=> svg('lucide-building','w-6 h-6 stroke-current')],
        );
    }elseif (Gate::check('roleIsUser')){
        $menus->push(['label'=>'Permohonan Informasi', 'route'=>route('app.permohonan.index'), 'icon'=> svg('lucide-file-text','w-6 h-6 stroke-current')]);
    }
    if(Gate::check('permohonan.index')){
        if(!$menus->values()->contains('Permohonan')){
            $menus->push('Permohonan');
        }
        $menus->push(['label'=>'Semua Permohonan','route'=>route('app.permohonan.index'), 'icon'=> svg('lucide-file-text','w-6 h-6 stroke-current')]);
    }
    if(Gate::check('permohonan.verifikasi')){
        if(!$menus->values()->contains('Permohonan')){
            $menus->push('Permohonan');
        }
        $menus->push(['label'=>'Verifikasi Permohonan','route'=>route('app.permohonan.verifikasi-list'), 'icon'=> svg('lucide-file-text','w-6 h-6 stroke-current'),
            'badge'=>\App\Models\Permohonan::countStatusVerifikasi()]);
    }
    if(Gate::check('permohonan.prosess')){
        if(!$menus->values()->contains('Permohonan')){
            $menus->push('Permohonan');
        }
        $menus->push(
            ['label'=>'Proses Permohonan','route'=>route('app.permohonan.proses-list'), 'icon'=> svg('lucide-file-text','w-6 h-6 stroke-current'),
          'badge'=>\App\Models\Permohonan::countStatusProses()],
          ['label'=>'Perbaiki Permohonan','route'=>route('app.permohonan.perbaiki-list'), 'icon'=> svg('lucide-file-text','w-6 h-6 stroke-current'),
          'badge'=>\App\Models\Permohonan::countStatusPerbaiki()]
          );
    }

    if(Gate::check('permohonan.telaah')){
        if(!$menus->values()->contains('Permohonan')){
            $menus->push('Permohonan');
        }
        $menus->push(
            ['label'=>'Telaah Permohonan','route'=>route('app.permohonan.telaah-list'), 'icon'=> svg('lucide-file-text','w-6 h-6 stroke-current'),
          'badge'=>\App\Models\Permohonan::countStatusTelaah()]
          );
    }
  @endphp
  @if(Gate::check('roleIsUser'))
    <li>
      <a
              href="{{route('app.pemohon-identitas-update')}}" wire:navigate>
        <span>
          <x-lucide-user class="w-6 h-6 stroke-current"/>
        </span>
        <div class="">
          Update Identitas
          @if(!Auth::user()->pemohon->identitas_lengkap)
            <div class="text-xs italic text-error">Belum lengkap</div>
          @endif
        </div>
      </a>
    </li>
  @endif
  @foreach($menus as $menu)
    @if(is_string($menu))
      <li></li>
      <li class="menu-title flex flex-row gap-4"><span>{{$menu}}</span></li>
    @else
      <li>
        <a href="{{$menu['route']}}" wire:navigate>
                <span>
                  {{$menu['icon']}}
                </span>
          <span class="">{{$menu['label']}}</span>
          @if(isset($menu['badge']) && $menu['badge'])
            <span class="badge badge-primary badge-sm">{{$menu['badge']}}</span>
          @endif
        </a>
      </li>
    @endif
  @endforeach
</ul>
