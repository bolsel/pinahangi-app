<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermohonanAkanTelaahNotification extends BasePermohonanNotification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hai ' . $notifiable->name)
            ->subject('Permohonan anda segera ditelaah.')
            ->line("Permohonan anda dengan nomor **{$this->permohonan->nomor}** segera ditelaah.");
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => "Permohonan dengan nomor **{$this->permohonan->nomor}** dalam proses telaah.",
            'desc' => 'Organisasi: ' . $this->permohonan->organisasi->nama,
            'time' => $this->permohonan->statusLog->waktu
        ];
    }
}
