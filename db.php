<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "root"; // Replace with your MySQL password
$dbname = "anc";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>