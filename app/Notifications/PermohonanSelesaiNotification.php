<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class PermohonanSelesaiNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hai ' . $notifiable->name)
            ->subject('Permohonan anda telah selesai.')
            ->line("Permohonan anda dengan nomor **{$this->permohonan->nomor}** telah selesai.");
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
