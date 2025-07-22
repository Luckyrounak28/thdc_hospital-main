CREATE DATABASE thdc_hospital;
USE thdc_hospital;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('receptionist', 'doctor', 'pharmacist', 'lab', 'patient', 'admin') NOT NULL
);

CREATE TABLE registrations (
    opd_reg_no VARCHAR(20) PRIMARY KEY,
    reg_date DATETIME NOT NULL,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    category ENUM('A', 'B') NOT NULL,
    employee_name VARCHAR(100),
    relationship VARCHAR(50),
    workplace VARCHAR(100),
    recommended_doctor VARCHAR(100) NOT NULL
);

CREATE TABLE prescriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    opd_reg_no VARCHAR(20) NOT NULL,
    doctor_id INT NOT NULL,
    medicine VARCHAR(200),
    lab_test VARCHAR(200),
    status ENUM('pending', 'completed', 'not_available') DEFAULT 'pending',
    FOREIGN KEY (opd_reg_no) REFERENCES registrations(opd_reg_no),
    FOREIGN KEY (doctor_id) REFERENCES users(id)
);
-- Example: Create 1 admin, 1 doctor, 1 receptionist
INSERT INTO users (username, password, role) VALUES
('admin123', '$2y$10$eTtAYZfjEq8L4He5mHLFSOOPJPENvZxR1lYd9Eu.QamK6KAB53GeK', 'admin'),        -- Password: admin@123
('dr.tehri', '$2y$10$U9YFfPCfEKwmsMjxwU4UZufRI7DNeYO8sqCKUp2v9lz8Y0yRbsJXO', 'doctor'),         -- Password: doctor@123
('reception1', '$2y$10$dF3kgKbXrUqPSb0ZC.jjMe4mGLxq7FrDhLGqC4SkHF8ryI84mFa7a', 'receptionist'); -- Password: recep@123
