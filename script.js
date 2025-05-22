// Script to handle sending messages
document.addEventListener('DOMContentLoaded', function() {
    const sendButton = document.querySelector('.send-button');
    const chatInput = document.querySelector('.chat-input');
    const chatMessages = document.querySelector('.chat-messages');

    function sendMessage() {
        const message = chatInput.value.trim();
        if (message) {
            // Create user message bubble
            const userMessage = document.createElement('div');
            userMessage.className = 'chat-bubble user-message';
            userMessage.textContent = message;
            chatMessages.appendChild(userMessage);
            
            // Clear input
            chatInput.value = '';
            
            // Scroll to bottom of chat
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }

    // Send button click handler
    sendButton.addEventListener('click', sendMessage);

    // Enter key handler
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
});
