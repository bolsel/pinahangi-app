<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Pemohon;
use App\Models\Permohonan;

class PermohonanController extends Controller
{
    public function index()
    {
        $data = Permohonan::orderBy('updated_at', 'desc')
            ->where(function ($q) {
                if (\Gate::check('roleIsOrganisasi') && $organisasi_id = auth()->user()->organisasi_id) {
                    $q->where('organisasi_id', $organisasi_id);
                }
            });
        return view('app.permohonan-index', [
            'data' => $data->paginate(10)
        ]);
    }

    public function verifikasiList()
    {
        return view('app.permohonan-verifikasi-list', [
            'data' => Permohonan::orderBy('updated_at', 'desc')
                ->where('status', Permohonan::STATUS_VERIFIKASI)
                ->paginate(10)
        ]);
    }

    public function verifikasi(Permohonan $permohonan)
    {
        return view('app.permohonan-verifikasi', [
            'permohonan' => $permohonan
        ]);
    }

    public function prosesList()
    {
        $data = Permohonan::orderBy('updated_at', 'desc')
            ->whereIn('status', [Permohonan::STATUS_PROSES])
            ->where(function ($q) {
                if (\Gate::check('roleIsOrganisasi') && $organisasi_id = auth()->user()->organisasi_id) {
                    $q->where('organisasi_id', $organisasi_id);
                }
            });
        return view('app.permohonan-proses-list', [
            'data' => $data->paginate(10),
            'perbaiki' => false
        ]);
    }

    public function perbaikiList()
    {
        $data = Permohonan::orderBy('updated_at', 'desc')
            ->whereIn('status', [Permohonan::STATUS_PERBAIKI])
            ->where(function ($q) {
                if (\Gate::check('roleIsOrganisasi') && $organisasi_id = auth()->user()->organisasi_id) {
                    $q->where('organisasi_id', $organisasi_id);
                }
            });
        return view('app.permohonan-proses-list', [
            'data' => $data->paginate(10),
            'perbaiki' => true
        ]);
    }

    public function proses(Permohonan $permohonan)
    {
        $this->authorize('roleIsOrganisasi', $permohonan->organisasi_id);
        return view('app.permohonan-proses', [
            'permohonan' => $permohonan
        ]);
    }

    public function telaahList()
    {
        $data = Permohonan::orderBy('updated_at', 'desc')
            ->where('status', Permohonan::STATUS_TELAAH);
        return view('app.permohonan-telaah-list', [
            'data' => $data->paginate(10)
        ]);
    }

    public function telaah(Permohonan $permohonan)
    {
        return view('app.permohonan-telaah', [
            'permohonan' => $permohonan
        ]);
    }


    public function saya()
    {
        $me = Pemohon::me();
        $permohonanAktif = $me->permohonanAktif;
        $semua = $me->semuaPermohonan()
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('app.permohonan-saya', [
            'permohonanAktif' => $permohonanAktif,
            'semua' => $semua,
        ]);
    }
}
