<?php

namespace App\Notifications;

use App\Models\Permohonan;
use Illuminate\Notifications\Notification;

abstract class BasePermohonanNotification extends Notification
{

    public function __construct(protected readonly Permohonan $permohonan)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

}