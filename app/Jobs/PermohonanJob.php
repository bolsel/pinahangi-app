<?php

namespace App\Jobs;

use App\Models\Permohonan;
use App\Models\User;
use App\Notifications\PermohonanAkanProsesNotification;
use App\Notifications\PermohonanAkanTelaahNotification;
use App\Notifications\PermohonanNotification;
use App\Notifications\PermohonanPerluPerbaikiNotification;
use App\Notifications\PermohonanPerluProsesNotification;
use App\Notifications\PermohonanPerluTelaahNotification;
use App\Notifications\PermohonanPerluVerifikasiNotification;
use App\Notifications\PermohonanSelesaiNotification;
use App\Notifications\PermohonanVerifikasiDitolakNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;
use Throwable;

class PermohonanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Permohonan $permohonan)
    {
    }

    public function handle(): void
    {
        $permohonan = $this->permohonan;
        $status = $permohonan->status;
        if ($status === Permohonan::STATUS_VERIFIKASI) {
            Notification::send(
                User::whereCanVerifikasi()->get(),
                new PermohonanPerluVerifikasiNotification($this->permohonan)
            );
        } elseif ($status === Permohonan::STATUS_VERIFIKASI_TOLAK) {
            $pemohon = $permohonan->pemohon;
            Notification::send(
                $pemohon->user,
                new PermohonanVerifikasiDitolakNotification($this->permohonan)
            );
        } elseif ($status === Permohonan::STATUS_PROSES) {
            $pemohon = $permohonan->pemohon;
            Notification::send(
                $pemohon->user,
                new PermohonanAkanProsesNotification($this->permohonan)
            );

            $users = User::whereCanProses()
                ->where('organisasi_id', $permohonan->organisasi_id)
                ->get();
            Notification::send(
                $users,
                new PermohonanPerluProsesNotification($this->permohonan)
            );
        } elseif ($status === Permohonan::STATUS_TELAAH) {
            $pemohon = $permohonan->pemohon;
            Notification::send(
                $pemohon->user,
                new PermohonanAkanTelaahNotification($this->permohonan)
            );

            Notification::send(
                User::whereCanTelaah()->get(),
                new PermohonanPerluTelaahNotification($this->permohonan)
            );
        } elseif ($status === Permohonan::STATUS_PERBAIKI) {
            $users = User::whereCanProses()
                ->where('organisasi_id', $permohonan->organisasi_id)
                ->get();
            Notification::send(
                $users,
                new PermohonanPerluPerbaikiNotification($this->permohonan)
            );
        } elseif ($status === Permohonan::STATUS_SELESAI) {
            Notification::send(
                $permohonan->pemohon->user,
                new PermohonanSelesaiNotification($this->permohonan)
            );
        }

    }
}
