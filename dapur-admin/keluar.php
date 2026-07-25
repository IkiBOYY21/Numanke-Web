<!-- dapur-admin/keluar.php -->
<?php
session_start();
session_unset();
session_destroy();

// Arahkan kembali ke halaman utama website
header("Location: ../index.php");
exit();
?>