<?php
include 'config.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: login.html");
    exit();
}

$mobile = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM registrations WHERE mobile = :mobile");
$stmt->execute([':mobile' => $mobile]);
$registrations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THDC India Limited - Patient Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <img src="images/thdc-logo.png" alt="THDC India Limited Logo" class="logo">
        <h1>THDC India Limited</h1>
        <h2>Hospital Bhagirathi Puram, Tehri</h2>
    </header>
    <div class="container">
        <h3>Patient Portal</h3>
        <h4>Previous Registrations</h4>
        <?php
        foreach ($registrations as $reg) {
            echo "<div class='reg-card'>";
            echo "<p>OPD Reg No: " . htmlspecialchars($reg['opd_reg_no']) . "</p>";
            echo "<p>Name: " . htmlspecialchars($reg['name']) . "</p>";
            echo "<p>Date: " . htmlspecialchars($reg['reg_date']) . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>