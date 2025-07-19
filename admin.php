<?php
include 'config.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}

$all_registrations = $conn->query("SELECT * FROM registrations")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THDC India Limited - Admin Portal</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ff5722;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .logo {
            height: 80px;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        .reg-card {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .user-form {
            margin-top: 20px;
            background: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
        }

        .user-form label {
            display: block;
            margin: 10px 0 5px;
        }

        .user-form input,
        .user-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        .user-form button {
            padding: 10px 15px;
            background: #ff5722;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .toggle-btn {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
}
.user-card {
    background-color: #ffffff;
    padding: 15px;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    border-radius: 5px;
}

    </style>
</head>
<body>
   <header>
    <div>
        <div>
            <img src="thdclogo.png" alt="THDC India Limited Logo" class="logo">
            <h1 >THDC India Limited</h1>
            <h2>Hospital Bhagirathi Puram, Tehri</h2>
        </div>
        <div>
            <a href="logout.php" style="text-decoration: none;">
                <button style="padding: 10px 15px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">
                    Logout
                </button>
            </a>
        </div>
    </div>
</header>


    <div class="container">
        <h3>Admin Portal</h3>
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="success-message">User account created successfully!</div>
<?php endif; ?>

        <!-- Toggle Button -->
        <button class="toggle-btn" onclick="toggleForm()">Create Login Credentials for User</button>

        <!-- Hidden Form -->
        <div id="createUserForm" style="display:none;">
            <h4>Create Login Credentials</h4>
            <form method="POST" action="create_user.php" class="user-form">
                <label>Username:</label>
                <input type="text" name="username" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <label>Role:</label>
                <select name="role" required>
                    <option value="receptionist">Receptionist</option>
                    <option value="doctor">Doctor</option>
                    <option value="pharmacist">Pharmacist</option>
                    <option value="lab">Lab Technician</option>
                </select>

                <button type="submit">Create User</button>
            </form>
        </div>
        <!-- View Users Button -->
<button class="toggle-btn" onclick="toggleUsers()">View Users</button>

<!-- Users List -->
<div id="userList" style="display:none; margin-top: 20px;">
    <h4>All Users</h4>
    <?php
    $users = $conn->query("SELECT username, role FROM users")->fetchAll();
    if (count($users) > 0) {
        foreach ($users as $user) {
            echo "<div class='user-card'>";
            echo "<p><strong>Username:</strong> " . htmlspecialchars($user['username']) . "</p>";
            echo "<p><strong>Role:</strong> " . htmlspecialchars(ucfirst($user['role'])) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
</div>

<button class="toggle-btn" onclick="toggleRegistrations()">View Registrations</button>
        <!-- Registrations List -->
     

    <div id="registrationList" style="display:none; margin-top: 20px;">
    <h4>All Registrations</h4>
    <?php foreach ($all_registrations as $reg): ?>
        <div class="reg-card">
            <p>OPD Reg No: <?= htmlspecialchars($reg['opd_reg_no']) ?></p>
            <p>Name: <?= htmlspecialchars($reg['name']) ?></p>
            <p>Date: <?= htmlspecialchars($reg['reg_date']) ?></p>
        </div>
    <?php endforeach; ?>
</div>



    <script>
        function toggleForm() {
            const formDiv = document.getElementById("createUserForm");
            formDiv.style.display = (formDiv.style.display === "none" || formDiv.style.display === "") ? "block" : "none";
        }
    </script>
    <script>
function toggleForm() {
    const formDiv = document.getElementById("createUserForm");
    formDiv.style.display = (formDiv.style.display === "none" || formDiv.style.display === "") ? "block" : "none";
}

function toggleUsers() {
    const userDiv = document.getElementById("userList");
    userDiv.style.display = (userDiv.style.display === "none" || userDiv.style.display === "") ? "block" : "none";
}
</script>
<script>
function toggleRegistrations() {
    const regDiv = document.getElementById("registrationList");
    regDiv.style.display = (regDiv.style.display === "none" || regDiv.style.display === "") ? "block" : "none";
}
</script>


</body>
</html>
