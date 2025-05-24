<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "khaadi";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from form
$customerID = $_POST['customerID'];
$addressLine = $_POST['addressLine'];
$city = $_POST['city'];
$postalCode = $_POST['postalCode'];
$province = $_POST['province'];

// Insert query
$sql = "INSERT INTO ShippingAddress (CustomerID, AddressLine, City, PostalCode, Province)
        VALUES ('$customerID', '$addressLine', '$city', '$postalCode', '$province')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Shipping address submitted successfully!'); window.location.href='homepage.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
