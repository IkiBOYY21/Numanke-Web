<!-- dapur-admin/index.php -->   
<?php   
session_start();   
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {   
    header("Location: masuk.php");   
    exit();   
}   
require_once '../includes/db.php';   

// =========================================================
// 1. PENGATURAN FILTER TANGGAL
// =========================================================
// Jika admin memilih tanggal, gunakan itu. Jika tidak, default tampilkan 7 hari terakhir.
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('-7 days'));
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

// =========================================================
// 2. MENGAMBIL STATISTIK ANGKA (Omset & Total Pesanan)
// =========================================================
$query_stats = "SELECT SUM(total_price) as total_omset, COUNT(id) as total_trx 
                FROM orders 
                WHERE status IN ('Selesai', 'completed') 
                AND DATE(order_date) BETWEEN '$start_date' AND '$end_date'";
$res_stats = $conn->query($query_stats);
$stats = $res_stats->fetch_assoc();

$total_omset = $stats['total_omset'] ? $stats['total_omset'] : 0;
$total_trx = $stats['total_trx'] ? $stats['total_trx'] : 0;

// =========================================================
// 3. MENGAMBIL DATA UNTUK GRAFIK OMSET (Bar Chart)
// =========================================================
$query_chart_omset = "SELECT DATE(order_date) as tgl, SUM(total_price) as harian 
                      FROM orders 
                      WHERE status IN ('Selesai', 'completed') 
                      AND DATE(order_date) BETWEEN '$start_date' AND '$end_date' 
                      GROUP BY DATE(order_date) 
                      ORDER BY tgl ASC";
$res_chart = $conn->query($query_chart_omset);

$label_omset = [];
$data_omset = [];
if ($res_chart && $res_chart->num_rows > 0) {
    while($row = $res_chart->fetch_assoc()) {
        $label_omset[] = date('d M Y', strtotime($row['tgl']));
        $data_omset[] = $row['harian'];
    }
} else {
    // Jika tidak ada pesanan di tanggal tsb, tampilkan grafik kosong
    $label_omset = ['Belum ada transaksi'];
    $data_omset = [0];
}

// =========================================================
// 4. MENGAMBIL DATA UNTUK GRAFIK MENU TERLARIS (Doughnut)
// =========================================================
$label_menu = [];
$data_menu = [];
try {
    // Mencoba mengambil data item yang paling banyak dipesan dari tabel order_items
    $query_menu = "SELECT menu_name, SUM(quantity) as qty 
                   FROM order_items oi 
                   JOIN orders o ON oi.order_id = o.id 
                   WHERE o.status IN ('Selesai', 'completed') 
                   AND DATE(o.order_date) BETWEEN '$start_date' AND '$end_date' 
                   GROUP BY menu_name 
                   ORDER BY qty DESC LIMIT 5";
    $res_menu = $conn->query($query_menu);
    if ($res_menu && $res_menu->num_rows > 0) {
        while($r = $res_menu->fetch_assoc()) {
            $label_menu[] = $r['menu_name'];
            $data_menu[] = $r['qty'];
        }
    } else {
        $label_menu = ['Belum ada transaksi']; $data_menu = [1];
    }
} catch (Exception $e) {
    // Abaikan jika tabel order_items belum sempurna, beri nilai default
    $label_menu = ['Data Belum Tersedia']; $data_menu = [1];
}
?>   
  
<!DOCTYPE html>   
<html lang="id">   
<head>   
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>Dashboard Admin - Numanke</title>   
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
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
    <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?>!</h1>   
    <p>Pantau performa penjualan harian dan akses website Anda di sini.</p>   

    <!-- FITUR FILTER TANGGAL -->
    <div class="card" style="padding: 20px 25px; margin-bottom: 25px; background: #fff; border-left: 5px solid #3498db;">
        <form method="GET" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 5px; color: #6c757d;">📅 Dari Tanggal</label>
                <input type="date" name="start_date" value="<?php echo $start_date; ?>" style="padding: 10px; border: 1px solid #ced4da; border-radius: 6px; font-family: 'Poppins', sans-serif;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 5px; color: #6c757d;">📅 Sampai Tanggal</label>
                <input type="date" name="end_date" value="<?php echo $end_date; ?>" style="padding: 10px; border: 1px solid #ced4da; border-radius: 6px; font-family: 'Poppins', sans-serif;">
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #198754; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-family: 'Poppins', sans-serif; font-weight: 600; transition: 0.3s;">Terapkan Filter</button>
                <a href="index.php" style="background: #e9ecef; color: #495057; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 600; transition: 0.3s;">Reset</a>
            </div>
        </form>
    </div>
  
    <!-- STATISTIK ANGKA (DINAMIS DARI DATABASE) -->
    <div class="stat-card-container">   
        <div class="stat-card green">   
            <h4>Total Pendapatan (Selesai)</h4>   
            <h2>Rp <?php echo number_format($total_omset, 0, ',', '.'); ?></h2>   
        </div>   
        <div class="stat-card blue">   
            <h4>Total Transaksi Sukses</h4>   
            <h2><?php echo number_format($total_trx, 0, ',', '.'); ?> Pesanan</h2>   
        </div>   
        <div class="stat-card purple">   
            <h4>Rentang Waktu</h4>   
            <h2 style="font-size: 1.2rem; margin-top: 20px;"><?php echo date('d M', strtotime($start_date)) . " - " . date('d M Y', strtotime($end_date)); ?></h2>   
        </div>   
    </div>   
  
    <!-- KOTAK GRAFIK -->
    <div class="chart-grid">  
        <div class="card">   
            <h3>Grafik Omset Harian (Rp)</h3>   
            <canvas id="omsetChart"></canvas>   
        </div>   
        
        <div class="card">   
            <h3>5 Menu Paling Laris</h3>   
            <div style="height: 250px; display: flex; justify-content: center;">  
                <canvas id="menuChart"></canvas>   
            </div>  
        </div>   
    </div>   
</div>   
  
<script>  
    // Mengambil Array PHP ke dalam JavaScript
    const labelOmset = <?php echo json_encode($label_omset); ?>;
    const dataOmset = <?php echo json_encode($data_omset); ?>;
    
    const labelMenu = <?php echo json_encode($label_menu); ?>;
    const dataMenu = <?php echo json_encode($data_menu); ?>;
    
    // Konfigurasi Chart 1 (Bar Chart Pendapatan)
    new Chart(document.getElementById('omsetChart'), {  
        type: 'line',  // Diubah ke line chart agar lebih enak dilihat trendnya
        data: { 
            labels: labelOmset, 
            datasets: [{ 
                label: 'Pendapatan (Rp)', 
                data: dataOmset, 
                borderColor: '#2ecc71',
                backgroundColor: 'rgba(46, 204, 113, 0.2)', 
                fill: true,
                tension: 0.3,
                borderWidth: 2
            }] 
        },  
        options: { 
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }  
    });  
    
    // Konfigurasi Chart 2 (Doughnut Chart Menu Laris)
    new Chart(document.getElementById('menuChart'), {  
        type: 'doughnut',  
        data: { 
            labels: labelMenu, 
            datasets: [{ 
                data: dataMenu, 
                backgroundColor: ['#e74c3c', '#3498db', '#f1c40f', '#9b59b6', '#34495e'], 
                borderWidth: 2 
            }] 
        },  
        options: { responsive: true, maintainAspectRatio: false }  
    });  
</script>   
</body>   
</html>