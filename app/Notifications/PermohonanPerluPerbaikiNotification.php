<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermohonanPerluPerbaikiNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting("Hai $notifiable->name. Proses permohonan perlu diperbaiki.")
            ->subject('Proses Permohonan perlu diperbaiki.')
            ->lineIf($this->permohonan->nomor, '*Nomor*: **' . $this->permohonan->nomor . '**.')
            ->line('*Nama Pemohon*: **' . $this->permohonan->pemohon->nama . '**.')
            ->line('*Jenis*: **' . $this->permohonan->jenis_pemohon_label . '**.')
            ->line('*Organisasi*: **' . $this->permohonan->organisasi->nama . '**.')
            ->action('Perbaiki Sekarang', route('app.permohonan.proses', ['permohonan' => $this->permohonan]));
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** perlu deperbaiki.",
            'desc' => 'Organisasi: ' . $this->permohonan->organisasi->nama,
            'time' => $this->permohonan->statusLog->waktu
        ];
    }
}
