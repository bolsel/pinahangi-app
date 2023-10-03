<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermohonanPerluProsesNotification extends BasePermohonanNotification
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
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** perlu diproses.",
            'desc' => 'Organisasi: ' . $this->permohonan->organisasi->nama .
                ($statusLog->keterangan ? "\nKeterangan:\n" . $this->permohonan->statusLog->keterangan : ''),
            'time' => $statusLog->waktu
        ];
    }
}
