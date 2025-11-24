<?php
$host = 'localhost';
$user = 'root';  // Default Xampp
$pass = '';      // Kosongkan jika default
$db = 'perpustakaan';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
