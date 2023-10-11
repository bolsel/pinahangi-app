import {Livewire, Alpine} from '../../vendor/livewire/livewire/dist/livewire.esm';
import {dropFileComponent} from "./lib/drop-file-component";
import './editor';
import * as PusherPushNotifications from "@pusher/push-notifications-web";

window.appOnLoad = (userId, beamsIsEnabled) => {
  if (beamsIsEnabled) {
    const beamsTokenProvider = new PusherPushNotifications.TokenProvider({
      url: `/app/pusher/beams-auth/${userId}`,
    });
    const beamsClient = new PusherPushNotifications.Client({
      instanceId: import.meta.env.VITE_PUSHER_BEAMS_INSTANCE_ID,
    });
    beamsClient
      .start()
      .then(() => beamsClient.setUserId(userId.toString(), beamsTokenProvider))
      .catch(console.error);
  }
}
window.Alpine.data('drop_file_component', dropFileComponent);
Livewire.start()
