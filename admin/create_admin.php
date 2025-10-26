<?php
include '../php/db_connect.php';
$username = 'admin';
$password = password_hash('12345', PASSWORD_DEFAULT);
mysqli_query($conn, "INSERT INTO admin (username, password) VALUES ('$username', '$password')");
echo "Admin created successfully!";
?>
