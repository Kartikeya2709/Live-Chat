<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Live Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* General Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('{{ asset('images/img1.png') }}'); /* Background image */
            background-size: cover;
            background-position: center;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            overflow: hidden;
        }

        /* Chat Container */
        .chat-container {
            background-color: rgba(2, 2, 2, 0.00); /* White background with 50% opacity */
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 40px;
            display: flex;
            flex-direction: column;
            height: 80vh;
            transition: all 0.9s ease;
            backdrop-filter: blur(5px); /* Blur effect for background */
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Messages Section */
        #messages {
            list-style: none;
            padding: 0;
            flex-grow: 1;
            overflow-y: auto;
            margin-bottom: 20px;
            max-height: 500px;
            transition: 0.3s ease-in-out;
            margin-top: 20px;
        }

        li {
            background-color: #e1f5fe;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Input Section */
        .input-group {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            margin-top: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 18px;
            outline: none;
            transition: border 0.3s;
        }

        input[type="text"]:focus {
            border: 1px solid #0099cc;
        }

        button {
            background-color: #0099cc;
            color: #fff;
            padding: 14px 22px;
            border-radius: 25px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0066ff;
        }

        /* Footer Styling */
        footer {
            text-align: center;
            margin-top: 20px;
            color: #fff;
            font-size: 40px;
        }

        /* Animation for Messages */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .chat-container {
                padding: 30px;
                width: 90%;
                height: 70vh;
            }

            h1 {
                font-size: 28px;
                color : #ffffff;
            }

            button {
                font-size: 16px;
                padding: 12px 20px;
            }
        }

        @media (max-width: 480px) {
            .chat-container {
                padding: 20px;
                width: 95%;
            }

            input[type="text"] {
                padding: 12px 15px;
            }

            button {
                padding: 12px 18px;
            }
        }
    </style>
</head>
<body>

    <div class="chat-container">
        <h1>Live Chat</h1>
        <div id="chat">
            <ul id="messages"></ul>

            <div class="input-group">
                <input id="message" type="text" placeholder="Type message..." />
                <button id="send">Send</button>
            </div>
        </div>
    </div>

    <footer>
        <p>Made by Kartikeya Sharma</p>
    </footer>

    <!-- Load Pusher and Laravel Echo via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>

    <script>
        // Initialize Laravel Echo using the IIFE global
        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'local', // Match your Pusher key (in .env)
            wsHost: window.location.hostname,
            wsPort: 6001,
            forceTLS: false,
            disableStats: true,
            cluster: 'mt1',
        });

        document.addEventListener('DOMContentLoaded', function () {
            const messageInput = document.getElementById('message');
            const messagesList = document.getElementById('messages');
            const sendButton = document.getElementById('send');

            sendButton.onclick = function () {
                const message = messageInput.value.trim();
                if (message === '') return;

                fetch('/send-message', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ message })
                }).then(response => response.json())
                  .then(() => {
                      messageInput.value = '';
                  }).catch(error => {
                      console.error('Message send error:', error);
                  });
            };

            // Listen for incoming messages
            window.Echo.channel('chat')
                .listen('MessageSent', (e) => {
                    const li = document.createElement('li');
                    li.textContent = `Anonymous: ${e.message}`;
                    messagesList.appendChild(li);
                    messagesList.scrollTop = messagesList.scrollHeight; // Auto-scroll to bottom
                });
        });
    </script>

</body>
</html>
