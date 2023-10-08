<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermohonanAkanProsesNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hai ' . $notifiable->name)
            ->subject('Permohonan anda segera diproses.')
            ->line("Permohonan anda dengan nomor **{$this->permohonan->nomor}** segera diproses.");
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** dalam proses oleh organisasi.",
            'desc' => 'Organisasi: ' . $this->permohonan->organisasi->nama,
            'time' => $this->permohonan->statusLog->waktu
        ];
    }
}
