<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class PermohonanPerluProsesNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting("Hai {$notifiable->name}. Permohonan perlu diproses.")
            ->subject('Permohonan perlu diproses.')
            ->lineIf($this->permohonan->nomor, '*Nomor*: **' . $this->permohonan->nomor . '**.')
            ->line('*Nama Pemohon*: **' . $this->permohonan->pemohon->nama . '**.')
            ->line('*Jenis*: **' . $this->permohonan->jenis_pemohon_label . '**.')
            ->line('*Organisasi*: **' . $this->permohonan->organisasi->nama . '**.')
            ->line('*Waktu Permohonan*: **' . $this->permohonan->waktu_permohonan . '**.')
            ->line('*Waktu Verifikasi*: **' . $this->permohonan->waktu_verifikasi . '**.')
            ->action('Proses Sekarang', route('app.permohonan.proses', ['permohonan' => $this->permohonan]));
    }

    public function toArray($notifiable): array
    {
        $statusLog = $this->permohonan->statusLog;
        return [
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** perlu diproses.",
            'desc' => 'Organisasi: ' . $this->permohonan->organisasi->nama .
                ($statusLog->keterangan ? "\nKeterangan:\n" . $this->permohonan->statusLog->keterangan : ''),
            'time' => $statusLog->waktu
        ];
    }
}
