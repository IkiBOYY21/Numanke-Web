<!-- dapur-admin/index.php -->
<?php
session_start();
// Kunci halaman ini: Tendang user jika belum login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Numanke</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #f4f4f9; display: flex; }
        /* Sidebar Menu */
        .sidebar { width: 250px; background-color: #333; color: white; min-height: 100vh; padding: 20px; }
        .sidebar h2 { color: #ffb300; margin-bottom: 30px; text-align: center; }
        .sidebar a { display: block; color: white; text-decoration: none; padding: 10px; margin-bottom: 10px; border-radius: 5px; transition: 0.3s; }
        .sidebar a:hover { background-color: #d32f2f; }
        .sidebar .logout { background-color: #d32f2f; margin-top: 50px; text-align: center; }
        
        /* Main Content */
        .main-content { flex: 1; padding: 30px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; font-weight: 600; margin-right: 10px; }
        .btn-red { background-color: #d32f2f; }
        .btn-yellow { background-color: #ffb300; color: #333; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Dapur Numanke</h2>
    <a href="index.php">📊 Dashboard</a>
    <a href="manage_orders.php">🛒 Kelola Pesanan</a>
    <a href="manage_menu.php">🍲 Kelola Menu</a>
    <a href="keluar.php" class="logout">🚪 Keluar</a>
</div>

<div class="main-content">
    <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p style="color: #666; margin-bottom: 20px;">Pantau performa penjualan harian dan bulanan Anda di sini.</p>

    <div class="card">
        <h3>Grafik Omset Penjualan</h3>
        <div style="margin: 15px 0;">
            <button onclick="loadChart('hari')" class="btn btn-red">7 Hari Terakhir</button>
            <button onclick="loadChart('bulan')" class="btn btn-yellow">Bulan Ini</button>
        </div>
        
        <!-- Wadah Grafik -->
        <canvas id="omsetChart" height="100"></canvas>
    </div>
</div>

<!-- Script pemroses grafik -->
<script src="../assets/js/admin_chart.js"></script>

</body>
</html>