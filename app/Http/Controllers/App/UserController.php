<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function pemberitahuan()
    {
        return view('app.pemberitahuan', [
            'pemberitahuan' => \Auth::user()->notifications()->paginate(20)
        ]);
    }
}
