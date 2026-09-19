<!-- dapur-admin/index.php -->  
<?php  
session_start();  
// Kunci halaman ini: Tendang user jika belum login  
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {  
    header("Location: masuk.php");  
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
        .sidebar a:hover, .sidebar a.active { background-color: #d32f2f; }  
        .sidebar .logout { background-color: #d32f2f; margin-top: 50px; text-align: center; }  
          
        /* Main Content */  
        .main-content { flex: 1; padding: 30px; overflow-y: auto; height: 100vh; box-sizing: border-box; }  
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }  
        
        /* Grid Layout untuk Diagram */
        .chart-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; }
        .chart-full { grid-column: span 2; }
    </style>  
</head>  
<body>  
  
<div class="sidebar">  
    <h2>Dapur Numanke</h2>  
    <a href="index.php" class="active">📊 Dashboard</a>  
    <a href="manage_orders.php">🛒 Kelola Pesanan</a>  
    <a href="manage_menu.php">🍲 Kelola Menu</a>  
    <a href="keluar.php" class="logout">🚪 Keluar</a>  
</div>  
  
<div class="main-content">  
    <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>  
    <p style="color: #666; margin-bottom: 30px;">Pantau performa penjualan harian dan akses website Anda di sini.</p>  
  
    <!-- Kartu Statistik (Dikosongkan) -->  
    <div style="display: flex; gap: 20px; margin-bottom: 30px;">  
        <div style="flex: 1; background: white; padding: 20px; border-radius: 8px; border-left: 5px solid #2ecc71; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">  
            <h4 style="margin: 0; color: #888; font-size: 14px;">Total Pendapatan (Bulan Ini)</h4>  
            <h2 style="margin: 10px 0 0 0; color: #333;">Rp 0</h2>  
        </div>  
        <div style="flex: 1; background: white; padding: 20px; border-radius: 8px; border-left: 5px solid #3498db; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">  
            <h4 style="margin: 0; color: #888; font-size: 14px;">Total Transaksi Sukses</h4>  
            <h2 style="margin: 10px 0 0 0; color: #333;">0 Pesanan</h2>  
        </div>  
        <div style="flex: 1; background: white; padding: 20px; border-radius: 8px; border-left: 5px solid #9b59b6; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">  
            <h4 style="margin: 0; color: #888; font-size: 14px;">Pengunjung Website</h4>  
            <h2 style="margin: 10px 0 0 0; color: #333;">0 Visit</h2>  
        </div>  
    </div>  
  
    <!-- Wadah Bermacam-macam Grafik -->  
    <div class="chart-grid">
        <!-- Grafik 1: Bar Chart Omset -->
        <div class="card">  
            <h3 style="margin-top: 0;">Grafik Omset (7 Hari Terakhir)</h3>  
            <canvas id="omsetChart"></canvas>  
        </div>  

        <!-- Grafik 2: Doughnut Chart Proporsi Menu -->
        <div class="card">  
            <h3 style="margin-top: 0;">Proporsi Penjualan Menu</h3>  
            <div style="height: 250px; display: flex; justify-content: center;">
                <canvas id="menuChart"></canvas>  
            </div>
        </div>  

        <!-- Grafik 3: Line Chart Kunjungan Web -->
        <div class="card chart-full">  
            <h3 style="margin-top: 0;">Tren Kunjungan Website (Bulan Ini)</h3>  
            <canvas id="visitorChart" height="80"></canvas>  
        </div> 
    </div> 
</div>  
  
<script>
    // Konfigurasi Default Kosong
    const emptyLabels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    const emptyData = [0, 0, 0, 0, 0, 0, 0];

    // 1. Render Bar Chart (Omset)
    new Chart(document.getElementById('omsetChart'), {
        type: 'bar',
        data: {
            labels: emptyLabels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: emptyData,
                backgroundColor: '#2ecc71',
                borderRadius: 4
            }]
        },
        options: { responsive: true }
    });

    // 2. Render Doughnut Chart (Proporsi Menu)
    new Chart(document.getElementById('menuChart'), {
        type: 'doughnut',
        data: {
            labels: ['Belum Ada Transaksi'],
            datasets: [{
                data: [100],
                backgroundColor: ['#e0e0e0'], // Warna abu-abu kosong
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // 3. Render Line Chart (Pengunjung)
    new Chart(document.getElementById('visitorChart'), {
        type: 'line',
        data: {
            labels: emptyLabels,
            datasets: [{
                label: 'Jumlah Pengunjung',
                data: emptyData,
                borderColor: '#9b59b6',
                backgroundColor: 'rgba(155, 89, 182, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.3 // Membuat garis melengkung halus
            }]
        },
        options: { responsive: true }
    });
</script>  
  
</body>  
</html>