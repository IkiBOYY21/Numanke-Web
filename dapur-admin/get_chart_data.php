// dapur-admin/get_chart_data.php
<?php
session_start();
// Pastikan hanya admin yang bisa meminta data ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    exit(json_encode(['error' => 'Unauthorized']));
}

require_once '../includes/db.php';

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'hari';
$labels = [];
$data = [];

if ($filter == 'hari') {
    // Omset per hari untuk 7 hari terakhir
    $query = "SELECT DATE(order_date) as tgl, SUM(total_price) as omset 
              FROM orders 
              WHERE status = 'completed' 
              GROUP BY DATE(order_date) 
              ORDER BY DATE(order_date) DESC LIMIT 7";
} else {
    // Omset per bulan
    $query = "SELECT DATE_FORMAT(order_date, '%Y-%m') as tgl, SUM(total_price) as omset 
              FROM orders 
              WHERE status = 'completed' 
              GROUP BY DATE_FORMAT(order_date, '%Y-%m') 
              ORDER BY DATE_FORMAT(order_date, '%Y-%m') DESC LIMIT 12";
}

$result = $conn->query($query);

// Data dibalik (unshift) agar urutan tanggal di grafik dari kiri ke kanan (lama ke baru)
while ($row = $result->fetch_assoc()) {
    array_unshift($labels, $row['tgl']);
    array_unshift($data, $row['omset']);
}

// Kirim balik data dalam bentuk JSON
echo json_encode(['labels' => $labels, 'data' => $data]);
?>