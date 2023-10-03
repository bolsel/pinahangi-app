<?php

namespace App\View\Components\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public $title = '';
    public $isLivewire = false;

    public function __construct($title = '', $isLivewire = false)
    {
        $this->title = $title;
        $this->isLivewire = $isLivewire;
    }

    public function render(): View
    {
        return view('components.layouts.app');
    }
}
