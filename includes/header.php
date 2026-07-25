<!-- includes/header.php -->
<?php
$halaman_saat_ini = basename($_SERVER['PHP_SELF']);
$is_home = ($halaman_saat_ini == 'index.php' || $halaman_saat_ini == '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numanke - Spesial Ayam Brongot</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

<!-- ANIMASI LOADING SCREEN -->
<div id="preloader">
    <img src="assets/images/logo numanke.png" alt="Loading Numanke" class="preloader-logo">
</div>

<!-- Navigasi -->
<nav class="navbar" data-aos="fade-down" data-aos-duration="800">
    <!-- Navbar Logo: Klik logo akan membawa kembali ke atas (Home) -->
    <a href="<?php echo $is_home ? '#home' : 'index.php'; ?>" class="logo">
        <img src="assets/images/logo numanke.png" alt="Logo Numanke">
        Numanke<span>.</span>
    </a>
    
    <ul class="nav-links">
        <li><a href="<?php echo $is_home ? '#home' : 'index.php#home'; ?>">Home</a></li>
        <li><a href="<?php echo $is_home ? '#showcase' : 'index.php#showcase'; ?>">Menu Andalan</a></li>
        <li><a href="<?php echo $is_home ? '#about' : 'index.php#about'; ?>">Cerita Kami</a></li>
        <li><a href="<?php echo $is_home ? '#contact' : 'index.php#contact'; ?>">Kontak</a></li>
    </ul>
    <a href="order.php" class="btn btn-primary">Pesan Sekarang</a>
</nav>