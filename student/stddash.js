// Purpose: JavaScript file for the student dashboard page.
        document.getElementById('calendarSidebarItem').addEventListener('click', function() {
            var calendar = document.getElementById('calendar');
            if (calendar.style.display === 'none' || calendar.style.display === '') {
                calendar.style.display = 'block';
            } else {
                calendar.style.display = 'none';
            }
        });
        const mockPersonalNotes = [
            { id: 1, title: 'Project Brainstorm', content: 'Key ideas for semester project...' },
            { id: 2, title: 'Study Plan', content: 'Weekly study schedule...' },
            { id: 3, title: 'Research Notes', content: 'Important research methodology...' },
            { id: 4, title: 'Internship Prep', content: 'Companies to apply to...' },
            { id: 5, title: 'Career Goals', content: 'Long-term career planning...' },
            { id: 6, title: 'Networking', content: 'Contacts and professional network...' }
        ];

        // Sidebar Toggle Functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            
            sidebar.classList.toggle('sidebar-expanded');
            sidebar.classList.toggle('sidebar-collapsed');
            
            sidebarTexts.forEach(text => {
                text.classList.toggle('hidden');
                calendar.style.display = 'none';
            });
        });

        // Populate Assignments
        function populateAssignments() {
            const assignmentsBody = document.getElementById('assignmentsBody');
            assignmentsBody.innerHTML =

            assignmentsBody.innerHTML = mockAssignments.map(assignment => `
                <tr class="${assignment.status === 'urgent' ? 'bg-red-50 text-red-600' : 'hover:bg-gray-50'}">
                    <td class="p-2">${assignment.title}</td>
                    <td class="p-2">${assignment.course}</td>
                    <td class="p-2">${assignment.dueDate}</td>
                    <td class="p-2">
                        <span class="${assignment.status === 'urgent' ? 'text-red-600' : 'text-green-600'}">
                            ${assignment.status === 'urgent' ? 'Urgent' : 'Normal'}
                        </span>
                    </td>
                </tr>
            `).join('');
        }

        // Mock data for messages
const mockMessages = [
];

// Populate Messages
function populateMessages() {
    const messagesContainer = document.getElementById('personalNotesContainer');
    messagesContainer.innerHTML = mockMessages.map(message => {
        if (message.type === 'file') {
            return `
                <div class="bg-gray-100 p-3 rounded mb-2">
                    <p class="text-gray-800">File sent: <span class="bg-gray-200 p-1 rounded">${message.content}</span></p>
                </div>
            `;
        } else {
            return `
                <div class="bg-gray-100 p-3 rounded mb-2">
                    <p class="text-gray-800">${message.content}</p>
                </div>
            `;
        }
    }).join('');
}

// Send Message Functionality
document.getElementById('sendMessageBtn').addEventListener('click', function() {
    const messageInput = document.getElementById('messageInput');
    const content = messageInput.value.trim();
    
    if (content) {
        mockMessages.push({
            id: mockMessages.length + 1,
            type: 'text',
            content
        });
        populateMessages();
        messageInput.value = ''; // Clear the input field
    }
});

// Send File Functionality
document.getElementById('sendFileBtn').addEventListener('click', function() {
    const fileInput = document.getElementById('fileInput');
    fileInput.click();
});

document.getElementById('fileInput').addEventListener('change', function() {
    const file = fileInput.files[0];
    if (file) {
        mockMessages.push({
            id: mockMessages.length + 1,
            type: 'file',
            content: file.name
        });
        populateMessages();
        fileInput.value = ''; // Clear the file input
    }
});

// Initial population of messages
populateMessages();

        // Logout Functionality
        document.getElementById('logoutBtn').addEventListener('click', function() {
            alert('Logging out...');
            // Add actual logout logic here (redirect to login page, clear session, etc.)
            window.location.href = '#login'; // Placeholder redirect
        });

        // Initialize Calendar
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Full Calendar
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                height: 'auto'
            });
            calendar.render();
            calendarEl.style.display = 'none';

            // Populate content
            populateAssignments();
            populatePersonalNotes();
        });
        // Function to format time remaining in HH:MM:SS format
function formatTimeRemaining(dueDate) {
    const now = new Date();
    const timeRemaining = dueDate - now;

    if (timeRemaining <= 0) {
        return "00:00:00"; // Assignment is overdue
    }

    const totalSeconds = Math.floor(timeRemaining / 1000);
    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;

    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}

// Populate Assignments
function populateAssignments() {
    const assignmentsBody = document.getElementById('assignmentsBody');
    assignmentsBody.innerHTML = mockAssignments.map(assignment => {
        const dueDate = new Date(assignment.dueDate + "T23:59:59"); // Assuming due date is at the end of the day
        const timeRemaining = formatTimeRemaining(dueDate);
        return `
            <tr class="${assignment.status === 'urgent' ? 'bg-red-50 text-red-600' : 'hover:bg-gray-50'}">
                <td class="p-2">${assignment.title}</td>
                <td class="p-2">${assignment.course}</td>
                <td class="p-2">${assignment.dueDate}</td>
                <td class="p-2">
                    <span>${timeRemaining}</span>
                </td>
            </tr>
        `;
    }).join('');
}

// Update the assignments every second
setInterval(populateAssignments, 1000); // Refresh the assignments every second
        function setReminder(assignmentTitle) {
            const reminderTime = prompt("Please enter the reminder time (e.g., '2024-11-29T08:00') for " + assignmentTitle);
            if (reminderTime) {
                // Here you would typically save the reminder to a database or local storage
                alert("Reminder set for " + assignmentTitle + " at " + reminderTime);
                // You can also add code to integrate with a reminder API or service
            } else {
                alert("Reminder not set.");
            }
        }
    function toggleNotifications() {
        const notificationList = document.getElementById('notificationList');
        notificationList.classList.toggle('hidden');
    }

    // Optional: Close the notification list when clicking outside of it
    window.onclick = function(event) {
        const notificationList = document.getElementById('notificationList');
        const icon = document.querySelector('.cursor-pointer');

        if (!icon.contains(event.target) && !notificationList.contains(event.target)) {
            notificationList.classList.add('hidden');
        }
    };
    