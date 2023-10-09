<x-layouts.app title="Dashboard" :vite-assets="['resources/js/chart.js']">
  @if(Gate::check('su'))
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5 m-auto">
      <div class="bg-base-100 shadow-md p-3 rounded-box flex justify-center items-center">
        <div class="flex-1 flex flex-col">
          <div class="italic">Total Organisasi</div>
          <div class="font-semibold">{{\App\Models\Organisasi::count('id')}}</div>
        </div>
        <x-lucide-building class="text-gray-400 w-8 h-8"/>
      </div>
      <div class="bg-base-100 shadow-md p-3 rounded-box flex justify-center items-center">
        <div class="flex-1 flex flex-col">
          <div class="italic">Total Pemohon</div>
          <div class="font-semibold">{{\App\Models\Pemohon::count('id')}}</div>
        </div>
        <x-lucide-users class="text-gray-400 w-8 h-8"/>
      </div>
      <div class="bg-base-100 shadow-md p-3 rounded-box flex justify-center items-center">
        <div class="flex-1 flex flex-col">
          <div class="italic">Total Permohonan</div>
          <div class="font-semibold">{{\App\Models\Permohonan::count('id')}}</div>
        </div>
        <x-lucide-file class="text-gray-400 w-8 h-8"/>
      </div>
    </div>
  @endif
  <div class="flex flex-col gap-4">
    <div class="bg-base-100 shadow-md rounded-box">
      <div class="border-b p-4 text-lg font-semibold">Permohonan Menurut Status</div>
      <div class="p-4 flex flex-col md:flex-row gap-4 items-center justify-center">
        <div class="h-60 max-w-lg flex">
          <canvas x-init="ChartPieWithLegend($el, @js($chartDataPermohonanStatus),'legend-container')">
          </canvas>
        </div>
        <div class="w-full md:max-w-sm">
          <div id="legend-container" class="w-full"></div>
        </div>
      </div>
    </div>
    @if($chartKepuasanCount)
      <div class="bg-base-100 shadow-md rounded-box">
        <div class="border-b p-4 text-lg font-semibold">Kepuasan</div>
        <div class="p-4 flex flex-col md:flex-row gap-4 items-center justify-center">
          <div class="h-60 max-w-lg flex">
            <canvas x-init="ChartPieWithLegend($el, @js($chartKepuasanCount),'legend-container2')">
            </canvas>
          </div>
          <div class="w-full md:max-w-sm">
            <div id="legend-container2" class="w-full"></div>
          </div>
        </div>
      </div>
    @endif
  </div>

</x-layouts.app>
