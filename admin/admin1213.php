<?php
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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT); // Hash password

    $sql = "INSERT INTO student (id, name, email, pass) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $id, $name, $email, $pass);

    if ($stmt->execute()) {
        echo "<script>alert('User added successfully'); window.location.href=window.location.href;</script>";
    } else {
        echo "<script>alert('Error adding user: " . $conn->error . "');</script>";
    }

    $stmt->close();
}

// Handle Edit User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE student SET name=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully'); window.location.href=window.location.href;</script>";
    } else {
        echo "<script>alert('Error updating user: " . $conn->error . "');</script>";
    }

    $stmt->close();
}

// Handle Delete User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM student WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully'); window.location.href=window.location.href;</script>";
    } else {
        echo "<script>alert('Error deleting user: " . $conn->error . "');</script>";
    }

    $stmt->close();
}

// Fetch all users
$sql = "SELECT id, name, email FROM student";
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
    <title>User Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">ULRA Admin</div>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#dashboard" class="nav-link active">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#users" class="nav-link">
                        <i class="fas fa-users"></i>
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#courses" class="nav-link">
                        <i class="fas fa-book"></i>
                        Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#messages" class="nav-link">
                        <i class="fas fa-envelope"></i>
                        Messages
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#analytics" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        Analytics
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#notifications" class="nav-link">
                        <i class="fas fa-bell"></i>
                        Notifications
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#security" class="nav-link">
                        <i class="fas fa-shield-alt"></i>
                        Security
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <button class="btn" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                </div>
                <div class="user-menu">
                    <button class="btn">
                        <i class="fas fa-user"></i>
                    </button>
                </div>
            </header>

            <!-- Dashboard Overview -->
            <div class="cards-grid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Total Users</h3>
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-content">
                        <h2>1,234</h2>
                        <p>Active users: 892</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Active Courses</h3>
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-content">
                        <h2>45</h2>
                        <p>Total enrolled: 3,567</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">System Status</h3>
                        <i class="fas fa-server"></i>
                    </div>
                    <div class="card-content">
                        <span class="status status-active">Online</span>
                        <p>Last updated: 2 min ago</p>
                    </div>
                </div>
            </div>

            <!-- User Management Table -->
            <div class="table-container">
            <div class="card-header">
                    <h3 class="card-title">User Management</h3>
                    <button class="btn btn-primary" id="addUserButton">Add User</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                            <th>Last Active</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                <button class="btn btn-primary edit-btn" data-id="<?= $user['id'] ?>" data-name="<?= $user['name'] ?>" data-email="<?= $user['email'] ?>">Edit</button>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <button type="submit" class="btn btn-danger" name="delete_user">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <h2>Add New User</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="id">User ID</label>
                    <input type="number" id="id" name="id" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-primary" id="closeModal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <h2>Edit User</h2>
            <form method="POST" action="">
                <input type="hidden" id="edit-id" name="id">
                <div class="form-group">
                    <label for="edit-name">Name</label>
                    <input type="text" id="edit-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit-email">Email</label>
                    <input type="email" id="edit-email" name="email" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-primary" id="closeEditModal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="edit_user">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal elements
        const addUserButton = document.getElementById('addUserButton');
        const addUserModal = document.getElementById('addUserModal');
        const closeModal = document.getElementById('closeModal');
        const editUserModal = document.getElementById('editUserModal');
        const closeEditModal = document.getElementById('closeEditModal');

        // Open Add User Modal
        addUserButton.addEventListener('click', () => addUserModal.classList.add('active'));
        closeModal.addEventListener('click', () => addUserModal.classList.remove('active'));

        // Open Edit User Modal
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');

                document.getElementById('edit-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-email').value = email;

                editUserModal.classList.add('active');
            });
        });

        // Close Edit User Modal
        closeEditModal.addEventListener('click', () => editUserModal.classList.remove('active'));
    </script>
</body>
</html>

