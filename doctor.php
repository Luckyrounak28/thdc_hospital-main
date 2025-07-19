<?php
include 'config.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'doctor') {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opd_reg_no = $_POST['opd_reg_no'];
    $medicine = $_POST['medicine'];
    $lab_test = $_POST['lab_test'];
    $doctor_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO prescriptions (opd_reg_no, doctor_id, medicine, lab_test) VALUES (:opd_reg_no, :doctor_id, :medicine, :lab_test)");
    $stmt->execute([':opd_reg_no' => $opd_reg_no, ':doctor_id' => $doctor_id, ':medicine' => $medicine, ':lab_test' => $lab_test]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THDC India Limited - Doctor Portal</title>
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
        <h3>Doctor Portal</h3>
        <form action="" method="POST">
            <label for="opd_reg_no">OPD Reg No:</label>
            <input type="text" id="opd_reg_no" name="opd_reg_no" required>

            <label for="medicine">Prescribe Medicine:</label>
            <input type="text" id="medicine" name="medicine">

            <label for="lab_test">Recommended Lab Test:</label>
            <input type="text" id="lab_test" name="lab_test">

            <button type="submit">Submit Prescription</button>
        </form>
        <h4>Patient Details</h4>
        <?php
        $stmt = $conn->prepare("SELECT * FROM registrations WHERE opd_reg_no = :opd_reg_no");
        $stmt->execute([':opd_reg_no' => $_POST['opd_reg_no'] ?? '']);
        $patient = $stmt->fetch();
        if ($patient) {
            echo "<p>Name: " . htmlspecialchars($patient['name']) . "</p>";
            echo "<p>Age: " . htmlspecialchars($patient['age']) . "</p>";
            echo "<p>Gender: " . htmlspecialchars($patient['gender']) . "</p>";
        }
        ?>
    </div>
</body>