<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University LMS Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #16a34a;
            --danger-color: #dc2626;
            --warning-color: #d97706;
            --text-color: #1f2937;
            --bg-color: #f3f4f6;
            --sidebar-width: 250px;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        /* Layout */
        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            padding: 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 1rem;
        }

        .sidebar-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin: 0.5rem 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: var(--primary-color);
            color: white;
        }

        .nav-link i {
            margin-right: 0.75rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .search-bar {
            flex: 1;
            max-width: 400px;
            margin: 0 2rem;
        }

        .search-bar input {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Tables */
        .table-container {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .status {
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.875rem;
        }

        .status-active {
            background: #dcfce7;
            color: var(--success-color);
        }

        .status-inactive {
            background: #fee2e2;
            color: var(--danger-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Notifications */
        .notifications {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
        }

        .notification {
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 0.5rem;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Charts container */
        .chart-container {
            height: 300px;
            margin: 1rem 0;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 300px;
            max-width: 500px;
        }

        .close {
            position: absolute;
            right: 1rem;
            top: 1rem;
            cursor: pointer;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
        }
    </style>
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
                    <button class="btn btn-primary" onclick="showModal('add-user')">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Student</td>
                            <td><span class="status status-active">Active</span></td>
                            <td>2 hours ago</td>
                            <td>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Faculty</td>
                            <td><span class="status status-active">Active</span></td>
                            <td>5 minutes ago</td>
                            <td>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Add User Modal -->
    <div id="add-user-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New User</h2>
            <form id="add-user-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email
