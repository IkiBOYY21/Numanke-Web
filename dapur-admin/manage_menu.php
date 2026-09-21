<!-- dapur-admin/manage_menu.php -->  
<?php  
session_start();  
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {  
    header("Location: masuk.php");  
    exit();  
}  
require_once '../includes/db.php';  
  
$pesan = '';  

// =========================================================================
// 1. AUTO-INJECT INSTAN (Tanpa klik tombol)
// Mengecek apakah menu "Nasi Ayam Geprek Ori" sudah ada di database
// =========================================================================
$cek_awal = $conn->query("SELECT id FROM menu WHERE name LIKE '%Nasi Ayam Geprek Ori%' LIMIT 1");
if ($cek_awal && $cek_awal->num_rows == 0) {
    // Jika belum ada, langsung masukkan semua menu bawaan secara otomatis
    $semua_menu_statis = [
        'Geprek Series' => [  
            ['nama' => 'Nasi Ayam Geprek Ori', 'single' => '13', 'double' => '18'],  
            ['nama' => 'Nasi Ayam Geprek Keju', 'single' => '15', 'double' => '20'],  
            ['nama' => 'Nasi Ayam Geprek Moza', 'single' => '17', 'double' => '22'],  
            ['nama' => 'Nasi Jamur Geprek Ori', 'single' => '10', 'double' => '14'],  
            ['nama' => 'Nasi Jamur Geprek Keju', 'single' => '12', 'double' => '16'],  
            ['nama' => 'Nasi Jamur Geprek Moza', 'single' => '14', 'double' => '18'],  
            ['nama' => 'Nasi Telur Geprek Ori', 'single' => '11', 'double' => '16'],  
            ['nama' => 'Nasi Telur Geprek Keju', 'single' => '13', 'double' => '18'],  
            ['nama' => 'Nasi Telur Geprek Moza', 'single' => '15', 'double' => '20'],  
            ['nama' => 'Nasi Ayam+Jamur Geprek Ori', 'single' => '13', 'double' => '18'],  
            ['nama' => 'Nasi Ayam+Jamur Geprek Keju', 'single' => '15', 'double' => '20'],  
            ['nama' => 'Nasi Ayam+Jamur Geprek Moza', 'single' => '17', 'double' => '22'],  
        ],
        'Dewata Series' => [  
            ['nama' => 'Nasi Ayam Geprek Dewata Ori', 'single' => '15', 'double' => '19'],  
            ['nama' => 'Nasi Ayam Geprek Dewata Keju', 'single' => '17', 'double' => '21'],  
            ['nama' => 'Nasi Ayam Geprek Dewata Moza', 'single' => '19', 'double' => '23'],  
            ['nama' => 'Nasi Jamur Geprek Dewata Ori', 'single' => '12', 'double' => '16'],  
            ['nama' => 'Nasi Jamur Geprek Dewata Keju', 'single' => '14', 'double' => '18'],  
            ['nama' => 'Nasi Jamur Geprek Dewata Moza', 'single' => '16', 'double' => '20'],  
            ['nama' => 'Nasi Ayam Brongot Dewata Ori', 'single' => '17', 'double' => '23'],  
            ['nama' => 'Nasi Ayam Brongot Dewata Keju', 'single' => '19', 'double' => '24'],  
            ['nama' => 'Nasi Ayam Brongot Dewata Moza', 'single' => '21', 'double' => '26'],  
            ['nama' => 'Nasi Jamur Brongot Dewata Ori', 'single' => '14', 'double' => '18'],  
            ['nama' => 'Nasi Jamur Brongot Dewata Keju', 'single' => '16', 'double' => '20'],  
            ['nama' => 'Nasi Jamur Brongot Dewata Moza', 'single' => '18', 'double' => '22'],  
            ['nama' => 'Nasi Mix Geprek Dewata Ori', 'single' => '14', 'double' => '19'],  
            ['nama' => 'Nasi Mix Geprek Dewata Keju', 'single' => '15', 'double' => '20'],  
            ['nama' => 'Nasi Mix Geprek Dewata Moza', 'single' => '17', 'double' => '23'],  
            ['nama' => 'Nasi Mix Brongot Dewata Ori', 'single' => '16', 'double' => '21'],  
            ['nama' => 'Nasi Mix Brongot Dewata Keju', 'single' => '18', 'double' => '23'],  
            ['nama' => 'Nasi Mix Brongot Dewata Moza', 'single' => '20', 'double' => '25'],  
        ],
        'Brongot Series' => [  
            ['nama' => 'Nasi Ayam Brongot Ori', 'single' => '15', 'double' => '20'],  
            ['nama' => 'Nasi Ayam Brongot Keju', 'single' => '17', 'double' => '22'],  
            ['nama' => 'Nasi Ayam Brongot Moza', 'single' => '19', 'double' => '24'],  
            ['nama' => 'Nasi Jamur Brongot Ori', 'single' => '12', 'double' => '17'],  
            ['nama' => 'Nasi Jamur Brongot Keju', 'single' => '14', 'double' => '19'],  
            ['nama' => 'Nasi Jamur Brongot Moza', 'single' => '16', 'double' => '21'],  
            ['nama' => 'Nasi Telur Brongot Ori', 'single' => '11', 'double' => '17'],  
            ['nama' => 'Nasi Telur Brongot Keju', 'single' => '13', 'double' => '19'],  
            ['nama' => 'Nasi Telur Brongot Moza', 'single' => '15', 'double' => '21'],  
            ['nama' => 'Nasi Ayam+Jamur Brongot Ori', 'single' => '15', 'double' => '20'],  
            ['nama' => 'Nasi Ayam+Jamur Brongot Keju', 'single' => '17', 'double' => '22'],  
            ['nama' => 'Nasi Ayam+Jamur Brongot Moza', 'single' => '19', 'double' => '24'],  
        ],
        'Rongot Series' => [  
            ['nama' => 'Rongot Freeze Coklat', 'harga' => '11'],  
            ['nama' => 'Rongot Freeze Keju', 'harga' => '12'],  
            ['nama' => 'Rongot Freeze Coklat Keju', 'harga' => '14'],  
            ['nama' => 'Rongot Freeze Coklat Keju Moza', 'harga' => '20'],  
            ['nama' => 'Rongot Freeze Chocomalt', 'harga' => '13'],  
            ['nama' => 'Rongot Freeze Chocomalt Keju', 'harga' => '16'],  
            ['nama' => 'Rongot Freeze Chocomalt Moza', 'harga' => '18'],  
            ['nama' => 'Rongot Freeze Chocomalt Keju Moza', 'harga' => '21'],  
            ['nama' => 'Rongot Coklat', 'harga' => '8'],  
            ['nama' => 'Rongot Keju', 'harga' => '9'],  
            ['nama' => 'Rongot Coklat Keju', 'harga' => '11'],  
            ['nama' => 'Rongot Coklat Keju Moza', 'harga' => '16'],  
        ],
        'Frozen Series' => [  
            ['nama' => 'Ayam Brongot Frozen', 'single' => '29', 'double' => '49'],  
            ['nama' => 'Jamur Brongot Frozen', 'single' => '24', 'double' => '42'],  
            ['nama' => 'Bakso Brongot Frozen', 'single' => '27', 'double' => '37'],  
            ['nama' => 'Sambal Numan (Bawang/Dewata)', 'harga' => '33'],  
        ],
        'Drink' => [  
            ['nama' => 'Lyche Float', 'harga' => '12'],  
            ['nama' => 'Strawberry Float', 'harga' => '12'],  
            ['nama' => 'Mango Float', 'harga' => '12'],  
            ['nama' => 'Lemon Float', 'harga' => '13'],  
            ['nama' => 'Choco Float', 'harga' => '13'],  
            ['nama' => 'Teh Tarik Float', 'harga' => '13'],  
            ['nama' => 'Choco Malt Float', 'harga' => '13'],  
            ['nama' => 'Cappucino Float', 'harga' => '14'],  
            ['nama' => 'Lyche Squash', 'harga' => '9'],  
            ['nama' => 'Strawberry Squash', 'harga' => '9'],  
            ['nama' => 'Mango Squash', 'harga' => '9'],  
            ['nama' => 'Lemon Squash', 'harga' => '9'],  
            ['nama' => 'Es Teh', 'harga' => '4'],  
            ['nama' => 'Strawberry Tea', 'harga' => '7'],  
            ['nama' => 'Lychee Tea', 'harga' => '7'],  
            ['nama' => 'Lemon Tea', 'harga' => '7'],  
            ['nama' => 'Mango Tea', 'harga' => '7'],  
            ['nama' => 'Es Coklat', 'harga' => '7'],  
            ['nama' => 'Es Teh Tarik', 'harga' => '7'],  
            ['nama' => 'Es Choco Malt', 'harga' => '7'],  
            ['nama' => 'Es Cappucino', 'harga' => '8'],  
            ['nama' => 'Es Batu', 'harga' => '1'],  
            ['nama' => 'Air Es / Biasa / Hangat', 'harga' => '2'],  
            ['nama' => 'Air Mineral Botol', 'harga' => '5'],  
            ['nama' => 'Es Mango', 'harga' => '5'],  
            ['nama' => 'Es Lemon', 'harga' => '5'],  
            ['nama' => 'Es Strawberry', 'harga' => '5'],  
            ['nama' => 'Es Lychee', 'harga' => '5'],  
        ]
    ];

    foreach ($semua_menu_statis as $kat => $items) {
        foreach ($items as $item) {
            $nama = $conn->real_escape_string($item['nama']);
            if (isset($item['single'])) {
                $hS = (int)$item['single'] * 1000;
                $hD = (int)$item['double'] * 1000;
                $nameS = $nama . " [Single]";
                $nameD = $nama . " [Double]";
                $conn->query("INSERT INTO menu (name, kategori, description, price, image_url) VALUES ('$nameS', '$kat', '', '$hS', 'default.png')");
                $conn->query("INSERT INTO menu (name, kategori, description, price, image_url) VALUES ('$nameD', '$kat', '', '$hD', 'default.png')");
            } else {
                $h = (int)$item['harga'] * 1000;
                $conn->query("INSERT INTO menu (name, kategori, description, price, image_url) VALUES ('$nama', '$kat', '', '$h', 'default.png')");
            }
        }
    }
    // Refresh otomatis setelah data disuntikkan
    header("Location: manage_menu.php?sukses=init");
    exit();
}

// =========================================================================
// 2. LOGIKA TAMBAH MENU
// =========================================================================
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
        move_uploaded_file($_FILES['image_file']['tmp_name'], $target_dir . $image_name);  
    }  
  
    if ($conn->query("INSERT INTO menu (name, kategori, description, price, image_url) VALUES ('$nama', '$kategori', '$desc', '$harga', '$image_name')")) {  
        $pesan = "<div class='alert alert-success' style='padding:15px; background:#d1e7dd; color:#0f5132; border-radius:8px; margin-bottom:20px;'>Berhasil menambahkan menu ke kategori $kategori!</div>";  
    } else {  
        $pesan = "<div class='alert alert-danger' style='padding:15px; background:#f8d7da; color:#842029; border-radius:8px; margin-bottom:20px;'>Gagal menambah menu: " . $conn->error . "</div>";  
    }  
}  

// =========================================================================
// 3. LOGIKA EDIT MENU
// =========================================================================
if (isset($_POST['edit_menu'])) {  
    $id = $conn->real_escape_string($_POST['id_menu']);  
    $nama = $conn->real_escape_string($_POST['name']);  
    $kategori = $conn->real_escape_string($_POST['kategori']);   
    $desc = $conn->real_escape_string($_POST['description']);  
    $harga = $conn->real_escape_string($_POST['price']);  
  
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {  
        $target_dir = "../assets/images/menu/";  
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }  
        $file_extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);  
        $image_name = time() . "_" . preg_replace("/[^a-zA-Z0-9]/", "", $nama) . "." . $file_extension;  
        move_uploaded_file($_FILES['image_file']['tmp_name'], $target_dir . $image_name);  
        
        $old_img = $conn->query("SELECT image_url FROM menu WHERE id='$id'")->fetch_assoc()['image_url'];
        if ($old_img != 'default.png' && file_exists($target_dir . $old_img)) { unlink($target_dir . $old_img); }

        $conn->query("UPDATE menu SET name='$nama', kategori='$kategori', description='$desc', price='$harga', image_url='$image_name' WHERE id='$id'");
    } else {  
        $conn->query("UPDATE menu SET name='$nama', kategori='$kategori', description='$desc', price='$harga' WHERE id='$id'");
    }  
    $pesan = "<div class='alert alert-success' style='padding:15px; background:#d1e7dd; color:#0f5132; border-radius:8px; margin-bottom:20px;'>Menu berhasil diperbarui!</div>";  
}

// =========================================================================
// 4. LOGIKA HAPUS MENU
// =========================================================================
if (isset($_GET['hapus'])) {  
    $id_hapus = $conn->real_escape_string($_GET['hapus']);  
    $img_row = $conn->query("SELECT image_url FROM menu WHERE id = '$id_hapus'")->fetch_assoc();  
    if($img_row) {  
        $file_path = "../assets/images/menu/" . $img_row['image_url'];  
        if(file_exists($file_path) && $img_row['image_url'] != 'default.png') { unlink($file_path); }  
    }  
    $conn->query("DELETE FROM menu WHERE id = '$id_hapus'");  
    header("Location: manage_menu.php");  
    exit();  
}  

if (isset($_GET['sukses']) && $_GET['sukses'] == 'init') {
    $pesan = "<div class='alert alert-success' style='padding:15px; background:#d1e7dd; color:#0f5132; border-radius:8px; margin-bottom:20px;'>Semua menu bawaan berhasil dimuat ke sistem! Anda bisa mulai mengeditnya.</div>";
}

// Cek Jika Sedang Mode Edit
$edit_mode = false;
$data_edit = null;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id_edit = $conn->real_escape_string($_GET['edit']);
    $data_edit = $conn->query("SELECT * FROM menu WHERE id = '$id_edit'")->fetch_assoc();
}

// =========================================================================
// MENGAMBIL DAFTAR KATEGORI
// =========================================================================
$kategori_list = ['Geprek Series', 'Dewata Series', 'Brongot Series', 'Rongot Series', 'Frozen Series', 'Drink'];
$res_kat_db = $conn->query("SELECT DISTINCT kategori FROM menu WHERE kategori != '' AND kategori IS NOT NULL ORDER BY kategori ASC");
if($res_kat_db) {
    while($r = $res_kat_db->fetch_assoc()) {
        if(!in_array($r['kategori'], $kategori_list)) {
            $kategori_list[] = $r['kategori'];
        }
    }
}
?>  
  
<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Kelola Menu - Admin Numanke</title>  
    <link rel="stylesheet" href="../assets/css/admin.css">
    <style>
        .btn-edit { background-color: #fff; color: #0dcaf0; padding: 8px 15px; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600; border: 1px solid #0dcaf0; transition: 0.3s; margin-right: 5px;}
        .btn-edit:hover { background-color: #0dcaf0; color: white; }
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
    <div class="header-flex">
        <div>
            <h1>Katalog Menu Makanan</h1>  
            <p style="margin-bottom: 0;">Tambah, edit nama dan harga, serta kelola kategori menu secara bebas.</p>  
        </div>
    </div>
  
    <?php echo $pesan; ?>  
  
    <div class="card">  
        <h3><?php echo $edit_mode ? '✎ Edit Data Menu' : 'Tambah Menu Baru'; ?></h3>  
        <form method="POST" action="manage_menu.php" enctype="multipart/form-data">  
            <?php if($edit_mode): ?>
                <input type="hidden" name="id_menu" value="<?php echo $data_edit['id']; ?>">
            <?php endif; ?>
            
            <div class="flex-row-form">  
                <div class="form-group" style="flex: 1;">  
                    <label>Nama Menu</label>  
                    <input type="text" name="name" value="<?php echo $edit_mode ? htmlspecialchars($data_edit['name']) : ''; ?>" placeholder="Contoh: Nasi Ayam Geprek Moza" required>  
                </div>  
                <div class="form-group" style="flex: 1;">  
                    <label>Segmen / Kategori</label>  
                    <input type="text" name="kategori" list="kat-list" value="<?php echo $edit_mode ? htmlspecialchars($data_edit['kategori']) : ''; ?>" placeholder="Pilih atau ketik kategori baru..." required>  
                    <datalist id="kat-list">
                        <?php foreach($kategori_list as $kat): ?>  
                            <option value="<?php echo htmlspecialchars($kat); ?>">  
                        <?php endforeach; ?>  
                    </datalist>
                </div>  
            </div>  
  
            <div class="form-group">  
                <label>Deskripsi Singkat</label>  
                <textarea name="description" rows="2" placeholder="Deskripsi komposisi atau rasa makanan..."><?php echo $edit_mode ? htmlspecialchars($data_edit['description']) : ''; ?></textarea>  
            </div>  
   
            <div class="flex-row-form">  
                <div class="form-group" style="flex: 1;">  
                    <label>Harga (Rp)</label>  
                    <input type="number" name="price" value="<?php echo $edit_mode ? $data_edit['price'] : ''; ?>" placeholder="Contoh: 15000" required>  
                </div>  
                <div class="form-group" style="flex: 1;">  
                    <label>Upload Foto Menu <?php echo $edit_mode ? '(Biarkan kosong jika tidak diubah)' : ''; ?></label>  
                    <input type="file" name="image_file" accept="image/*">  
                </div>  
            </div>  
  
            <?php if($edit_mode): ?>
                <button type="submit" name="edit_menu" class="btn-add" style="background:#0dcaf0;">Simpan Perubahan</button>  
                <a href="manage_menu.php" class="btn-delete" style="margin-left: 10px; padding: 12px 25px;">Batal Edit</a>
            <?php else: ?>
                <button type="submit" name="tambah_menu" class="btn-add">+ Simpan Menu</button>  
            <?php endif; ?>
        </form>  
    </div>  
  
    <div class="card">  
        <h3>Daftar Seluruh Menu Berdasarkan Kategori</h3>  
        <?php foreach($kategori_list as $kat): ?>  
            <h4 style="background: #2c3338; color: #FFD700; padding: 12px 20px; border-radius: 8px 8px 0 0; margin: 30px 0 0 0; font-size: 1rem;">📂 <?php echo htmlspecialchars($kat); ?></h4>  
            <table style="border: 1px solid #f0f0f0; border-top: none; margin-bottom: 30px;">  
                <thead>  
                    <tr>  
                        <th style="width: 80px; text-align: center;">Gambar</th>  
                        <th>Nama Menu</th>  
                        <th>Deskripsi</th>  
                        <th style="width: 130px;">Harga</th>  
                        <th style="width: 160px; text-align: center;">Aksi</th>  
                    </tr>  
                </thead>  
                <tbody>  
                    <?php   
                    $query_menu = "SELECT * FROM menu WHERE kategori = '" . $conn->real_escape_string($kat) . "' ORDER BY name ASC";  
                    $res_menu = $conn->query($query_menu);  
                    if($res_menu && $res_menu->num_rows > 0):  
                        while($row = $res_menu->fetch_assoc()):  
                    ?>  
                    <tr>  
                        <td style="text-align: center;">  
                            <img src="../assets/images/menu/<?php echo !empty($row['image_url']) ? $row['image_url'] : 'default.png'; ?>" alt="Foto" style="width:50px; height:50px; object-fit:cover; border-radius:6px;">  
                        </td>  
                        <td class="text-dark-bold"><?php echo htmlspecialchars($row['name']); ?></td>  
                        <td><span style="color:#6c757d; font-size: 0.9rem;"><?php echo htmlspecialchars($row['description']); ?></span></td>  
                        <td class="text-price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>  
                        <td style="text-align: center;">  
                            <a href="?edit=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                            <a href="?hapus=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus menu ini secara permanen?');">Hapus</a>  
                        </td>  
                    </tr>  
                    <?php endwhile; else: ?>  
                    <tr><td colspan="5" style="text-align:center; color:#999; padding:20px;">Belum ada menu dalam kategori ini.</td></tr>  
                    <?php endif; ?>  
                </tbody>  
            </table>  
        <?php endforeach; ?>  
    </div>  
</div>  
</body>  
</html>