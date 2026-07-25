<!-- dapur-admin/manage_orders.php -->
<?php
session_start();
// Kunci halaman: Tendang jika bukan admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

// Logika untuk mengubah status pesanan saat tombol 'Update' ditekan
if (isset($_POST['update_status'])) {
    $order_id = $conn->real_escape_string($_POST['order_id']);
    $new_status = $conn->real_escape_string($_POST['status']);
    
    $update_query = "UPDATE orders SET status = '$new_status' WHERE id = '$order_id'";
    if ($conn->query($update_query)) {
        // Segarkan halaman agar data terbaru langsung muncul
        header("Location: manage_orders.php");
        exit();
    }
}

// Mengambil seluruh data pesanan, diurutkan dari yang paling baru
$query = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin Numanke</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #f4f4f9; display: flex; }
        
        /* Sidebar (Sama seperti index.php) */
        .sidebar { width: 250px; background-color: #333; color: white; min-height: 100vh; padding: 20px; }
        .sidebar h2 { color: #ffb300; margin-bottom: 30px; text-align: center; }
        .sidebar a { display: block; color: white; text-decoration: none; padding: 10px; margin-bottom: 10px; border-radius: 5px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #d32f2f; }
        .sidebar .logout { background-color: #d32f2f; margin-top: 50px; text-align: center; }
        
        /* Area Konten */
        .main-content { flex: 1; padding: 30px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); overflow-x: auto; }
        
        /* Desain Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; font-weight: 600; }
        
        /* Label Status */
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; color: white; }
        .badge-pending { background-color: #f39c12; }
        .badge-processing { background-color: #3498db; }
        .badge-completed { background-color: #2ecc71; }
        .badge-cancelled { background-color: #e74c3c; }
        
        /* Form Update */
        .action-form { display: flex; gap: 8px; align-items: center; }
        select { padding: 6px; border: 1px solid #ccc; border-radius: 4px; font-family: 'Poppins', sans-serif; }
        button { padding: 6px 12px; background-color: #333; color: white; border: none; border-radius: 4px; cursor: pointer; font-family: 'Poppins', sans-serif; transition: 0.3s;}
        button:hover { background-color: #ffb300; color: #333; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Dapur Numanke</h2>
    <a href="index.php">📊 Dashboard</a>
    <a href="manage_orders.php" class="active">🛒 Kelola Pesanan</a>
    <a href="manage_menu.php">🍲 Kelola Menu</a>
    <a href="keluar.php" class="logout">🚪 Keluar</a>
</div>

<div class="main-content">
    <h1>Kelola Pesanan Masuk</h1>
    <p style="color: #666; margin-bottom: 20px;">Ubah status pesanan menjadi <strong>Completed</strong> agar data omset masuk ke dalam grafik.</p>

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
                <?php if($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo date('d M Y, H:i', strtotime($row['order_date'])); ?></td>
                            <td><strong>#ORD-<?php echo $row['id']; ?></strong></td>
                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                            <td>
                                <!-- Tombol langsung chat WA pelanggan -->
                                <a href="https://wa.me/<?php echo $row['customer_phone']; ?>" target="_blank" style="color: #2ecc71; text-decoration: none; font-weight: 600;">
                                    <?php echo htmlspecialchars($row['customer_phone']); ?>
                                </a>
                            </td>
                            <td>Rp <?php echo number_format($row['total_price'], 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge badge-<?php echo $row['status']; ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <form method="POST" class="action-form">
                                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                    <select name="status">
                                        <option value="pending" <?php if($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                        <option value="processing" <?php if($row['status'] == 'processing') echo 'selected'; ?>>Processing</option>
                                        <option value="completed" <?php if($row['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                        <option value="cancelled" <?php if($row['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" name="update_status">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px;">Belum ada pesanan masuk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>