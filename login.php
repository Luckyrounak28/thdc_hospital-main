<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    try {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = :username AND role = :role");
        $stmt->execute([':username' => $username, ':role' => $role]);
        $user = $stmt->fetch();



        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;

            // Redirect based on role
            $redirectMap = [
                'receptionist' => 'register.html',
                'doctor'       => 'doctor.php',
                'pharmacist'   => 'pharmacist.php',
                'lab'          => 'lab.php',
                'patient'      => 'patient.php',
                'admin'        => 'admin.php'
            ];

            header("Location: " . ($redirectMap[$role] ?? 'login.html'));
            exit();
        } else {
            echo "<script>alert('Invalid credentials!'); window.location.href='login.html';</script>";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
