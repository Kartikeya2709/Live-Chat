import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import { createApp } from 'vue';
import ChatComponent from './components/Chat.vue';

// Ensure Pusher is properly initialized
window.Pusher = Pusher;

// Create the Vue app instance
const app = createApp(ChatComponent);
window.vueApp = app.mount('#app');

// Configure Echo for Pusher
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'local', // Your Pusher App Key
    wsHost: '127.0.0.1',
    cluster: 'mt1',
    wsPort: 6001, // Default WebSocket port for Laravel WebSockets
    forceTLS: false, // Set this to `true` if using HTTPS
    disableStats: true,
});

// Listen to the 'chat' channel for the 'MessageSent' event
window.Echo.channel('chat')
    .listen('MessageSent', (event) => {
        console.log('New Message Received:', event); // Log the incoming even
    });
