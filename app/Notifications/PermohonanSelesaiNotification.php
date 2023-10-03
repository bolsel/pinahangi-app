<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class PermohonanSelesaiNotification extends BasePermohonanNotification
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
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** telah **selesai**.",
            'desc' => '',
            'time' => $this->permohonan->statusLog->waktu
        ];
    }
}
