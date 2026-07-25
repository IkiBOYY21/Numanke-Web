<!-- dapur-admin/manage_menu.php -->
<?php
session_start();
// Kunci keamanan: Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

$pesan = '';

// 1. Logika untuk MENAMBAH Menu Baru
if (isset($_POST['tambah_menu'])) {
    $nama  = $conn->real_escape_string($_POST['name']);
    $desc  = $conn->real_escape_string($_POST['description']);
    $harga = $conn->real_escape_string($_POST['price']);
    $image = $conn->real_escape_string($_POST['image_url']);

    $query_insert = "INSERT INTO menu (name, description, price, image_url) VALUES ('$nama', '$desc', '$harga', '$image')";
    if ($conn->query($query_insert)) {
        $pesan = "<div class='alert alert-success'>Berhasil menambahkan menu baru!</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menambah menu: " . $conn->error . "</div>";
    }
}

// 2. Logika untuk MENGHAPUS Menu
if (isset($_GET['hapus'])) {
    $id_hapus = $conn->real_escape_string($_GET['hapus']);
    $query_delete = "DELETE FROM menu WHERE id = '$id_hapus'";
    if ($conn->query($query_delete)) {
        header("Location: manage_menu.php"); // Refresh halaman setelah menghapus
        exit();
    }
}

// 3. Mengambil daftar menu dari database
$query_tampil = "SELECT * FROM menu ORDER BY id DESC";
$result = $conn->query($query_tampil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Admin Numanke</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #f4f4f9; display: flex; }
        
        /* Sidebar */
        .sidebar { width: 250px; background-color: #333; color: white; min-height: 100vh; padding: 20px; }
        .sidebar h2 { color: #ffb300; margin-bottom: 30px; text-align: center; }
        .sidebar a { display: block; color: white; text-decoration: none; padding: 10px; margin-bottom: 10px; border-radius: 5px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #d32f2f; }
        .sidebar .logout { background-color: #d32f2f; margin-top: 50px; text-align: center; }
        
        /* Main Content */
        .main-content { flex: 1; padding: 30px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        
        /* Form Tambah Menu */
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        .btn-add { background-color: #2ecc71; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-weight: 600; }
        .btn-add:hover { background-color: #27ae60; }
        
        /* Notifikasi */
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; font-weight: 600; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-danger { background-color: #f8d7da; color: #721c24; }

        /* Tabel Menu */
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .btn-delete { background-color: #e74c3c; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 14px; transition: 0.3s; }
        .btn-delete:hover { background-color: #c0392b; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Dapur Numanke</h2>
    <a href="index.php">📊 Dashboard</a>
    <a href="manage_orders.php">🛒 Kelola Pesanan</a>
    <a href="manage_menu.php" class="active">🍲 Kelola Menu</a>
    <a href="keluar.php" class="logout">🚪 Keluar</a>
</div>

<div class="main-content">
    <h1>Katalog Menu Makanan</h1>
    <p style="color: #666; margin-bottom: 20px;">Tambahkan atau hapus menu hidangan restoran Anda dari sini.</p>

    <?php echo $pesan; ?>

    <!-- Bagian 1: Form Tambah Menu -->
    <div class="card">
        <h3>Tambah Menu Baru</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" name="name" placeholder="Contoh: Ayam Bakar Madu" required>
            </div>
            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="description" rows="3" placeholder="Contoh: Ayam bakar dengan baluran madu murni..." required></textarea>
            </div>
            <div style="display: flex; gap: 20px;">
                <div class="form-group" style="flex: 1;">
                    <label>Harga (Rp)</label>
                    <input type="number" name="price" placeholder="Contoh: 25000" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Nama File Gambar</label>
                    <input type="text" name="image_url" placeholder="Contoh: ayam_madu.jpg">
                </div>
            </div>
            <button type="submit" name="tambah_menu" class="btn-add">+ Simpan Menu</button>
        </form>
    </div>

    <!-- Bagian 2: Tabel Daftar Menu -->
    <div class="card">
        <h3>Daftar Menu Saat Ini</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>File Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><strong>#<?php echo $row['id']; ?></strong></td>
                            <td>
                                <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
                                <span style="font-size: 12px; color: #666;"><?php echo htmlspecialchars($row['description']); ?></span>
                            </td>
                            <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($row['image_url']); ?></td>
                            <td>
                                <!-- Tombol Hapus dengan konfirmasi JavaScript -->
                                <a href="manage_menu.php?hapus=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus menu ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">Belum ada menu di dalam database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>