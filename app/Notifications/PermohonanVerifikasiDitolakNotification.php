<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class PermohonanVerifikasiDitolakNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
