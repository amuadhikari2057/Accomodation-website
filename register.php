<?php
// Database connection
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $student_id = $_POST['student_id'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if student_id or email already exists
    $checkQuery = "SELECT * FROM users WHERE student_id = :student_id OR email = :email";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bindParam(':student_id', $student_id);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Student ID or Email already exists
        echo '<script>
            alert("Email or Student ID already registered.");
            window.location.href = "sign-up.html";
        </script>';
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (student_id, phone_number, email, password) 
                VALUES (:student_id, :phone_number, :email, :password)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            echo '<script>
                alert("Registration successful! Please login.");
                window.location.href = "login.html";
            </script>';
        } else {
            echo '<script>
                alert("Error during registration. Please try again.");
                window.location.href = "sign-up.html";
            </script>';
        }
    }
}
?>
