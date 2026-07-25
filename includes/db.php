<?php
// includes/db.php

$host = "localhost";
$user = "root";     // Username default XAMPP
$pass = "";         // Password default XAMPP (kosong)
$dbname = "db_numanke";

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>