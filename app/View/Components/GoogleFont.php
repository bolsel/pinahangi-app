<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GoogleFont extends Component
{
    private $fonts = [
        'raleway' => 'https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;600;700;900&display=swap',
        'inter' => 'https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;600;700;900&display=swap',
    ];

    public $font;

    public function __construct($font = 'all')
    {
        $this->font = $font;
    }

    public function render(): View
    {
        return view('components.google-font', ['fonts' => $this->fonts]);
    }
}
