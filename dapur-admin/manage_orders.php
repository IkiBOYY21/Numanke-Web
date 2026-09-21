<!-- dapur-admin/manage_orders.php -->  
<?php  
session_start();  
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {  
    header("Location: masuk.php");  
    exit();  
}  
require_once '../includes/db.php';  
  
// LOGIKA MENGOSONGKAN SEMUA PESANAN
if (isset($_POST['kosongkan_pesanan'])) {  
    // Nonaktifkan pengecekan foreign key sementara
    $conn->query("SET FOREIGN_KEY_CHECKS = 0"); 
    
    // Kosongkan tabel anak dan tabel induk
    $conn->query("TRUNCATE TABLE order_items"); 
    $conn->query("TRUNCATE TABLE orders");
    
    // Aktifkan kembali pengecekan foreign key
    $conn->query("SET FOREIGN_KEY_CHECKS = 1"); 
    
    header("Location: manage_orders.php");  
    exit();  
}  
  
// LOGIKA UPDATE STATUS PESANAN
if (isset($_POST['update_status'])) {  
    $order_id = $conn->real_escape_string($_POST['order_id']);  
    $new_status = $conn->real_escape_string($_POST['status']);  
    $conn->query("UPDATE orders SET status = '$new_status' WHERE id = '$order_id'");  
    header("Location: manage_orders.php");  
    exit();  
}  
  
$query = "SELECT * FROM orders ORDER BY order_date DESC";  
$result = $conn->query($query);  
?>  
  
<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Kelola Pesanan - Admin Numanke</title>  
    <link rel="stylesheet" href="../assets/css/admin.css"> 
</head>  

<script>
    // Memperbarui tabel pesanan setiap 10 detik secara otomatis (tanpa refresh halaman)
    setInterval(function() {
        fetch('manage_orders.php')
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');
            // Mengambil tabel dari halaman baru dan menimpanya ke halaman saat ini
            let newTableBody = doc.querySelector('table tbody').innerHTML;
            document.querySelector('table tbody').innerHTML = newTableBody;
        })
        .catch(error => console.log('Gagal mengambil data terbaru:', error));
    }, 10000); // 10000 milidetik = 10 detik (bisa Anda ubah sesuai kebutuhan)
</script>

<body>  
  
<div class="sidebar">  
    <h2>Dapur Numanke</h2>  
    <a href="index.php">📊 Dashboard</a>  
    <a href="manage_orders.php" class="active">🛒 Kelola Pesanan</a>  
    <a href="manage_menu.php">🍲 Kelola Menu</a>  
    <a href="keluar.php" class="logout">🚪 Keluar</a>  
</div>  
  
<div class="main-content">  
    <div class="header-flex">  
        <div>  
            <h1>Kelola Pesanan Masuk</h1>  
            <p style="margin-bottom: 0;">Ubah status pesanan atau kosongkan data.</p>  
        </div>  
        <form method="POST" onsubmit="return confirm('Yakin ingin menghapus SEMUA data pesanan secara permanen?');" style="margin:0;">  
            <button type="submit" name="kosongkan_pesanan" class="btn-danger">🗑️ Kosongkan Semua Pesanan</button>  
        </form>  
    </div>  
  
    <div class="card">  
        <table>  
            <thead>  
                <tr>  
                    <th>Waktu</th>  
                    <th>ID Order</th>  
                    <th>Pelanggan</th>  
                    <th>WhatsApp</th>  
                    <th>Total</th>  
                    <th>Status</th>  
                    <th>Aksi</th>  
                </tr>  
            </thead>  
            <tbody>  
                <?php if($result && $result->num_rows > 0): ?>  
                    <?php while($row = $result->fetch_assoc()): ?>  
                        <tr>  
                            <td><span style="color: #6c757d; font-size: 0.9rem;"><?php echo date('d M Y, H:i', strtotime($row['order_date'])); ?></span></td>  
                            <td class="text-dark-bold">#ORD-<?php echo $row['id']; ?></td>  
                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>  
                            <td><a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $row['customer_phone']); ?>" target="_blank" class="text-whatsapp"><?php echo htmlspecialchars($row['customer_phone']); ?></a></td>  
                            <td class="text-price">Rp <?php echo number_format($row['total_price'], 0, ',', '.'); ?></td>  
                            <td>  
                                <?php  
                                $badge_class = 'badge-orange'; // completed
                                if($row['status'] == 'Menunggu') $badge_class = 'badge-blue';  
                                if($row['status'] == 'Diproses') $badge_class = 'badge-green';  
                                if($row['status'] == 'Dibatalkan') $badge_class = 'badge-red';  
                                ?>  
                                <span class="badge <?php echo $badge_class; ?>"><?php echo $row['status']; ?></span>  
                            </td>  
                            <td>  
                                <form method="POST" class="action-form">  
                                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">  
                                    <select name="status">  
                                        <option value="Menunggu" <?php if($row['status'] == 'Menunggu') echo 'selected'; ?>>Menunggu</option>  
                                        <option value="Diproses" <?php if($row['status'] == 'Diproses') echo 'selected'; ?>>Diproses</option>  
                                        <option value="Selesai" <?php if($row['status'] == 'Selesai' || $row['status'] == 'completed') echo 'selected'; ?>>Selesai</option>  
                                        <option value="Dibatalkan" <?php if($row['status'] == 'Dibatalkan') echo 'selected'; ?>>Dibatalkan</option>  
                                    </select>  
                                    <button type="submit" name="update_status">Update</button>  
                                </form>  
                            </td>  
                        </tr>  
                    <?php endwhile; ?>  
                <?php else: ?>  
                    <tr><td colspan="7" style="text-align:center; color:#999; padding:20px;">Belum ada pesanan masuk.</td></tr>  
                <?php endif; ?>  
            </tbody>  
        </table>  
    </div>  
</div>  
</body>  
</html>