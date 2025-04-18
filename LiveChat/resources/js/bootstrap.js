import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Uncomment this if you face issues with Pusher being undefined
window.Pusher = Pusher;

// Configure Echo to use Pusher or Laravel WebSockets
window.Echo = new Echo({
    broadcaster: 'pusher',  // Or 'socket.io' if you're using Laravel WebSockets
    key: 'local',  // Use your Pusher app key from the .env file (via Vite)
    cluster: 'mt1',  // Cluster, usually 'mt1' or whatever you have
    wsHost:  '127.0.0.1',  // Use 127.0.0.1 or whatever the WebSocket host is
    wsPort: 6001,  // Port for WebSockets (default is 6001)
    forceTLS: false,  // Set to true if you're using HTTPS
    // disableStats: true,  // Optional, to disable the stats collection on Pusher
    // enabledTransports: ['ws', 'wss'],  // Optional, set WebSocket transport methods
});
