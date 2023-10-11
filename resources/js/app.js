import {Livewire, Alpine} from '../../vendor/livewire/livewire/dist/livewire.esm';
import {dropFileComponent} from "./lib/drop-file-component";
import './editor';
import * as PusherPushNotifications from "@pusher/push-notifications-web";

window.appOnLoad = (config) => {
  const {userId, pusherBeamsInstanceId} = config;
  if (pusherBeamsInstanceId) {
    const beamsTokenProvider = new PusherPushNotifications.TokenProvider({
      url: `/app/pusher/beams-auth/${userId}`,
    });
    const beamsClient = new PusherPushNotifications.Client({
      instanceId: pusherBeamsInstanceId,
    });
    beamsClient
      .start()
      .then(() => beamsClient.setUserId(userId.toString(), beamsTokenProvider))
      .catch(console.error);
  }
}
window.Alpine.data('drop_file_component', dropFileComponent);
Livewire.start()
