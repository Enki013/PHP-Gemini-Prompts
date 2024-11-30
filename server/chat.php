<?php
require_once 'api/check_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">""
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <title id="pageTitle">Act As;</title>
<link rel="stylesheet" href="src/chat.css">
</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <div class="text logo-text">
                    <span class="name" id="userName">Loading...</span>
                    <span class="email" id="userEmail">Loading...</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="index.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Main Page</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>

                    

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="api/logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <section class="home">
        <div class="text" id="pageTitle">Powered By Gemini</div>
        <div class="messages" id="message-container">
        </div>
    </section>

        <form class="chatbox" id="chat-form" action="chat.php" method="POST">
            <div class="chatbox-input">
                <input type="hidden" id="prompt_card_id" name="prompt_card_id" value="2">
                <input type="text" id="user_message" placeholder="Type a message...">
                <button type="submit" id="send-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 32 32"
                        class="icon-2xl">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M15.192 8.906a1.143 1.143 0 0 1 1.616 0l5.143 5.143a1.143 1.143 0 0 1-1.616 1.616l-3.192-3.192v9.813a1.143 1.143 0 0 1-2.286 0v-9.813l-3.192 3.192a1.143 1.143 0 1 1-1.616-1.616z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </form>

    <script>

        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text"),
            chatboxInput = body.querySelector('.chatbox-input input'),
            chatboxButton = body.querySelector('.chatbox-input button'),
            messagesContainer = body.querySelector('.messages');

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })

        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        })

        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                body.classList.add('dark');
                modeText.innerText = "Light mode";
            }
        });

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");

            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
                localStorage.setItem('theme', 'dark');
            } else {
                modeText.innerText = "Dark mode";
                localStorage.setItem('theme', 'light');
            }
        });

        

        function displayTypingAnimation() {
            const typingElement = document.createElement('div');
            typingElement.classList.add('message', 'typing');
            typingElement.innerHTML = `<div class="content">Typing...</div>`;
            messagesContainer.appendChild(typingElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function removeTypingAnimation() {
            const typingElement = messagesContainer.querySelector('.message.typing');
            if (typingElement) {
                messagesContainer.removeChild(typingElement);
            }
        }

        
var isWaitingForResponse = false;
    const sendButton = document.getElementById('send-button'); 

document.getElementById('chat-form').addEventListener('submit', function (event) {
    event.preventDefault();

    var userMessage = document.getElementById('user_message').value.trim();
    
    if (!userMessage) {
        return;
    }

    if (isWaitingForResponse) {
        return;
    }

    isWaitingForResponse = true;
    
    sendButton.innerHTML = '<div class="loader"></div>';
    
    displayMessage('You', userMessage);
    document.getElementById('user_message').value = '';
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
            sendButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 32 32" class="icon-2xl">
                <path fill="currentColor" fill-rule="evenodd" d="M15.192 8.906a1.143 1.143 0 0 1 1.616 0l5.143 5.143a1.143 1.143 0 0 1-1.616 1.616l-3.192-3.192v9.813a1.143 1.143 0 0 1-2.286 0v-9.813l-3.192 3.192a1.143 1.143 0 1 1-1.616-1.616z" clip-rule="evenodd"></path>
            </svg>`;
            isWaitingForResponse = false;
        } else {
            console.error('Request failed. Error:', xhr.statusText);
            sendButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 32 32" class="icon-2xl">
                <path fill="currentColor" fill-rule="evenodd" d="M15.192 8.906a1.143 1.143 0 0 1 1.616 0l5.143 5.143a1.143 1.143 0 0 1-1.616 1.616l-3.192-3.192v9.813a1.143 1.143 0 0 1-2.286 0v-9.813l-3.192 3.192a1.143 1.143 0 1 1-1.616-1.616z" clip-rule="evenodd"></path>
            </svg>`;
            isWaitingForResponse = false;
        }
    };

    xhr.onerror = function () {
        console.error('Request failed');
        sendButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 32 32" class="icon-2xl">
            <path fill="currentColor" fill-rule="evenodd" d="M15.192 8.906a1.143 1.143 0 0 1 1.616 0l5.143 5.143a1.143 1.143 0 0 1-1.616 1.616l-3.192-3.192v9.813a1.143 1.143 0 0 1-2.286 0v-9.813l-3.192 3.192a1.143 1.143 0 1 1-1.616-1.616z" clip-rule="evenodd"></path>
        </svg>`;
        isWaitingForResponse = false;
    };

    var requestData = {
        user_message: userMessage,
        prompt_card_id: 2
    };
    xhr.send(JSON.stringify(requestData)); 
});

    var md = window.markdownit();

    function displayMessage(role, message) {
        var chatMessages = document.getElementById('message-container');
        var messageContainer = document.createElement('div');
        messageContainer.classList.add('message', role.toLowerCase());

        var parsedMessage = role === 'AI' ? md.render(message) : message;

        messageContainer.innerHTML = `
            <div class="content">
                <p class="font-semibold">${role}</p>
                <p >${parsedMessage}</p>
            </div>
        `;
        chatMessages.appendChild(messageContainer); 
        chatMessages.scrollTop = chatMessages.scrollHeight; 
    }
        document.addEventListener('DOMContentLoaded', function () {
        var initialMessage = "<?php echo isset($_POST['initial_message']) ? $_POST['initial_message'] : ''; ?>";
        var promptCardId = "<?php echo isset($_POST['prompt_card_id']) ? $_POST['prompt_card_id'] : ''; ?>";

        if (initialMessage) {
            sendMessage(initialMessage, promptCardId);
        }
    });

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
fetch('api/get_user_info.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('userName').textContent = data.name;
                document.getElementById('userEmail').textContent = data.email;
            } else {
                console.error('Kullanıcı bilgileri alınamadı:', data.error);
            }
        })
        .catch(error => console.error('Fetch hatası:', error));
    
    </script>

</body>

</html>
