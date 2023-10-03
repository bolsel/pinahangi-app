<x-layouts.app title="Telaah Permohonan">
    <div class="flex flex-col gap-6 w-full">

        <div class="bg-base-100 rounded-box">
            <div class="border-b p-4 text-lg font-semibold">Permohonan</div>
            <x-data.permohonan-detail :permohonan="$permohonan"/>
            <div class="border-y p-4 bg-secondary text-secondary-content flex items-center gap-2">
                <x-lucide-info class="w-6 h-6"/>
                Data Informasi Dari Organisasi
            </div>
            <div class="p-4 flex flex-col gap-4">
                <x-field-data label="Organisasi" :value="$permohonan->organisasi->nama"/>
                <x-field-data label="Informasi">
                    <div x-init="window.editorViewer($el)">{{$permohonan->informasi ?? "..."}}</div>
                </x-field-data>
                <x-field-data label="Dokumen">
                    <div class="flex flex-col gap-1 mt-3">
                        @foreach($permohonan->dataFiles as $file)
                            <div>
                                <a class="link link-hover break-words" target="_blank"
                                   href="{{$file->url}}">{{$file->name}}</a>
                            </div>
                        @endforeach
                    </div>
                </x-field-data>
            </div>

            <div class="border-y p-4 bg-secondary text-secondary-content flex items-center gap-2">
                <x-lucide-settings-2 class="w-6 h-6"/>
                Telaah
            </div>
            <div class="p-4">
                <livewire:permohonan-telaah-form :permohonan="$permohonan"/>
            </div>
        </div>

    </div>

</x-layouts.app>
