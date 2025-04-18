<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Real-Time Chat</title>
    
    <!-- Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
        }

        #app {
            width: 100%;
            max-width: 800px;
            padding: 20px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px); /* Adding blur effect to the background */
        }

        h1 {
            font-size: 3em;
            font-weight: 600;
            margin-bottom: 20px;
            animation: fadeIn 2s ease-in-out;
        }

        p {
            font-size: 1.2em;
            margin: 20px 0;
            animation: fadeIn 2s ease-in-out;
        }

        .btn {
            padding: 10px 20px;
            background-color: #2575fc;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1.2em;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #6a11cb;
        }

        /* Animation for fadeIn */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Vue Component is rendered here -->
        <welcome-page></welcome-page>
    </div>

    <!-- Include Vue and TypeScript -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script>
        // TypeScript for the Welcome Page Component
        Vue.component('welcome-page', {
            template: `
                <div>
                    <h1>Welcome to Real-Time Chat</h1>
                    <p>Click the button below to enter the chat.</p>
                    <button class="btn" @click="goToChat">Enter Chat</button>
                </div>
            `,
            methods: {
                // This method handles the button click to navigate to the chat view
                goToChat() {
                    // Redirect to the chat view
                    window.location.href = '/chat'; // Adjust the path based on your routing setup
                }
            }
        });

        // Vue instance to mount the app
        new Vue({
            el: '#app',
        });
    </script>
</body>
</html>
