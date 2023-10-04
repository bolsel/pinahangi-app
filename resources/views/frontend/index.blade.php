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
  </div>
</x-layouts.frontend>
