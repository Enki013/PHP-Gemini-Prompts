
const act_role_prompts = {
    "Doctor": "Sizden bir doktor gibi davranmanızı ve hastalıklar için yaratıcı tedaviler bulmanızı istiyorum. Geleneksel ilaçları, bitkisel ilaçları ve diğer doğal alternatifleri önerebilmelisiniz. Önerilerinizi sunarken hastanın yaşını, yaşam tarzını ve tıbbi geçmişini de göz önünde bulundurmanız gerekecek. İlk öneri talebim \"Artritten muzdarip yaşlı bir hasta için bütünsel şifa yöntemlerine odaklanan bir tedavi planı oluşturun\".",
    "Life Coach": "Bir yaşam koçu olarak hareket etmenizi istiyorum. Mevcut durumum ve hedeflerim hakkında bazı ayrıntılar vereceğim ve daha iyi kararlar almama ve bu hedeflere ulaşmama yardımcı olabilecek stratejiler bulmak sizin işiniz olacak. Bu, başarıya ulaşmak için planlar oluşturmak veya zor duygularla başa çıkmak gibi çeşitli konularda tavsiyeler sunmayı içerebilir. İlk talebim \"Stresi yönetmek için daha sağlıklı alışkanlıklar geliştirmek konusunda yardıma ihtiyacım var.\"",
}


var act_roles = "";


//add select-role-buttons id to the div add role buttons
var selectRoleButtons = document.getElementById("select-role-buttons");
//add buttons
for (var key in act_role_prompts) {
    var button = document.createElement("button");
    button.innerHTML = key;
    button.setAttribute("onclick", "selectRole('" + key + "')");
    selectRoleButtons.appendChild(button);
}

function selectRole(role) {
    act_roles = role;
    document.getElementById("act-role").innerHTML = role;
    document.getElementById("select-role-buttons").style.display = "none";
    document.getElementById("chat-container").style.display = "block";
    if (localStorage.getItem('chatHistory-' + act_roles) === null) {
        sendMessage(act_role_prompts[role]).then(function (response) {
            addMessage('Gemini', response);
        });
    }
}


var chatMessages = document.getElementById('chat-messages');
var userInput = document.getElementById('user-input');
var sendBtn = document.getElementById('send-btn');

// Function to add a message to the chat
function addMessage(sender, message) {
    var newMessage = document.createElement('div');
    newMessage.innerHTML = '<strong>' + sender + ':</strong> ' + marked.parse(message);
    chatMessages.appendChild(newMessage);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

const sendMessage = async (message) => {
    var message_history = (JSON.parse(localStorage.getItem('chatHistory')) || []);
    userInput.disabled = true;
    const response = await fetch('/chat.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            message: message,
            message_history: message_history
        })
    });
    const data = await response.json();
    console.log(data);
    userInput.disabled = false;

    addChatHistory({
        id: new Date().getTime(),
        you: message,
        gemini: data.message
    });
    return data.message;
};

sendBtn.addEventListener('click', function () {
    var userMessage = userInput.value.trim();
    if (userMessage !== '') {
        addMessage('You', userMessage);
        userInput.value = '';
        sendMessage(userMessage).then(function (response) {
            addMessage('Gemini', response);
        });
    }
});
userInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        sendBtn.click();
    }
});

const addChatHistory = async (chatHistory) => {
    var chatHistoryList = JSON.parse(localStorage.getItem('chatHistory-' + act_roles)) || [];
    chatHistoryList.push(chatHistory);
    localStorage.setItem('chatHistory-' + act_roles, JSON.stringify(chatHistoryList));
};

for (const chat of JSON.parse(localStorage.getItem('chatHistory-' + act_roles)) || []) {
    addMessage('You', chat.you);
    addMessage('Gemini', chat.gemini);
}