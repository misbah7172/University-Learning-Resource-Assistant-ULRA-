<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Learning Management System</title>
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f8f9fa;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        /* Add new emoji picker styles */
        .message-input-container {
            position: relative;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .emoji-picker-button {
            padding: 12px;
            background-color: transparent;
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.2em;
        }

        .emoji-picker-button:hover {
            background-color: var(--secondary-color);
            border-color: var(--primary-color);
        }

        .emoji-picker {
            position: absolute;
            bottom: 100%;
            left: 0;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius);
            padding: 10px;
            margin-bottom: 10px;
            box-shadow: var(--box-shadow);
            display: none;
            z-index: 1000;
            width: 300px;
            max-height: 300px;
            overflow-y: auto;
        }

        .emoji-picker.active {
            display: block;
            animation: fadeIn 0.2s ease;
        }

        .emoji-category {
            margin-bottom: 10px;
        }

        .emoji-category-title {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 5px;
            padding: 5px;
            background: var(--secondary-color);
            border-radius: 4px;
        }

        .emoji-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 5px;
        }

        .emoji {
            font-size: 1.5em;
            padding: 5px;
            cursor: pointer;
            text-align: center;
            border-radius: 4px;
            transition: var(--transition);
        }

        .emoji:hover {
            background-color: var(--secondary-color);
            transform: scale(1.2);
        }

        /* Existing styles remain the same */
        .message-display {
            border: 2px solid #e0e0e0;
            padding: 20px;
            height: 400px;
            overflow-y: scroll;
            background-color: var(--secondary-color);
            border-radius: var(--border-radius);
            margin-bottom: 25px;
        }

        .message {
            background: white;
            padding: 12px 16px;
            border-radius: var(--border-radius);
            margin-bottom: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.2em;
            font-weight: 600;
        }

        .section-selector {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
        }

        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius);
            background-color: white;
            font-size: 1em;
            transition: var(--transition);
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px auto;
        }

        select:hover {
            border-color: var(--primary-color);
        }

        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }

        .message-display {
            border: 2px solid #e0e0e0;
            padding: 20px;
            height: 400px;
            overflow-y: scroll;
            background-color: var(--secondary-color);
            border-radius: var(--border-radius);
            margin-bottom: 25px;
        }

        .message {
            background: white;
            padding: 12px 16px;
            border-radius: var(--border-radius);
            margin-bottom: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .timestamp {
            font-size: 0.8em;
            color: #888;
            margin-top: 4px;
            display: block;
        }

        .message-input {
            display: flex;
            gap: 12px;
        }

        input[type="text"] {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius);
            font-size: 1em;
            transition: var(--transition);
        }

        input[type="text"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }

        button {
            padding: 12px 24px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1em;
            cursor: pointer;
            transition: var(--transition);
        }

        button:hover {
            background-color: #357abd;
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(0);
        }

        /* Custom scrollbar */
        .message-display::-webkit-scrollbar {
            width: 8px;
        }

        .message-display::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .message-display::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .message-display::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.8em;
            }

            .message-input {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Message Box</h1>
        <div class="section-selector">
            <label for="sections">Select Course:</label>
            <select id="sections" onchange="loadMessages()">
                <option value="math">Mathematics 101</option>
                <option value="physics">Physics 201</option>
            </select>
        </div>
        <div class="section-selector">
            <label for="sections">Select Section:</label>
            <select id="sections" onchange="loadMessages()">
                <option value="math">Section A</option>
                <option value="physics">Section B</option>
            </select>
        </div>
        <div class="message-display" id="messageDisplay"></div>
        <div class="message-input-container">
            <button class="emoji-picker-button" onclick="toggleEmojiPicker()">😊</button>
            <div class="emoji-picker" id="emojiPicker">
                <!-- Emoji categories will be populated by JavaScript -->
            </div>
            <input type="text" id="messageInput" placeholder="Type your message here..." oninput="suggestMessage()">
            <button onclick="postMessage()">Send</button>
        </div>
    </div>
    <script>
        function loadMessages() {
            const section = document.getElementById('sections').value;
            const messageDisplay = document.getElementById('messageDisplay');
            messageDisplay.innerHTML = '';

            messages[section].forEach(msg => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.innerHTML = `<strong>${msg.sender}</strong>: ${msg.text} <span class="timestamp">${msg.timestamp}</span>`;
                messageDisplay.appendChild(messageElement);
            });
        }

        function postMessage() {
            const section = document.getElementById('sections').value;
            const messageInput = document.getElementById('messageInput');
            const messageText = messageInput.value.trim();

            if (messageText) {
                const newMessage = {
                    sender: 'User', // Replace with actual user name
                    text: messageText,
                    timestamp: new Date().toLocaleString()
                };

                messages[section].push(newMessage);
                messageInput.value = ''; // Clear input
                loadMessages(); // Refresh message display
            }
        }

        function suggestMessage() {
            // Placeholder for auto-suggestions
            // This could be enhanced with an actual suggestion algorithm
        }
    </script>
    <script>
        let messages = {
            math: [],
            physics: []
        };

        // Emoji categories and their emojis
        const emojiCategories = {
            'Smileys': ['😀', '😃', '😄', '😁', '😅', '😂', '🤣', '😊', '😇', '🙂', '😉', '😌', '😍', '🥰', '😘'],
            'Gestures': ['👍', '👎', '👋', '🤝', '✌️', '🤞', '🤟', '🤘', '👌', '🤌'],
            'Education': ['📚', '📖', '✏️', '📝', '📓', '🎓', '🔬', '🔭', '📐', '📏'],
            'Objects': ['💻', '📱', '⌚️', '📷', '🎮', '🎨', '🎭', '🎪', '🎫', '🎟️'],
            'Symbols': ['❤️', '💔', '💫', '💥', '💢', '💦', '💨', '🕉️', '☮️', '✝️']
        };

        // Initialize emoji picker
        function initializeEmojiPicker() {
            const emojiPicker = document.getElementById('emojiPicker');
            
            for (const [category, emojis] of Object.entries(emojiCategories)) {
                const categoryDiv = document.createElement('div');
                categoryDiv.className = 'emoji-category';
                
                const categoryTitle = document.createElement('div');
                categoryTitle.className = 'emoji-category-title';
                categoryTitle.textContent = category;
                
                const emojiGrid = document.createElement('div');
                emojiGrid.className = 'emoji-grid';
                
                emojis.forEach(emoji => {
                    const emojiSpan = document.createElement('span');
                    emojiSpan.className = 'emoji';
                    emojiSpan.textContent = emoji;
                    emojiSpan.onclick = () => insertEmoji(emoji);
                    emojiGrid.appendChild(emojiSpan);
                });
                
                categoryDiv.appendChild(categoryTitle);
                categoryDiv.appendChild(emojiGrid);
                emojiPicker.appendChild(categoryDiv);
            }
        }

        // Toggle emoji picker
        function toggleEmojiPicker() {
            const emojiPicker = document.getElementById('emojiPicker');
            emojiPicker.classList.toggle('active');
        }

        // Insert emoji into message input
        function insertEmoji(emoji) {
            const messageInput = document.getElementById('messageInput');
            const cursorPos = messageInput.selectionStart;
            const textBefore = messageInput.value.substring(0, cursorPos);
            const textAfter = messageInput.value.substring(cursorPos);
            
            messageInput.value = textBefore + emoji + textAfter;
            messageInput.focus();
            const newCursorPos = cursorPos + emoji.length;
            messageInput.setSelectionRange(newCursorPos, newCursorPos);
        }

        // Close emoji picker when clicking outside
        document.addEventListener('click', (event) => {
            const emojiPicker = document.getElementById('emojiPicker');
            const emojiButton = document.querySelector('.emoji-picker-button');
            
            if (!emojiPicker.contains(event.target) && !emojiButton.contains(event.target)) {
                emojiPicker.classList.remove('active');
            }
        });

        // Existing functions
        function loadMessages() {
            const section = document.getElementById('sections').value;
            const messageDisplay = document.getElementById('messageDisplay');
            messageDisplay.innerHTML = '';
            messages[section].forEach(msg => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.innerHTML = `<strong>${msg.sender}</strong>: ${msg.text} <span class="timestamp">${msg.timestamp}</span>`;
                messageDisplay.appendChild(messageElement);
            });
        }

        function postMessage() {
            const section = document.getElementById('sections').value;
            const messageInput = document.getElementById('messageInput');
            const messageText = messageInput.value.trim();
            if (messageText) {
                const newMessage = {
                    sender: 'User',
                    text: messageText,
                    timestamp: new Date().toLocaleString()
                };
                messages[section].push(newMessage);
                messageInput.value = '';
                loadMessages();
            }
        }

        function suggestMessage() {
            // Placeholder for auto-suggestions
        }

        // Initialize emoji picker when page loads
        window.onload = initializeEmojiPicker;
    </script>
</body>
</html>