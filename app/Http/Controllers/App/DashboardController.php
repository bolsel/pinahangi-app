<?php

namespace App\Http\Controllers\App;

use App\Models\Permohonan;
use Gate;

class DashboardController
{
    public function index()
    {
        $permohonanCount = collect([
            Permohonan::STATUS_KONSEP => 0,
            Permohonan::STATUS_VALIDASI => 0,
            Permohonan::STATUS_VERIFIKASI => 0,
            Permohonan::STATUS_VERIFIKASI_TOLAK => 0,
            Permohonan::STATUS_PROSES => 0,
            Permohonan::STATUS_PERBAIKI => 0,
            Permohonan::STATUS_TELAAH => 0,
            Permohonan::STATUS_SELESAI => 0,
        ])->merge(Permohonan::groupBy('status')
            ->where(function ($q) {
                if (Gate::check('roleIsOrganisasi') && $organisasi_id = \Auth::user()->organisasi_id) {
                    $q->where('organisasi_id', $organisasi_id);
                } elseif (Gate::check('roleIsUser') && $pemohon = \Auth::user()->pemohon) {
                    $q->where('pemohon_id', $pemohon->id);
                }
            })
            ->selectRaw('count(*) as total, status')
            ->pluck('total', 'status')
        );
        $chartDataPermohonanStatus = collect($permohonanCount->map(function ($v, $k) {
            $bg = 'gray.300';
            $label = \Str::headline($k);
            switch ($k) {
                case Permohonan::STATUS_KONSEP:
                    $bg = 'gray.300';
                    break;
                case Permohonan::STATUS_VALIDASI:
                    $bg = 'gray.500';
                    break;
                case Permohonan::STATUS_VERIFIKASI:
                    $bg = 'blue.300';
                    break;
                case Permohonan::STATUS_VERIFIKASI_TOLAK:
                    $bg = 'red.300';
                    break;
                case Permohonan::STATUS_PROSES:
                    $bg = 'blue.500';
                    break;
                case Permohonan::STATUS_TELAAH:
                    $bg = 'teal.400';
                    break;
                case Permohonan::STATUS_PERBAIKI:
                    $bg = 'yellow.400';
                    break;
                case Permohonan::STATUS_SELESAI:
                    $bg = 'green.500';
                    break;
            }
            return [
                'label' => $label,
                'data' => $v,
                'backgroundColor' => $bg
            ];
        }));
        if (Gate::check('roleIsOrganisasi')) {
            $chartDataPermohonanStatus->pull(Permohonan::STATUS_KONSEP);
            $chartDataPermohonanStatus->pull(Permohonan::STATUS_VALIDASI);
            $chartDataPermohonanStatus->pull(Permohonan::STATUS_VERIFIKASI);
            $chartDataPermohonanStatus->pull(Permohonan::STATUS_VERIFIKASI_TOLAK);
        }
        if (Gate::check('roleIsUser')) {
            $chartDataPermohonanStatus->pull(Permohonan::STATUS_KONSEP);
            $chartDataPermohonanStatus->pull(Permohonan::STATUS_VALIDASI);
            $chartDataPermohonanStatus->pull(Permohonan::STATUS_PERBAIKI);
            $chartDataPermohonanStatus->pull(Permohonan::STATUS_PERBAIKI);
        }
        $chartDataPermohonanStatus = [
            'labels' => $chartDataPermohonanStatus->map(function ($v) {
                return $v['label'];
            })->values(),
            'data' => $chartDataPermohonanStatus->map(function ($v) {
                return $v['data'];
            })->values(),
            'backgroundColor' => $chartDataPermohonanStatus->map(function ($v) {
                return $v['backgroundColor'];
            })->values()
        ];

        $kepuasanCount = function ($puas) use ($permohonanCount) {
            $q = Permohonan::where(function ($q) {
                if (Gate::check('roleIsOrganisasi') && $organisasi_id = \Auth::user()->organisasi_id) {
                    $q->where('organisasi_id', $organisasi_id);
                }
            })->whereStatus(Permohonan::STATUS_SELESAI);
            if ($puas !== null) {
                $q->whereHas('kepuasan', function ($k) use ($puas) {
                    $k->wherePuas($puas);
                });
            } else {
                $q->doesntHave('kepuasan');
            }
            return $q->count('id');
        };
        $chartKepuasanCount = null;
        if (!Gate::check('roleIsUser')) {
            $chartKepuasanCount = [
                'labels' => ['PUAS', 'TIDAK PUAS', 'Belum Mengisi'],
                'data' => [$kepuasanCount(1), $kepuasanCount(0), $kepuasanCount(null)],
                'backgroundColor' => ['green.500', 'amber.400', 'gray.400']
            ];
        }

        return view('app.dashboard', [
            'chartDataPermohonanStatus' => $chartDataPermohonanStatus,
            'chartKepuasanCount' => $chartKepuasanCount
        ]);
    }

}
