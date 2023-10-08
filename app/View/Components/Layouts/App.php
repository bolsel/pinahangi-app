<?php

namespace App\View\Components\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public $title = '';
    public $isLivewire = false;
    public $viteAssets = [];

    public function __construct($title = '', $isLivewire = false, $viteAssets = [])
    {
        $this->title = $title;
        $this->isLivewire = $isLivewire;
        $this->viteAssets = array_merge($viteAssets, ['resources/css/app.scss', 'resources/js/app.js']);
    }

    public function render(): View
    {
        return view('components.layouts.app');
    }
}
