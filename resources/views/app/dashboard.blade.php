<x-layouts.app title="Dashboard" :vite-assets="['resources/js/chart.js']">
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
