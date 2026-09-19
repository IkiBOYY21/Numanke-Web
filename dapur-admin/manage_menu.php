<!-- dapur-admin/manage_menu.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: masuk.php");
    exit();
}
require_once '../includes/db.php';

$pesan = '';

// 1. Logika untuk MENAMBAH Menu Baru dengan Upload Gambar & Kategori Lengkap
if (isset($_POST['tambah_menu'])) {
    $nama = $conn->real_escape_string($_POST['name']);
    $kategori = $conn->real_escape_string($_POST['kategori']); 
    $desc = $conn->real_escape_string($_POST['description']);
    $harga = $conn->real_escape_string($_POST['price']);
    
    $image_name = "default.png";

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
        $target_dir = "../assets/images/menu/";
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
        
        $file_extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image_name = time() . "_" . preg_replace("/[^a-zA-Z0-9]/", "", $nama) . "." . $file_extension;
        $target_file = $target_dir . $image_name;
        
        move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file);
    }

    $query_insert = "INSERT INTO menu (name, kategori, description, price, image_url) VALUES ('$nama', '$kategori', '$desc', '$harga', '$image_name')";
    if ($conn->query($query_insert)) {
        $pesan = "<div class='alert alert-success'>Berhasil menambahkan menu ke segmen $kategori!</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menambah menu: " . $conn->error . "</div>";
    }
}

// 2. Logika untuk MENGHAPUS Menu
if (isset($_GET['hapus'])) {
    $id_hapus = $conn->real_escape_string($_GET['hapus']);
    $query_get_img = "SELECT image_url FROM menu WHERE id = '$id_hapus'";
    $res_img = $conn->query($query_get_img);
    if($res_img->num_rows > 0) {
        $img_row = $res_img->fetch_assoc();
        $file_path = "../assets/images/menu/" . $img_row['image_url'];
        if(file_exists($file_path) && $img_row['image_url'] != 'default.png') {
            unlink($file_path);
        }
    }

    $query_delete = "DELETE FROM menu WHERE id = '$id_hapus'";
    if ($conn->query($query_delete)) {
        header("Location: manage_menu.php");
        exit();
    }
}

// Daftar Kategori Lengkap Sesuai Struktur Web Utama
$daftar_kategori = [
    'Menu Geprek' => 'Menu Geprek',
    'Menu Dewata' => 'Menu Dewata',
    'Menu Brongot' => 'Menu Brongot',
    'Menu Mix / Kombinasi' => 'Menu Mix / Kombinasi',
    'Minuman & Tambahan' => 'Minuman & Tambahan'
];
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
        .sidebar { width: 250px; background-color: #333; color: white; min-height: 100vh; padding: 20px; position: fixed; }
        .sidebar h2 { color: #ffb300; margin-bottom: 30px; text-align: center; }
        .sidebar a { display: block; color: white; text-decoration: none; padding: 10px; margin-bottom: 10px; border-radius: 5px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #d32f2f; }
        .sidebar .logout { background-color: #d32f2f; margin-top: 50px; text-align: center; }
        .main-content { margin-left: 250px; flex: 1; padding: 30px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; color:#333; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        .btn-add { background-color: #2ecc71; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-weight: 600; }
        .btn-add:hover { background-color: #27ae60; }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; font-weight: 600; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-danger { background-color: #f8d7da; color: #721c24; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .btn-delete { background-color: #e74c3c; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 14px; transition: 0.3s; }
        .btn-delete:hover { background-color: #c0392b; }
        .img-preview { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; }
        .category-title { background: #333; color: #FFD700; padding: 10px 15px; border-radius: 5px; margin-top: 25px; margin-bottom: 10px; font-size: 16px; }
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
    <p style="color: #666; margin-bottom: 20px;">Tambah menu baru berdasarkan kategori lengkap dan lihat daftar menu per segmen.</p>

    <?php echo $pesan; ?>

    <!-- Form Tambah Menu -->
    <div class="card">
        <h3>Tambah Menu Baru</h3>
        <form method="POST" action="" enctype="multipart/form-data">
            <div style="display: flex; gap: 20px;">
                <div class="form-group" style="flex: 1;">
                    <label>Nama Menu</label>
                    <input type="text" name="name" placeholder="Contoh: Nasi Ayam Geprek Moza" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Segmen / Kategori</label>
                    <select name="kategori" required>
                        <?php foreach($daftar_kategori as $kat): ?>
                            <option value="<?php echo $kat; ?>"><?php echo $kat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="description" rows="2" placeholder="Deskripsi makanan..."></textarea>
            </div>
            
            <div style="display: flex; gap: 20px;">
                <div class="form-group" style="flex: 1;">
                    <label>Harga (Rp)</label>
                    <input type="number" name="price" placeholder="Contoh: 15000" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Upload Foto Menu</label>
                    <input type="file" name="image_file" accept="image/*">
                </div>
            </div>

            <button type="submit" name="tambah_menu" class="btn-add">+ Simpan Menu</button>
        </form>
    </div>

    <!-- Daftar Menu Dikelompokkan per Kategori -->
    <div class="card">
        <h3>Daftar Seluruh Menu Berdasarkan Kategori</h3>
        
        <?php foreach($daftar_kategori as $kat): ?>
            <div class="category-title">📂 <?php echo $kat; ?></div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 70px;">Gambar</th>
                        <th>Nama Menu</th>
                        <th>Deskripsi</th>
                        <th style="width: 130px;">Harga</th>
                        <th style="width: 90px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query_kat = "SELECT * FROM menu WHERE kategori = '$kat' ORDER BY id DESC";
                    $res_kat = $conn->query($query_kat);
                    
                    if($res_kat && $res_kat->num_rows > 0):
                        while($row = $res_kat->fetch_assoc()):
                    ?>
                        <tr>
                            <td>
                                <img src="../assets/images/menu/<?php echo !empty($row['image_url']) ? $row['image_url'] : 'default.png'; ?>" class="img-preview" alt="Foto">
                            </td>
                            <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                            <td><small style="color:#666;"><?php echo htmlspecialchars($row['description']); ?></small></td>
                            <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="?hapus=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus menu ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                        <tr><td colspan="5" style="text-align:center; color:#999; padding:10px;">Belum ada menu dalam kategori ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endforeach; ?>

    </div>
</div>
</body>
</html>