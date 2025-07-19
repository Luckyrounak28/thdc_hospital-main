<?php
include 'config.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'pharmacist') {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opd_reg_no = $_POST['opd_reg_no'];
    $status = $_POST['status'] ? 'not_available' : 'completed';
    $stmt = $conn->prepare("UPDATE prescriptions SET status = :status WHERE opd_reg_no = :opd_reg_no");
    $stmt->execute([':status' => $status, ':opd_reg_no' => $opd_reg_no]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THDC India Limited - Pharmacist Portal</title>
    <link rel="stylesheet" href="style.css">
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
        <h3>Pharmacist Portal</h3>
        <form action="" method="POST">
            <label for="opd_reg_no">OPD Reg No:</label>
            <input type="text" id="opd_reg_no" name="opd_reg_no" required>

            <label>Medicine Available:</label>
            <input type="checkbox" id="status" name="status" value="1">

            <button type="submit">Update</button>
        </form>
        <?php
        $stmt = $conn->prepare("SELECT medicine, status FROM prescriptions WHERE opd_reg_no = :opd_reg_no");
        $stmt->execute([':opd_reg_no' => $_POST['opd_reg_no'] ?? '']);
        $prescription = $stmt->fetch();
        if ($prescription) {
            echo "<p>Medicine: " . htmlspecialchars($prescription['medicine']) . "</p>";
            echo "<p>Status: " . htmlspecialchars($prescription['status']) . "</p>";
        }
        ?>
    </div>
</body>