<?php
// Database connection
$host = "localhost";
$user = "root";
$password = ""; // Default in XAMPP
$database = "khaadi"; // Replace with your database name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Customer WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($user['Password'] === $pass) {
            echo "<script>alert('✅ Login successful!'); window.location.href='homepage.html';</script>";
        } else {
            echo "<script>alert('❌ Incorrect password.'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('❌ Email not found.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
