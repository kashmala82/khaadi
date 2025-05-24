<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "khaadi";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customerID = $_POST['customerID'];
$addressLine = $_POST['addressLine'];
$city = $_POST['city'];
$postalCode = $_POST['postalCode'];
$province = $_POST['province'];

$sql = "INSERT INTO ShippingAddress (CustomerID, AddressLine, City, PostalCode, Province)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $customerID, $addressLine, $city, $postalCode, $province);

if ($stmt->execute()) {
    echo "<script>alert('Shipping details saved successfully!'); window.location.href='homepage.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
