<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermohonanPerluTelaahNotification extends BasePermohonanNotification
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
        return [
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** perlu ditelaah.",
            'desc' => 'Organisasi: ' . $this->permohonan->organisasi->nama,
            'time' => $this->permohonan->statusLog->waktu
        ];
    }
}
