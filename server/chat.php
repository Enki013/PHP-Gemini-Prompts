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
    <style>
        .max-w-3xl {
            max-width: 1200px;
            margin: auto;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
        }

        .user-message, .model-message {
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 60%;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            max-width: fit-content;
            margin-bottom: 10px; /* Add space between messages */
        }

        .user-message {
            background-color: #007bff;
            color: white;
            align-self: flex-end;
        }

        .model-message {
            background-color: #e2e8f0;
            color: black;
            align-self: flex-start;
        }

        .message-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message p {
            margin-bottom: 10px; /* Add space between text and role */
        }

        @media (min-width: 640px) {
            #chat-form {
                width: 100%;
            }
        }

        .typing-animation {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4a5568; /* Daha koyu renk */
            align-self: flex-start;
            display: flex;
            gap: 5px;
        }

        .typing-dot {
            animation: boing 1s infinite, fade 1.5s infinite;
        }

        @keyframes boing {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes fade {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 1; }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>

</head>

<body class="bg-gray-100 h-screen flex flex-col items-center justify-center">
    <div class="max-w-3xl w-full bg-white rounded-lg shadow-lg overflow-hidden flex flex-col h-full">
        <div class="bg-gray-800 px-4 py-3 border-b border-gray-700 flex items-center justify-between">
            <span class="text-lg font-semibold text-white">Chat</span>
            <button class="text-gray-400 hover:text-gray-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="message-container" class="chat-messages flex-1 overflow-y-auto w-full">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="bg-gray-800 px-4 py-3 flex items-center w-full">
            <form id="chat-form" action="chat.php" method="POST" class="flex items-center w-full">
                <input type="hidden" id="prompt_card_id" name="prompt_card_id" value="2">
                <input type="text" id="user_message" name="user_message" placeholder="Mesajınızı yazın..."
                    class="flex-1 px-4 py-2 bg-gray-700 text-white rounded-full focus:outline-none mr-2">
                <button type="submit" id="send-button" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full focus:outline-none">
                    Gönder
                </button>
            </form>
        </div>
    </div>

    <script>
        var isWaitingForResponse = false;

        document.getElementById('chat-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Form gönderimini engelle

            if (isWaitingForResponse) {
                return; // Eğer bekleniyorsa, yeni mesaj gönderimini engelle
            }

            isWaitingForResponse = true; // Yanıt bekleniyor

            // Kullanıcı girdisini al
            var userMessage = document.getElementById('user_message').value;

            // Kullanıcı mesajını ekrana göster
            displayMessage('User', userMessage);

            // Mesaj kutusunu temizle
            document.getElementById('user_message').value = '';

            // Modelin yazıyor animasyonunu ekle
            displayTypingAnimation();

            // Gönder butonunu değiştir
            var sendButton = document.getElementById('send-button');
            sendButton.innerHTML = `
                <div class="loader"></div>
            `;

            // AJAX kullanarak kullanıcı girdisini chat.php'ye gönder
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'api/chat.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('Authorization', '58c395503e3131f5278e14560cacbe2a49f80dffe24285f91cbc0378cf9a1d9ca6b039c531eb38d656354627b0a86eb8957741103472d9e740f5dde519c4b3be');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Yanıtı ekrana göster
                    var responseData = JSON.parse(xhr.responseText);
                    removeTypingAnimation();
                    displayMessage('Model', responseData.response);
                    // Gönder butonunu geri değiştir
                    sendButton.innerHTML = `Gönder`;
                    isWaitingForResponse = false; // Yanıt alındı
                } else {
                    console.error('İstek başarısız. Hata:', xhr.statusText);
                    isWaitingForResponse = false; // Yanıt alındı
                }
            };

            xhr.onerror = function () {
                console.error('İstek başarısız');
                isWaitingForResponse = false; // Yanıt alındı
            };
            // Veri
            var requestData = {
                user_message: userMessage,
                prompt_card_id: 2
            };
            // Veriyi JSON olarak gönder
            xhr.send(JSON.stringify(requestData));
        });
        var md = window.markdownit();

        // Chat arayüzünde mesajları görüntülemek için fonksiyon
        function displayMessage(role, message) {
            var chatMessages = document.getElementById('message-container');
            var messageContainer = document.createElement('div');
            messageContainer.classList.add('message-container');

            if (role === 'User') {
                messageContainer.innerHTML = `
            <div class="message user-message">
                <p class="text-sm">${message}</p>
                <span class="text-xs">${role}</span>
            </div>
        `; chatMessages.appendChild(messageContainer); // Kullanıcı mesajını en alta ekleyin




            } else if (role === 'Model') {
                // Parse the message using markdown-it
                var parsedMessage = md.render(message);

                messageContainer.innerHTML = `
            <div class="message model-message">
                <p class="text-sm">${parsedMessage}</p>
                <span class="text-xs">${role}</span>
            </div>
        `;
                chatMessages.appendChild(messageContainer); // Mesajı alt alta ekleyin


            }
        }

        // Modelin yazıyor animasyonunu eklemek için fonksiyon
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
        }

        // Modelin yazıyor animasyonunu kaldırmak için fonksiyon
        function removeTypingAnimation() {
            var typingContainer = document.getElementById('typing-animation');
            if (typingContainer) {
                typingContainer.remove();
            }
        }
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