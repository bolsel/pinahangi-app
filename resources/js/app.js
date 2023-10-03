import {Livewire, Alpine} from '../../vendor/livewire/livewire/dist/livewire.esm';
import {dropFileComponent} from "./lib/drop-file-component";
import './editor';

Alpine.data('drop_file_component', dropFileComponent);

Livewire.start()
