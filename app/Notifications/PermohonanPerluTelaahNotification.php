<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermohonanPerluTelaahNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Permohonan baru perlu telaah dari anda.')
            ->subject('Permohonan perlu ditelaah.')
            ->lineIf($this->permohonan->nomor, '*Nomor*: **' . $this->permohonan->nomor . '**.')
            ->line('*Nama Pemohon*: **' . $this->permohonan->pemohon->nama . '**.')
            ->line('*Jenis*: **' . $this->permohonan->jenis_pemohon_label . '**.')
            ->line('*Organisasi*: **' . $this->permohonan->organisasi->nama . '**.')
            ->line('*Waktu Permohonan*: **' . $this->permohonan->waktu_permohonan . '**.')
            ->line('*Waktu Verifikasi*: **' . $this->permohonan->waktu_verifikasi . '**.')
            ->line('*Waktu Proses*: **' . $this->permohonan->waktu_proses . '**.')
            ->action('Telaah Sekarang', route('app.permohonan.telaah', ['permohonan' => $this->permohonan]));
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** perlu ditelaah.",
            'desc' => 'Organisasi: ' . $this->permohonan->organisasi->nama,
            'time' => $this->permohonan->statusLog->waktu
        ];
    }
}
