<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messaging Box</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            height: 80vh;
        }

        .contacts {
            width: 30%;
            border-right: 1px solid #ccc;
            padding: 10px;
        }

        .chat-window {
            width: 70%;
            display: flex;
            flex-direction: column;
        }

        #chatHeader {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #e9e9e9;
        }

        #contactProfilePic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        #messagesDisplay {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #fff;
        }

        .message {
            margin-bottom: 10px;
        }

        .message.sent {
            text-align: right;
        }

        .message.received {
            text-align: left;
        }

        .message-input {
            display: flex;
            padding: 10px;
            background-color: #e9e9e9;
        }

        .message-input input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        .message-input button {
            padding: 10px;
            margin-left: 5px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        #search {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="contacts">
            <input type="text" id="search" placeholder="Search Contacts..." oninput="filterContacts()">
            <ul id="contactsList"></ul>
        </div>
        <div class="chat-window">
            <div id="chatHeader">
                <img id="contactProfilePic" src="" alt="Profile Picture">
                <span id="contactName"></span>
            </div>
            <div id="messagesDisplay"></div>
            <div class="message-input">
                <input type="text" id="messageInput" placeholder="Type a message..." oninput="typingIndicator()">
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>
    <script>
        let currentUser  = 'User  1'; // Replace with actual logged-in user
        let currentContact = null;
        let typingTimeout;

        const contacts = [
            { name: 'User  2', profilePic: 'https://via.placeholder.com/40', online: true },
            { name: 'User  3', profilePic: 'https://via.placeholder.com/40', online: false },
        ];

        const messages = {
            'User  2': [],
            'User  3': []
        };

        function loadContacts() {
            const contactsList = document.getElementById('contactsList');
            contacts.forEach(contact => {
                const li = document.createElement('li');
                li.innerHTML = `<img src="${contact.profilePic}" alt="Profile Picture"> ${contact.name} ${contact.online ? '🟢' : '🔴'}`;
                li.onclick = () => selectContact(contact.name);
                contactsList.appendChild(li);
            });
        }

        function selectContact(name) {
            currentContact = name;
            document.getElementById('contactName').innerText = name;
            document.getElementById('contactProfilePic').src = contacts.find(c => c.name === name).profilePic;
            loadMessages();
        }

        function loadMessages() {
            const messagesDisplay = document.getElementById('messagesDisplay');
            messagesDisplay.innerHTML = '';
            messages[currentContact].forEach(msg => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message', msg.sender === currentContact ? 'sent' : 'received');
                messageElement.innerText = msg.text;
                messagesDisplay.appendChild(messageElement);
            });
            messagesDisplay.scrollTop = messagesDisplay.scrollHeight; // Scroll to the bottom
        }

        function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const messageText = messageInput.value.trim();
            if (messageText && currentContact) {
                messages[currentContact].push({ text: messageText, sender: currentUser });
                loadMessages();
                messageInput.value = ''; // Clear input
            }
        }

        function filterContacts() {
            const searchValue = document.getElementById('search').value.toLowerCase();
            const contactsList = document.getElementById('contactsList');
            contactsList.innerHTML = '';
            contacts.forEach(contact => {
                if (contact.name.toLowerCase().includes(searchValue)) {
                    const li = document.createElement('li');
                    li.innerHTML = `<img src="${contact.profilePic}" alt="Profile Picture"> ${contact.name} ${contact.online ? '🟢' : '🔴'}`;
                    li.onclick = () => selectContact(contact.name);
                    contactsList.appendChild(li);
                }
            });
        }

        function typingIndicator() {
            clearTimeout(typingTimeout);
            // You can implement typing indicator logic here if needed
            typingTimeout = setTimeout(() => {
                // Reset typing indicator after a delay
            }, 1000);
        }

        // Initialize contacts on page load
        loadContacts();
    </script>
</body>
</html>