<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class PermohonanVerifikasiDitolakNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hai ' . $notifiable->name)
            ->subject('Verifikasi permohonan ditolak..')
            ->line("Permohonan anda dengan nomor **{$this->permohonan->nomor}** ditolak.")
            ->lineIf($this->permohonan->statusLog->keterangan, "*Keterangan*: " . $this->permohonan->statusLog->keterangan);
    }

    public function toArray($notifiable): array
    {
        $statusLog = $this->permohonan->statusLog;
        return [
            'title' => "Verifikasi permohonan dengan nomor **{$this->permohonan->nomor}** ditolak.",
            'desc' => $statusLog->keterangan,
            'time' => $statusLog->waktu
        ];
    }
}
