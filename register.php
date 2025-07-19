<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opd_reg_no = $_POST['opd_reg_no'];
    $reg_date = $_POST['reg_date'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $employee_name = $_POST['employee_name'] ?? '';
    $relationship = $_POST['relationship'] ?? '';
    $workplace = $_POST['workplace'] ?? '';
    $recommended_doctor = $_POST['recommended_doctor'];

    try {
        $stmt = $conn->prepare("INSERT INTO registrations (opd_reg_no, reg_date, name, age, gender, mobile, email, category, employee_name, relationship, workplace, recommended_doctor) VALUES (:opd_reg_no, :reg_date, :name, :age, :gender, :mobile, :email, :category, :employee_name, :relationship, :workplace, :recommended_doctor)");
        $stmt->execute([
            ':opd_reg_no' => $opd_reg_no,
            ':reg_date' => $reg_date,
            ':name' => $name,
            ':age' => $age,
            ':gender' => $gender,
            ':mobile' => $mobile,
            ':email' => $email,
            ':category' => $category,
            ':employee_name' => $employee_name,
            ':relationship' => $relationship,
            ':workplace' => $workplace,
            ':recommended_doctor' => $recommended_doctor
        ]);

        echo "<strong>✅ Registration successful!</strong> OPD Reg No: <b>$opd_reg_no</b>";
    } catch (PDOException $e) {
        echo "<span style='color:red;'>❌ Error: " . $e->getMessage() . "</span>";
    }
}
?>
