<?php
// Database credentials
$host = 'localhost'; // Change to your database host
$dbname = 'cihe'; // Change to your database name
$username = 'root'; // Change to your database username
$password = '8080'; // Change to your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $title = $_POST['title'];
        $cost = $_POST['cost'];
        $location = $_POST['location'];
        $facilities = $_POST['facilities'];

        // Prepare SQL query to insert data
        $sql = "INSERT INTO listings (title, cost, location, facilities) VALUES (:title, :cost, :location, :facilities)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters to SQL query
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':cost', $cost);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':facilities', $facilities);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Listing added successfully.'); window.location.href = 'new-listing.html';</script>";
        } else {
            echo "<script>alert('Failed to add listing.'); window.location.href = 'new-listing.html';</script>";
        }
    }
} catch (PDOException $e) {
    echo "<script>alert('Database connection failed: " . $e->getMessage() . "'); window.location.href = 'new-listing.html';</script>";
}
?>
