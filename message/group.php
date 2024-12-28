<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Chat System</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f9fafb;
            --sidebar-bg: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --message-bg: #ffffff;
            --sent-message-bg: #4f46e5;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            height: 100vh;
            background-color: var(--bg-color);
            color: var(--text-primary);
        }

        .container {
            display: flex;
            height: 100vh;
            max-width: 1920px;
            margin: 0 auto;
            background: var(--bg-color);
        }

        .sidebar {
            width: 320px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--bg-color);
        }

        .header {
            padding: 1.5rem;
            background: var(--sidebar-bg);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .group-list {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .group-item {
            padding: 1rem;
            margin-bottom: 0.75rem;
            background: var(--bg-color);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid var(--border-color);
            font-weight: 500;
        }

        .group-item:hover {
            background: var(--message-bg);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .group-item.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .chat-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--bg-color);
            margin: 1rem;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            background: white;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .message {
            padding: 1rem;
            background: var(--message-bg);
            border-radius: 12px;
            max-width: 70%;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }

        .message:hover {
            box-shadow: var(--shadow-md);
        }

        .message.sent {
            margin-left: auto;
            background: var(--sent-message-bg);
            color: white;
            border: none;
        }

        .message-input {
            padding: 1.5rem;
            background: var(--message-bg);
            border-top: 1px solid var(--border-color);
            display: flex;
            gap: 1rem;
            border-radius: 0 0 12px 12px;
        }

        input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            outline: none;
        }

        input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        button {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        button:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .add-group {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .user-status {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-color);
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 0 2px white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: var(--sidebar-bg);
            padding: 2rem;
            border-radius: 16px;
            width: 480px;
            box-shadow: var(--shadow-lg);
            animation: modalFade 0.3s ease;
        }

        @keyframes modalFade {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-list {
            max-height: 240px;
            overflow-y: auto;
            margin: 1.5rem 0;
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }

        .user-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }

        .user-item:last-child {
            border-bottom: none;
        }

        .user-item:hover {
            background: var(--bg-color);
        }

        .typing-indicator {
            padding: 0.75rem 1.5rem;
            font-style: italic;
            color: var(--text-secondary);
            background: var(--bg-color);
            border-radius: 8px;
            margin: 0 1.5rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                max-height: 40vh;
            }

            .chat-container {
                margin: 0.5rem;
            }

            .message {
                max-width: 85%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="user-status">
                <div class="status-indicator"></div>
                <span>Group Chat</span>
            </div>
            <div class="add-group">
                <button onclick="showCreateGroupModal()" style="width: 100%;">Create New Group</button>
            </div>
            <div class="group-list" id="groupList">
                <!-- Groups will be added here -->
            </div>
        </div>

        <div class="main-content">
            <div class="header">
                <h2 id="currentGroupName">Select a group</h2>
            </div>
            <div class="chat-container">
                <div class="chat-messages" id="chatMessages">
                    <!-- Messages will be added here -->
                </div>
                <div class="typing-indicator" id="typingIndicator"></div>
                <div class="message-input">
                    <input type="text" id="messageInput" placeholder="Type a message...">
                    <button onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="createGroupModal">
        <div class="modal-content">
            <h2>Create New Group</h2>
            <div style="margin: 1rem 0;">
                <input type="text" id="groupNameInput" placeholder="Group Name" style="width: 100%; margin-bottom: 1rem;">
                <div class="user-list" id="userList">
                    <!-- Users will be added here -->
                </div>
                <button onclick="createGroup()">Create Group</button>
                <button onclick="hideCreateGroupModal()" style="background: #666;">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // Simulated data
        const users = [
            { id: 1, name: 'User 1' },
            { id: 2, name: 'User 2' },
            { id: 3, name: 'User 3' }
        ];

        let currentGroup = null;
        let groups = [];
        let messages = {};
        let typingTimeout = null;
        const currentUser = { id: 1, name: 'User 1' }; // Default user

        // Group management
        function showCreateGroupModal() {
            const modal = document.getElementById('createGroupModal');
            const userList = document.getElementById('userList');
            modal.style.display = 'flex';

            userList.innerHTML = users
                .filter(user => user.id !== currentUser.id)
                .map(user => `
                    <div class="user-item">
                        <input type="checkbox" value="${user.id}">
                        <span>${user.name}</span>
                    </div>
                `).join('');
        }

        function hideCreateGroupModal() {
            document.getElementById('createGroupModal').style.display = 'none';
        }

        function createGroup() {
            const groupName = document.getElementById('groupNameInput').value;
            if (!groupName) {
                alert('Please enter a group name');
                return;
            }

            const selectedUsers = Array.from(document.querySelectorAll('#userList input:checked'))
                .map(input => parseInt(input.value));
            
            const newGroup = {
                id: Date.now(),
                name: groupName,
                members: [currentUser.id, ...selectedUsers],
                admin: currentUser.id
            };

            groups.push(newGroup);
            messages[newGroup.id] = [];
            loadGroups();
            hideCreateGroupModal();
            selectGroup(newGroup);
        }

        function loadGroups() {
            const groupList = document.getElementById('groupList');
            groupList.innerHTML = groups
                .filter(group => group.members.includes(currentUser.id))
                .map(group => `
                    <div class="group-item ${currentGroup?.id === group.id ? 'active' : ''}" 
                         onclick="selectGroup(${JSON.stringify(group)})">
                        ${group.name}
                    </div>
                `).join('');
        }

        function selectGroup(group) {
            currentGroup = group;
            document.getElementById('currentGroupName').textContent = group.name;
            loadMessages();
            loadGroups();
        }

        // Message handling
        function sendMessage() {
            const input = document.getElementById('messageInput');
            const content = input.value.trim();
            
            if (!content || !currentGroup) return;

            const message = {
                id: Date.now(),
                sender: currentUser.id,
                content,
                timestamp: new Date().toISOString()
            };

            messages[currentGroup.id].push(message);
            input.value = '';
            loadMessages();
        }

        function loadMessages() {
            if (!currentGroup) return;

            const chatMessages = document.getElementById('chatMessages');
            chatMessages.innerHTML = messages[currentGroup.id]
                .map(message => `
                    <div class="message ${message.sender === currentUser.id ? 'sent' : ''}">
                        <div style="font-weight: bold;">
                            ${users.find(u => u.id === message.sender).name}
                        </div>
                        ${message.content}
                    </div>
                `).join('');
            
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Typing indicator
        document.getElementById('messageInput').addEventListener('input', function() {
            if (!currentGroup) return;

            clearTimeout(typingTimeout);
            document.getElementById('typingIndicator').textContent = `${currentUser.name} is typing...`;
            
            typingTimeout = setTimeout(() => {
                document.getElementById('typingIndicator').textContent = '';
            }, 1000);
        });

        // Initialize with demo data
        window.onload = function() {
            // Create a demo group
            groups.push({
                id: 1,
                name: 'Demo Group',
                members: [1, 2, 3],
                admin: 1
            });

            messages[1] = [
                {
                    id: 1,
                    sender: 2,
                    content: 'Hello everyone!',
                    timestamp: new Date().toISOString()
                }
            ];

            loadGroups();
        };
    </script>
</body>
</html>