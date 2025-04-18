<template>
    <div class="chat-container">
      <!-- Messages Section -->
      <div class="messages">
        <div v-for="(msg, index) in messages" :key="index" class="message">
          <p><strong>Anonymous User:</strong> {{ msg.message }}</p>
        </div>
      </div>
  
      <!-- Input Form Section -->
      <div class="input-group">
        <input
          v-model="message"
          @keyup.enter="sendMessage"
          placeholder="Type your message here..."
          class="input-field"
          type="text"
        />
        <button @click="sendMessage" class="send-button">Send</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        messages: [],  // Store incoming messages
        message: '',   // Bind input value
      };
    },
    mounted() {
      this.fetchMessages(); // Load previous messages
    },
    methods: {
      fetchMessages() {
        axios
          .get('/messages')
          .then((response) => {
            // Always add 'Anonymous User' to fetched messages
            this.messages = response.data.map(msg => ({
              name: 'Anonymous User',
              message: msg.message,
            }));
          })
          .catch((error) => {
            console.error('Error fetching messages:', error);
          });
      },
  
      addMessage(message) {
        console.log('Adding message:', message);
        this.messages.push({
          name: 'Anonymous User',
          message: message,
        });
      },
  
      sendMessage() {
        if (this.message.trim() !== '') {
          axios
            .post('/send-message', { message: this.message })
            .then(() => {
              this.message = '';
            })
            .catch((error) => {
              console.error('Error sending message:', error);
            });
        }
      },
    },
  };
  </script>
  