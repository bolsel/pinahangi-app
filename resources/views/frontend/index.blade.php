<x-layouts.frontend :title="config('app.name_full')" is-home>
  <div class="flex flex-col gap-8">
    <div class="bg-base-100 w-full rounded-box shadow-md p-5">
      <div class="text-2xl font-bold mb-4">
        <span class="title-gradient-border">Maklumat Pelayanan</span>
      </div>
      <div class="text-lg text-justify">
        "Dengan Ini Kami Menyatakan Sanggup Menyelenggarakan Pelayanan Sesuai Standar Pelayanan Yang Telah Ditetapkan
        Dan
        Apabila Tidak Menepati Janji Ini, Maka Kami Siap Menerima Sanksi Sesuai Peraturan Perundang - Undangan Yang
        Berlaku"
      </div>
    </div>
    <div class="bg-base-100 w-full rounded-box shadow-md p-5">
      <div class="text-2xl font-bold mb-4">
        <span class="title-gradient-border">Formulir</span>
      </div>
      <div class="mt-10 flex flex-col gap-8" x-data="{jenis:1}">
        <div class="w-full">
          <ul class="menu menu-horizontal bg-base-200 bg-opacity-40 rounded-box gap-1">
            <li class="menu-title">Jenis Permohonan</li>

            <li><a :class="{'bg-base-300':jenis===1}" @click="jenis=1">Perorangan</a></li>
            <li><a :class="{'bg-base-300':jenis===2}" @click="jenis=2">Badan Hukum</a></li>
            <li><a :class="{'bg-base-300':jenis===3}" @click="jenis=3">Kelompok/Organinsasi</a></li>
          </ul>

          <div class="p-5">
            <ul class="list-decimal">
              <li>Nama Lengkap</li>
              <li>Alamat Lengkap</li>
              <li>Nomor HP</li>
              <li>Scan KTP <i>(berkas)</i></li>
              <li x-show="jenis===2" x-transition>Nama Badan Hukum</li>
              <li x-show="jenis===2" x-transition>Alamat Badan Hukum</li>
              <li x-show="jenis===2" x-transition>
                Scan Akta pendirian badan hukum yang telah mendapatkan pengesahan dari Kemenkumham <i>(berkas)</i>
              </li>
              <li x-show="jenis===3" x-transition>Nama Kelompok/Organisasi</li>
              <li x-show="jenis===3" x-transition>Alamat Kelompok/Organisasi</li>
              <li x-show="jenis===3" x-transition>
                Scan Surat kuasa khusus dari pemberi kuasa dan penerima kuasa <i>(berkas)</i>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-base-100 w-full rounded-box shadow-md p-5">
      <div class="text-2xl font-bold mb-4">
        <span class="title-gradient-border">Install Aplikasi</span>
      </div>
      <div class="flex flex-col" x-data="{activePlatform:1}">
        <div class="tabs tabs-boxed">
          <a class="tab" :class="{'tab-active':activePlatform===1}" @click="activePlatform=1">Android</a>
          <a class="tab" :class="{'tab-active':activePlatform===2}" @click="activePlatform=2">iOS</a>
          <a class="tab" :class="{'tab-active':activePlatform===3}" @click="activePlatform=3">Desktop</a>
        </div>
        <div class="p-4">
          <ul class="list-disc" x-show="activePlatform===1" x-transition>
            <li>Buka web <strong>{{config('app.name')}}</strong>.</li>
            <li>
              <p>Klik tombol 3 titik pada kanan atas</p>
              <img class="m-4 rounded-lg max-w-sm" src="{{URL::to('/images/install-android.jpeg')}}" loading="lazy"/>
            </li>
            <li>
              <p>Klik install aplikasi.</p>
              <img class="m-4 rounded-lg max-w-sm" src="{{URL::to('/images/install-android-2.jpeg')}}" loading="lazy"/>
            </li>
          </ul>
          <ul class="list-disc" x-show="activePlatform===2" x-transition>
            <li>Buka web <strong>{{config('app.name')}}</strong>.</li>

            <li>
              <p>Klik icon share</p>
              <img class="m-4 rounded-lg max-w-sm" src="{{URL::to('/images/install-ios.jpeg')}}" loading="lazy"/>
            </li>
            <li>
              <p>Pilih Add to Home Screen.</p>
              <img class="m-4 rounded-lg max-w-sm" src="{{URL::to('/images/install-ios-2.jpeg')}}" loading="lazy"/>
            </li>
          </ul>
          <ul class="list-disc" x-show="activePlatform===3" x-transition>
            <li>Buka web <strong>{{config('app.name')}}</strong>.</li>
            <li>
              <p>Klik tombol install button pada address bar browser, kemudian klik Install.</p>
              <img class="m-4 rounded-lg" src="{{URL::to('/images/install-desktop.jpeg')}}" loading="lazy"/>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-layouts.frontend>
