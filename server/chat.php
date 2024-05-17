<?php
require_once 'api/check_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Screen</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>
</head>

<body class="items-center justify-center bg-gray-200 flex min-h-screen">
    <div class="w-full bg-white rounded-xl shadow-lg max-w-3xl p-8">
        <p class="text-2xl font-bold mb-4">Chatbot</p>
        <p class="text-sm text-gray-600 mb-6">Powered by Mendable and Vercel</p>
        <div class="space-y-6 overflow-y-auto max-h-96" id="message-container">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="mt-8">
            <form id="chat-form" action="chat.php" method="POST" class="items-center flex space-x-3">
                <input type="hidden" id="prompt_card_id" name="prompt_card_id" value="2">
                <input type="text" id="user_message" name="user_message" placeholder="Type your message" class="border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-full w-full px-4 py-2">
                <button type="submit" id="send-button" class="hover:bg-indigo-600 bg-indigo-500 text-white px-6 py-2 rounded-full">Send</button>
            </form>
        </div>
    </div>

    <script>
        var isWaitingForResponse = false;

        document.getElementById('chat-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form submission

            if (isWaitingForResponse) {
                return; // If waiting, prevent new message submission
            }

            isWaitingForResponse = true; // Waiting for response

            // Get user input
            var userMessage = document.getElementById('user_message').value;

            // Display user message
            displayMessage('You', userMessage);

            // Clear message box
            document.getElementById('user_message').value = '';

            // Add typing animation
            displayTypingAnimation();

            // Change send button
            var sendButton = document.getElementById('send-button');
            sendButton.innerHTML = `
                <div class="loader"></div>
            `;

            // Send user input to chat.php using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'api/chat.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Display response
                    var responseData = JSON.parse(xhr.responseText);
                    removeTypingAnimation();
                    displayMessage('AI', JSON.parse(JSON.stringify(responseData.response)));
                    // Change send button back
                    sendButton.innerHTML = `Send`;
                    isWaitingForResponse = false; // Response received
                } else {
                    console.error('Request failed. Error:', xhr.statusText);
                    isWaitingForResponse = false; // Response received
                }
            };

            xhr.onerror = function () {
                console.error('Request failed');
                isWaitingForResponse = false; // Response received
            };

            // Data
            var requestData = {
                user_message: userMessage,
                prompt_card_id: 2
            };
            // Send data as JSON
            xhr.send(JSON.stringify(requestData));
        });

        var md = window.markdownit();

        // Function to display messages in chat interface
        
        // Function to add typing animation
        function displayTypingAnimation() {
            var chatMessages = document.getElementById('message-container');
            var typingContainer = document.createElement('div');
            typingContainer.classList.add('typing-animation');
            typingContainer.setAttribute('id', 'typing-animation');
            typingContainer.innerHTML = `
                <span class="typing-dot" style="animation-delay: 0s;">.</span>
                <span class="typing-dot" style="animation-delay: 0.2s;">.</span>
                <span class="typing-dot" style="animation-delay: 0.4s;">.</span>
            `;
            chatMessages.appendChild(typingContainer);
            chatMessages.scrollTop = chatMessages.scrollHeight; // Auto scroll to the bottom
        }

        // Function to remove typing animation
        function removeTypingAnimation() {
            var typingContainer = document.getElementById('typing-animation');
            if (typingContainer) {
                typingContainer.remove();
            }
        }

            document.addEventListener('DOMContentLoaded', function () {
        var token = localStorage.getItem('token');
        var promptCardId = document.getElementById('prompt_card_id').value;

        if (token) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'api/get_chat_history.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('Authorization', token);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var chatHistory = JSON.parse(xhr.responseText);
                    if (chatHistory.length > 0) {
                        chatHistory.forEach(function (message) {
                            displayMessage('You', message.user_message);
                            displayMessage('AI', message.response);
                        });
                    } else {
                        // Eğer sohbet geçmişi yoksa, ilk promptu gönder
                        var initialMessage = "<?php echo isset($_POST['initial_message']) ? $_POST['initial_message'] : ''; ?>";
                        if (initialMessage) {
                            sendMessage(initialMessage, promptCardId);
                        }
                    }
                } else {
                    console.error('Request failed. Error:', xhr.statusText);
                }
            };

            xhr.onerror = function () {
                console.error('Request failed');
            };

            var requestData = {
                prompt_card_id: promptCardId
            };
            xhr.send(JSON.stringify(requestData));
        } else {
            console.error('Token not found in localStorage');
        }
    });

    function displayMessage(role, message) {
        var chatMessages = document.getElementById('message-container');
        var messageContainer = document.createElement('div');
        messageContainer.classList.add('items-start', 'flex', 'space-x-4');

        var iconSrc = role === 'You' ? 'https://placehold.co/32x32?text=User+Icon' : 'https://placehold.co/32x32?text=AI+Icon';
        var parsedMessage = role === 'AI' ? md.render(message) : message;

        messageContainer.innerHTML = `
            <img src="${iconSrc}" alt="${role} Icon" class="w-10 h-10 rounded-full"/>
            <div>
                <p class="font-semibold">${role}</p>
                <p class="text-gray-700">${parsedMessage}</p>
            </div>
        `;
        chatMessages.appendChild(messageContainer);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function sendMessage(message, promptCardId) {
        displayMessage('You', message);
        displayTypingAnimation();

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'api/chat.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));

        xhr.onload = function () {
            if (xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                removeTypingAnimation();
                displayMessage('AI', responseData.response);
                isWaitingForResponse = false;
            } else {
                console.error('Request failed. Error:', xhr.statusText);
                isWaitingForResponse = false;
            }
        };

        xhr.onerror = function () {
            console.error('Request failed');
            isWaitingForResponse = false;
        };

        var requestData = {
            user_message: message,
            prompt_card_id: promptCardId
        };
        xhr.send(JSON.stringify(requestData));
    }
    //delete 
    document.getElementById('clear-button').addEventListener('click', function () {
            var token = localStorage.getItem('token');
            var promptCardId = document.getElementById('prompt_card_id').value;

            if (token) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'api/clear_chat_history.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('Authorization', token);

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var chatMessages = document.getElementById('message-container');
                        chatMessages.innerHTML = ''; // Clear chat messages
                    } else {
                        console.error('Request failed. Error:', xhr.statusText);
                    }
                };

                xhr.onerror = function () {
                    console.error('Request failed');
                };

                var requestData = {
                    prompt_card_id: promptCardId
                };
                xhr.send(JSON.stringify(requestData));
            } else {
                console.error('Token not found in localStorage');
            }
        });
    </script>
    <style>
        .loader {
            border: 4px solid #f3f3f3; /* Light grey */
            border-top: 4px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</body>

</html>
