<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class PermohonanPerluVerifikasiNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Permohonan baru perlu verifikasi dari anda.')
            ->subject('Permohonan perlu verifikasi.')
            ->lineIf($this->permohonan->nomor, '*Nomor*: **' . $this->permohonan->nomor . '**.')
            ->line('*Nama Pemohon*: **' . $this->permohonan->pemohon->nama . '**.')
            ->line('*Jenis*: **' . $this->permohonan->jenis_pemohon_label . '**.')
            ->line('*Waktu Permohonan*: **' . $this->permohonan->waktu_permohonan . '**.')
            ->action('Verifikasi Sekarang', route('app.permohonan.verifikasi', ['permohonan' => $this->permohonan]));
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** perlu diverifikasi.",
            'desc' => '',
            'time' => $this->permohonan->statusLog->waktu
        ];
    }
}
