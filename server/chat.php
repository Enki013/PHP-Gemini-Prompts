<?php
require_once("api/check_session.php");
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
        .max-w-xl {
            max-width: 900px;
            margin: auto;
        }

        .chat-messages {
            max-height: 70vh;
            overflow-y: auto;
        }

        .message-box {
            max-width: 90%;
        }

        @media (min-width: 640px) {
            #chat-form {
                width: 100%;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>

</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-xl w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gray-200 px-4 py-3 border-b border-gray-300 flex items-center justify-between">
            <span class="text-lg font-semibold">Chat</span>
            <button class="text-gray-600 hover:text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="message-container" class="chat-messages px-4 py-6 space-y-4">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="bg-gray-200 px-4 py-3 flex items-center">
            <form id="chat-form" action="chat.php" method="POST" class="flex items-center">
                <input type="hidden" id="prompt_card_id" name="prompt_card_id" value="2">
                <input type="text" id="user_message" name="user_message" placeholder="Mesajınızı yazın..."
                    class="flex-1 px-4 py-2 bg-gray-100 rounded-full focus:outline-none mr-2">
                <button type="submit"
                    class="ml-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full focus:outline-none">Gönder</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Form gönderimini engelle

            // Kullanıcı girdisini al
            var userMessage = document.getElementById('user_message').value;

            // AJAX kullanarak kullanıcı girdisini chat.php'ye gönder
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'api/chat.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('Authorization', '3cc162d4d38f296bdcf643ff99dee2ac4d4d3d2de0f46d4cdbaa7f7ce7e324b1b2ec2a1302eb42426518f80624910d1b482646e239d34a5b14bbb6715801f96c');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Yanıtı ekrana göster
                    var responseData = JSON.parse(xhr.responseText);
                    displayMessage('User', userMessage);
                    displayMessage('Model', responseData.response);
                } else {
                    console.error('İstek başarısız. Hata:', xhr.statusText);
                }
            };

            xhr.onerror = function () {
                console.error('İstek başarısız');
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

            if (role === 'User') {
                messageContainer.innerHTML = `
            <div class="flex items-end justify-end">
                <div class="bg-gray-100 py-2 px-3 rounded-lg">
                    <p class="text-sm text-gray-800">${message}</p>
                    <span class="text-xs text-gray-500">${role}</span>
                </div>
                <div class="flex-shrink-0 ml-3">
                    <img class="h-8 w-8 rounded-full" src="https://via.placeholder.com/150" alt="Receiver">
                </div>
            </div>
        `; chatMessages.appendChild(messageContainer); // Kullanıcı mesajını en alta ekleyin




            } else if (role === 'Model') {
                // Parse the message using markdown-it
                var parsedMessage = md.render(message);

                messageContainer.innerHTML = `
            <div class="flex items-start justify-start">
                <div class="flex-shrink-0 ml-3">
                    <img class="h-8 w-8 rounded-full" src="https://via.placeholder.com/150" alt="Sender">
                </div>
                <div class="ml-3 bg-blue-100 py-2 px-3 rounded-lg model-message">
                    <p class="text-sm text-gray-800">${parsedMessage}</p>
                    <span class="text-xs text-gray-500">${role}</span>
                </div>
            </div>
        `;
                chatMessages.appendChild(messageContainer); // Mesajı alt alta ekleyin


            }
        }
    </script>
</body>

</html>