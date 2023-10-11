<?php

namespace App\Notifications;

use App\Models\Permohonan;
use Illuminate\Notifications\Notification;
use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;

abstract class BasePermohonanNotification extends Notification
{

    abstract public function toArray($notifiable): array;

    public function __construct(protected readonly Permohonan $permohonan)
    {
    }

    public function via($notifiable): array
    {
        $via = ['database'];
        if (config('services.pusher.beams_enabled'))
            $via[] = PusherChannel::class;
        if (config('app.env') !== 'local')
            $via[] = 'mail';

        return $via;
    }

    public function toPushNotification($notifiable)
    {
        $data = $this->toArray($notifiable);
        return PusherMessage::create()
            ->web()
            ->badge(1)
            ->sound('success')
            ->title("Permohonan")
            ->link(route('app.permohonan.detail', ['permohonan' => $this->permohonan]))
            ->body($data['title']);
    }

}
