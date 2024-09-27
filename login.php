<?php
// Include the database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    // Prepare the SQL query using PDO
    $sql = "SELECT * FROM users WHERE student_id = :student_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_id', $student_id);
    $stmt->execute();

    // Fetch the user data
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // Redirect to another page like dashboard.html
            // header("Location: dashboard.html");
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that Student ID.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CIHE Student Camp</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #0047AB;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #003b8c;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            color: #0047AB;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label for="student-id">Student ID</label>
        <input type="text" id="student-id" name="student_id" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <div class="signup-link">
        Don't have an account? <a href="sign-up.html">Sign Up</a>
    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Menu Example</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        footer {
            background-color: #0047AB;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .footer-container {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .footer-section {
            margin: 10px;
            flex: 1;
            min-width: 200px;
        }

        .footer-section h3 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .footer-section ul {
            list-style-type: none;
            padding: 0;
        }

        .footer-section ul li {
            margin: 10px 0;
        }

        .footer-section ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .footer-section ul li a:hover {
            text-decoration: underline;
        }

        .contact-info p, .social-media a {
            margin: 10px 0;
            font-size: 16px;
            color: white;
            text-decoration: none;
        }

        .social-media a {
            margin: 0 10px;
        }

        .social-media img {
            width: 24px;
            height: 24px;
        }
    </style>
</head>
<body>

<!-- Other page content here -->

<footer>
    <div class="footer-container">
        <!-- Navigation Links -->
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="sign-up.html">User Registration</a></li>
                <li><a href="new-listing.html">Post Accommodation</a></li>
                <li><a href="search-accommodation.html">Search Accommodation</a></li>
                <li><a href="dashboard.html">Super User Control</a></li>
                <li><a href="contact-us.html">Contact Us</a></li>
                <li><a href="faq.html">Online FAQs</a></li>
            </ul>
        </div>

        <!-- Contact Information -->
        <div class="footer-section contact-info">
            <h3>Contact Us</h3>
            <p>Email: <a href="mailto:support@cihecamp.com">support@cihecamp.com</a></p>
            <p>Phone: +123 456 7890</p>
        </div>

        <!-- Social Media -->
        <div class="footer-section social-media">
            <h3>Follow Us</h3>
            <a href="https://facebook.com" target="_blank"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="https://twitter.com" target="_blank"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="https://instagram.com" target="_blank"><img src="instagram-icon.png" alt="Instagram"></a>
        </div>
    </div>
</footer>

</body>
</html>
