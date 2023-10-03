<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function statusPermohonan(Request $request)
    {
        $permohonan = null;
        if ($request->has('nomor_permohonan')) {
            if (!$permohonan = Permohonan::where('nomor', $request->get('nomor_permohonan'))->first()) {
                return redirect(route('frontend.status-permohonan'))->withErrors([
                    'nomor_permohonan' => 'Nomor permohonan tidak ditemukan.'
                ]);
            }
        }
        return view('frontend.status-permohonan', [
            'permohonan' => $permohonan
        ]);
    }
}
