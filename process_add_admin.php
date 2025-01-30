<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $namalengkap = $_POST['namalengkap'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $konek->prepare("INSERT INTO admin (username, password, namalengkap) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $namalengkap);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New admin added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $konek->close();
} else {
    echo "Invalid request method";
}
?>