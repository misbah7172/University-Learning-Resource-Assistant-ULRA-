<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $servername = "localhost"; // Change if hosted elsewhere
    $username = "root";        // Database username
    $password = "";            // Database password
    $dbname = "ulra";          // Database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Handle Add User
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user']) && isset($_POST['edit_user'])) {
        $id = $_POST['id'];
        $course_id = $_POST['course_id'];
        $topic = $_POST['topic'];
        $submit = $_POST['submit'];
        $lastdate = $_POST['lastdate'];
        $upload_time = $_POST['upload_date'];

        $sql = "INSERT INTO student (id, course_id, topic, lastdate, upload_date) VALUES (?, ?, ?, ?)";

        $sql = "UPDATE student SET submit=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $id, $course_id, $topic, $lastdate);
        $stmt->bind_param("ssi", $submit, $id);

        if ($stmt->execute()) {
            echo "<script>alert('User added successfully'); window.location.href=window.location.href;</script>";
        } else {
            echo "<script>alert('Error adding user: " . $conn->error . "');</script>";
        }

        $stmt->close();
    }

    // Handle Add User
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $noteid = $_POST['noteid'];
        $user_id = $_POST['user_id'];
        $message = $_POST['message'];
        $file_name = $_POST['file_name'];
        $file_type = $_POST['file_type'];
        $file_data = $_POST['file_data'];

        $notesql = "INSERT INTO notes (noteid, user_id, message, file_name, file_type, file_data) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($notesql);
        $stmt->bind_param("iissss", $noteid, $user_id, $message, $file_name, $file_type, $file_data);

        if ($stmt->execute()) {
            echo "<script>alert('Message added successfully'); window.location.href=window.location.href;</script>";
        } else {
            echo "<script>alert('Error adding message: " . $conn->error . "');</script>";
        }

        $stmt->close();
    }

    // Fetch all messages
    $notesql = "SELECT noteid, user_id, message, file_name, file_type, file_data FROM notes";
    $noteresult = $conn->query($notesql);
    $messages = [];
    if ($noteresult->num_rows > 0) {
        while ($row = $noteresult->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    // Fetch all users
    $sql = "SELECT id, course_id, topic, lastdate, upload_date FROM assignment";
    $result = $conn->query($sql);
    $users = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Learning Resource Assistant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="stddash.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="fixed top-0 left-0 w-full bg-blue-600 text-white flex justify-between items-center p-4 z-50">
        <div class="flex items-center space-x-4 w-full">
            <img src="ULRA.png" alt="University Logo" class="h-10 mr-4">
            
            <!-- Search Bar -->
            <div class="flex-grow mx-4">
                <input 
                    type="text" 
                    placeholder="Search resources, courses, users..." 
                    class="w-full p-2 rounded text-black"
                >
            </div>

            <div class="flex items-center space-x-4">
                <!-- Active Status -->
                <div class="flex items-center">
                    <span class="active-status-dot"></span>
                    <span>Active</span>
                </div>

                <!-- Theme Switcher -->
                <label class="swap swap-rotate">
                    <!-- this hidden checkbox controls the state -->
                    <input type="checkbox" class="theme-controller" value="synthwave" />
                  
                    <!-- sun icon -->
                    <svg
                      class="swap-off h-10 w-10 fill-current"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24">
                      <path
                        d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                    </svg>
                  
                    <!-- moon icon -->
                    <svg
                      class="swap-on h-10 w-10 fill-current"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24">
                      <path
                        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                    </svg>
                  </label>

                <!-- Notifications -->
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" onclick="toggleNotifications()">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="notification-badge">3</span>

                    <!-- Notification List -->
                    <div id="notificationList" class="absolute right-0 mt-2 w-48 bg-black border border-gray-300 rounded-lg shadow-lg hidden">
                        <ul>
                            <li class="p-2 hover:bg-gray-100">Notification 1</li>
                            <li class="p-2 hover:bg-gray-100">Notification 2</li>
                            <li class="p-2 hover:bg-gray-100">Notification 3</li>
                        </ul>
                    </div>
                </div>

                <!-- User Profile and Logout -->
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/50" alt="User Avatar" class="w-10 h-10 rounded-full mr-2">
                    <span>misbah</span>
                    <button id="logoutBtn" class="ml-2 bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"><a href="logout.php">Logout</a></button>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-16 h-screen bg-white shadow-lg transition-all duration-300 sidebar-expanded border-r">
        <nav class="pt-4 text-black">
            <div id="sidebarToggle" class="p-3 cursor-pointer text-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>

            <!-- Calendar Placeholder -->
            <div id="calendar" class="p-2"></div>

            <!-- Sidebar Menu -->
            <div class="sidebar-menu text-black">
                <div id="calendarSidebarItem" class="sidebar-item flex items-center p-3 cursor-pointer hover:bg-gray-100" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="sidebar-text text-black">Calendar</span>
                </div>

                <div class="sidebar-item flex items-center p-3 cursor-pointer hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="sidebar-text text-black">Home</span>
                </div>

                <!-- Course List with Dropdown -->
                <div class="sidebar-item course-item flex items-center p-3 cursor-pointer hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="sidebar-text text-black"><a href="courses.php">My Courses</a></span>
                </div>

                <!-- Other Sidebar Items -->
                <div class="sidebar-item flex items-center p-3 cursor-pointer hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="sidebar-text text-black"><a href="../message/section.php">Section Messages</a></span>
                </div>
                
                <!-- Faculty Chat -->
                <div class="sidebar-item flex items-center p-3 cursor-pointer hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                    <span class="sidebar-text text-black"><a href="../message/facultychat.php">Faculty Chat</a></span>
                </div>

                <!-- Inbox -->
                <div class="sidebar-item flex items-center p-3 cursor-pointer hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4" />
                    </svg>
                    <span class="sidebar-text text-black"><a href="../message/p2p.php">Inbox</a></span>
                </div>
                <!-- Group Chat -->
                <div class="sidebar-item flex items-center p-3 cursor-pointer hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <span class="sidebar-text text-black"><a href="../message/group.php">Group Chat</a></span>
                </div>
                <!-- Library -->
                <div class="sidebar-item flex items-center p-3 cursor-pointer hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v2H4V4zm0 4h16v2H4V8zm0 4h16v2H4v-2zm0 4h16v2H4v-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 20h16v2H4v-2z" />
                    </svg>
                    <span class="sidebar-text text-black"><a href="../library/index.php">Library</a></span>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 mt-16 p-6">
        <div class="flex flex-col">
            <div class="flex justify-between mb-4">
                <h2 class="text-2xl font-bold text-black">Dashboard</h2>
            </div>
        </div>
        <div class="bg-black p-4 rounded-lg shadow mb-6">
            <h2 class="text-xl font-bold text-white">Important Announcement</h2>
            <p class="text-white">This is where you can add important messages or announcements for users.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Assignments Widget -->
            <div class="bg-white p-4 rounded-lg shadow text-black">
                <h2 class="text-xl font-semibold mb-4">Current Week Assignments</h2>
                <div class="scrollable-container">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100 sticky top-0">
                                <th class="p-2 text-left">ID</th>
                                <th class="p-2 text-left">Course ID</th>
                                <th class="p-2 text-left">Topic</th>
                                <th class="p-2 text-left">Time Remaining</th>
                                <th class="p-2 text-left">Submit</th>
                                <th class="p-2 text-left">Set Reminder</th>
                            </tr>
                        </thead>
                        <tbody id="assignmentsBody">
                            <!-- Assignments will be dynamically populated -->
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['id']) ?></td>
                                    <td><?= htmlspecialchars($user['course_id']) ?></td>
                                    <td><?= htmlspecialchars($user['topic']) ?></td>
                                    <td class="remaining-time" data-last-date="<?= htmlspecialchars($user['lastdate']) ?>"></td>
                                    <td>
                                        <button class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Submit</button>
                                    </td>
                                    <td>
                                        <button class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Reminder</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Personal Notes Widget -->
            <div class="bg-white p-4 rounded-lg shadow text-black">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Notes</h2>
            </div>
            <div id="personalNotesContainer" class="scrollable-container h-64 overflow-y-auto mb-4">
                <!-- Messages will be dynamically populated -->
            </div>
            <form id="messageForm" class="flex items-center space-x-2" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="note_id" value="<?php echo uniqid(); ?>">
                <input type="hidden" name="user_id" value="1"> <!-- Replace with dynamic user ID -->
                <input type="hidden" name="file_name" id="fileName">
                <input type="hidden" name="file_type" id="fileType">
                <input type="hidden" name="file_data" id="fileData">
                
                <input type="text" id="messageInput" name="message" class="flex-grow p-2 border rounded-l-lg" placeholder="Type a message...">
                <button type="button" id="sendMessageBtn" class="bg-blue-500 text-white p-2 rounded-r-lg hover:bg-blue-600">
                    Send
                </button>
                <input type="file" id="fileInput" class="hidden">
                <button type="button" id="sendFileBtn" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                    Send File
                </button>
            </form>
        </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 p-4 text-center mt-6">
        <div class="flex justify-center space-x-6">
            <a href="#" class="text-blue-600 hover:underline">Contact Us</a>
            <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
            <a href="#" class="text-blue-600 hover:underline">Help</a>
        </div>
        <p class="text-sm text-gray-500 mt-2">
            © 2024 University Learning Resource Assistant
        </p>
    </footer>

    <!-- External Scripts -->
    <script>
        function calculateRemainingTime(lastDate) {
            const lastDateObj = new Date(lastDate);
            const now = new Date();
            const remainingTime = lastDateObj - now;
            const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            return `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }

        function updateRemainingTimes() {
            const remainingTimeElements = document.querySelectorAll('.remaining-time');
            remainingTimeElements.forEach(element => {
                const lastDate = element.getAttribute('data-last-date');
                element.textContent = calculateRemainingTime(lastDate);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateRemainingTimes();
            setInterval(updateRemainingTimes, 1000); // Update every second
        });
    </script>
    <script>
        // Send Message Functionality
        const mockMessages = <?php echo json_encode($messages); ?>;

        // Populate Messages
        function populateMessages() {
            const messagesContainer = document.getElementById('personalNotesContainer');
            messagesContainer.innerHTML = mockMessages.map(message => {
                if (message.file_name) {
                    return `
                        <div class="bg-gray-100 p-3 rounded mb-2">
                            <p class="text-gray-800">File sent: <span class="bg-gray-200 p-1 rounded">${message.file_name}</span></p>
                        </div>
                    `;
                } else {
                    return `
                        <div class="bg-gray-100 p-3 rounded mb-2">
                            <p class="text-gray-800">${message.message}</p>
                        </div>
                    `;
                }
            }).join('');
        }

        // Send Message Functionality
        document.getElementById('sendMessageBtn').addEventListener('click', function() {
            document.getElementById('messageForm').submit();
        });

        // Send File Functionality
        document.getElementById('sendFileBtn').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function() {
            const file = document.getElementById('fileInput').files[0];
            if (file) {
                document.getElementById('fileName').value = file.name;
                document.getElementById('fileType').value = file.type;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('fileData').value = e.target.result;
                    document.getElementById('messageForm').submit();
                };
                reader.readAsDataURL(file);
            }
        });
        // Initial population of messages
        populateMessages();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="stddash.js"></script>
</body>
</html>