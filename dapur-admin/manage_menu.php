<?php  
// dapur-admin/manage_menu.php
session_start();  
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {  
    header("Location: masuk.php");  
    exit();  
}  
require_once '../includes/db.php';  
  
$pesan = '';  

// =========================================================================
// 1. AUTO-INJECT INSTAN (Tanpa klik tombol)
// =========================================================================
$cek_awal = $conn->query("SELECT id FROM menu WHERE name LIKE '%Nasi Ayam Geprek Ori%' LIMIT 1");
if ($cek_awal && $cek_awal->num_rows == 0) {
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
    $harga = (float)$conn->real_escape_string($_POST['price']);  
    $image_name = "default.png";  
  
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {  
        $target_dir = "../assets/images/menu/";  
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }  
        $file_extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);  
        $image_name = time() . "_" . preg_replace("/[^a-zA-Z0-9]/", "", $nama) . "." . $file_extension;  
        move_uploaded_file($_FILES['image_file']['tmp_name'], $target_dir . $image_name);  
    }  
  
    if ($conn->query("INSERT INTO menu (name, kategori, description, price, image_url) VALUES ('$nama', '$kategori', '$desc', '$harga', '$image_name')")) {  
        $pesan = "<div class='toast-notice' style='border-left-color:#10b981;'><i class='fa-solid fa-circle-check text-success fs-5'></i> <div><strong>Berhasil!</strong> Menu <b>" . htmlspecialchars($nama) . "</b> berhasil ditambahkan.</div></div>";  
    } else {  
        $pesan = "<div class='toast-notice' style='border-left-color:#ef4444;'><i class='fa-solid fa-circle-exclamation text-danger fs-5'></i> <div><strong>Gagal!</strong> " . $conn->error . "</div></div>";  
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
    $harga = (float)$conn->real_escape_string($_POST['price']);  
  
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
    $pesan = "<div class='toast-notice' style='border-left-color:#10b981;'><i class='fa-solid fa-circle-check text-success fs-5'></i> <div><strong>Berhasil!</strong> Data menu telah diperbarui.</div></div>";  
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
    header("Location: manage_menu.php?sukses=hapus");  
    exit();  
}  

if (isset($_GET['sukses']) && $_GET['sukses'] == 'hapus') {
    $pesan = "<div class='toast-notice' style='border-left-color:#ef4444;'><i class='fa-solid fa-trash-can text-danger fs-5'></i> <div>Menu berhasil dihapus dari sistem.</div></div>";
}
if (isset($_GET['sukses']) && $_GET['sukses'] == 'init') {
    $pesan = "<div class='toast-notice' style='border-left-color:#10b981;'><i class='fa-solid fa-circle-check text-success fs-5'></i> <div>Semua menu bawaan berhasil dimuat ke sistem!</div></div>";
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
// 5. QUERY DAFTAR KATEGORI & STATISTIK
// =========================================================================
$canonical_categories = ['Geprek Series', 'Dewata Series', 'Brongot Series', 'Rongot Series', 'Frozen Series', 'Drink'];
$kategori_list = $canonical_categories;

$res_kat_db = $conn->query("SELECT DISTINCT kategori FROM menu WHERE kategori != '' AND kategori IS NOT NULL ORDER BY kategori ASC");
if($res_kat_db) {
    while($r = $res_kat_db->fetch_assoc()) {
        if(!in_array($r['kategori'], $kategori_list)) {
            $kategori_list[] = $r['kategori'];
        }
    }
}

// Query Ringkasan Statistik
$stat_total_menu = 0;
$stat_total_porsi = 0;
$stat_min_price = 0;
$stat_max_price = 0;

$q_stats = $conn->query("SELECT COUNT(*) as total, 
    COUNT(CASE WHEN name LIKE '%[Single]%' OR name LIKE '%[Double]%' THEN 1 END) as porsi,
    MIN(price) as min_p, MAX(price) as max_p FROM menu");
if ($q_stats && $srow = $q_stats->fetch_assoc()) {
    $stat_total_menu = (int)$srow['total'];
    $stat_total_porsi = (int)$srow['porsi'];
    $stat_min_price = (int)$srow['min_p'];
    $stat_max_price = (int)$srow['max_p'];
}

// Query Seluruh Data Menu
$query_all = "SELECT * FROM menu ORDER BY 
    CASE 
        WHEN kategori = 'Geprek Series' THEN 1
        WHEN kategori = 'Brongot Series' THEN 2
        WHEN kategori = 'Dewata Series' THEN 3
        WHEN kategori = 'Rongot Series' THEN 4
        WHEN kategori = 'Frozen Series' THEN 5
        WHEN kategori = 'Drink' THEN 6
        ELSE 7
    END, id ASC";
$res_all = $conn->query($query_all);
$menu_items = [];
$counts_by_kat = [];
if ($res_all) {
    while($m = $res_all->fetch_assoc()) {
        $menu_items[] = $m;
        $k = $m['kategori'] ?: 'Lainnya';
        $counts_by_kat[$k] = ($counts_by_kat[$k] ?? 0) + 1;
    }
}
?>  
<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Kelola Katalog Menu - Admin Numanke</title>  
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>  
<body>  
  
<!-- SIDEBAR -->
<div class="sidebar">  
    <a href="index.php" class="sidebar-brand">
        <img src="../assets/images/logo numanke.png" alt="Numanke">
        <div class="sidebar-brand-text">
            <h2>Numanke<span>.</span></h2>
            <small>Dapur Admin</small>
        </div>
    </a>

    <div class="sidebar-nav">
        <span class="nav-category">Navigasi Utama</span>
        <a href="index.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
        <a href="manage_stories.php"><i class="fa-solid fa-newspaper"></i> Cerita & Berita</a>
        <a href="manage_settings.php"><i class="fa-solid fa-sliders"></i> Pengaturan Web</a>
        
        <span class="nav-category">Pesanan & Menu</span>
        <a href="manage_orders.php"><i class="fa-solid fa-cart-shopping"></i> Kelola Pesanan</a>
        <a href="manage_menu.php" class="active"><i class="fa-solid fa-bowl-food"></i> Kelola Menu</a>
    </div>

    <div class="sidebar-bottom">
        <a href="../order.php" target="_blank" class="btn-view-site">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Menu Web
        </a>
        <a href="keluar.php" class="logout-link">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
        </a>
    </div>
</div>  
  
<!-- MAIN CONTENT -->
<div class="main-content">  
    
    <!-- Top Header -->
    <div class="admin-header-flex" data-aos="fade-down">
        <div class="admin-header-title">
            <h1>Katalog Menu Restoran</h1>  
            <p>Atur nama, kategori, harga porsi, foto produk, dan sinkronkan langsung dengan pop-up pemesanan pelanggan.</p>  
        </div>
        <div class="admin-header-actions">
            <span class="live-status-pill">
                <span class="live-dot"></span>
                <span>Tersinkron Real-time</span>
            </span>
            <a href="#formMenuSection" class="admin-btn admin-btn-primary">
                <i class="fa-solid fa-plus"></i> Tambah Menu Baru
            </a>
        </div>
    </div>
  
    <?php echo $pesan; ?>  

    <!-- STAT CARDS (4 Ringkasan Statistik) -->
    <div class="stat-card-container" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-card red">
            <div class="stat-card-header">
                <h4>Total Menu Aktif</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-bowl-food"></i></div>
            </div>
            <h2><?php echo number_format($stat_total_menu, 0, ',', '.'); ?></h2>
            <div class="stat-card-trend">
                <i class="fa-solid fa-circle-check"></i> Siap dipesan di website
            </div>
        </div>

        <div class="stat-card gold">
            <div class="stat-card-header">
                <h4>Kategori Menu</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-layer-group"></i></div>
            </div>
            <h2><?php echo count($kategori_list); ?> Kategori</h2>
            <div class="stat-card-trend" style="color: var(--admin-gold);">
                <i class="fa-solid fa-tags"></i> Geprek, Brongot, Dewata, dll.
            </div>
        </div>

        <div class="stat-card purple">
            <div class="stat-card-header">
                <h4>Varian Porsi</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-utensils"></i></div>
            </div>
            <h2><?php echo $stat_total_porsi; ?> Porsi</h2>
            <div class="stat-card-trend" style="color: #7c3aed;">
                <i class="fa-solid fa-sparkles"></i> Single & Double otomatis
            </div>
        </div>

        <div class="stat-card green">
            <div class="stat-card-header">
                <h4>Rentang Harga</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-wallet"></i></div>
            </div>
            <h2>Rp <?php echo number_format($stat_min_price, 0, ',', '.'); ?> - <?php echo number_format($stat_max_price, 0, ',', '.'); ?></h2>
            <div class="stat-card-trend" style="color: #059669;">
                <i class="fa-solid fa-arrow-trend-up"></i> Terjangkau & kompetitif
            </div>
        </div>
    </div>

    <!-- FORM TAMBAH / EDIT MENU (ELEGANT CARD) -->
    <div class="admin-card" id="formMenuSection" data-aos="fade-up" data-aos-delay="150" style="<?php echo $edit_mode ? 'border: 2px solid var(--admin-gold); box-shadow: 0 0 25px rgba(245, 159, 0, 0.2);' : ''; ?>">  
        <div class="admin-card-header">
            <div>
                <h3>
                    <i class="fa-solid <?php echo $edit_mode ? 'fa-pen-to-square text-warning' : 'fa-circle-plus text-danger'; ?>"></i>
                    <span><?php echo $edit_mode ? 'Edit Data Menu: ' . htmlspecialchars($data_edit['name']) : 'Tambah Menu Baru ke Katalog'; ?></span>
                </h3>
                <p><?php echo $edit_mode ? 'Ubah informasi menu di bawah lalu tekan tombol Simpan Perubahan.' : 'Lengkapi formulir di bawah untuk menambahkan menu ke daftar produk Numanke.'; ?></p>
            </div>
            <?php if($edit_mode): ?>
                <a href="manage_menu.php" class="admin-btn admin-btn-secondary" style="padding: 8px 16px; font-size: 0.82rem;">
                    <i class="fa-solid fa-xmark"></i> Batalkan Mode Edit
                </a>
            <?php endif; ?>
        </div>

        <!-- TIPS SMART BANNER -->
        <div style="background: #fff8e6; border-left: 4px solid var(--admin-gold); padding: 14px 18px; border-radius: 12px; margin-bottom: 24px; font-size: 0.88rem; color: #78350f; line-height: 1.6; display: flex; gap: 12px; align-items: flex-start;">
            <i class="fa-solid fa-lightbulb text-warning fs-5" style="margin-top: 2px;"></i>
            <div>
                <strong style="color: #b45309; display: block; margin-bottom: 2px;">Tips Penamaan Porsi & Pop-Up Otomatis:</strong>
                • Untuk menu dengan pilihan porsi (Single & Double), tambahkan akhiran <code>[Single]</code> atau <code>[Double]</code> pada nama menu (Contoh: <em>Nasi Ayam Geprek Ori [Single]</em> seharga 13.000 dan <em>Nasi Ayam Geprek Ori [Double]</em> seharga 18.000).<br>
                • Sistem web secara cerdas akan menggabungkan keduanya menjadi satu produk interaktif di web pelanggan lengkap dengan pop-up pilihan porsi dan level pedas 1–5!
            </div>
        </div>

        <form method="POST" action="manage_menu.php" enctype="multipart/form-data">  
            <?php if($edit_mode): ?>
                <input type="hidden" name="id_menu" value="<?php echo $data_edit['id']; ?>">
            <?php endif; ?>
            
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
                <!-- Kolom Kiri: Input Teks -->
                <div>
                    <div class="form-grid-2">
                        <div class="admin-form-group">  
                            <label>Nama Menu <span class="req">*</span></label>  
                            <input type="text" name="name" class="admin-input" value="<?php echo $edit_mode ? htmlspecialchars($data_edit['name']) : ''; ?>" placeholder="Contoh: Nasi Ayam Geprek Moza [Single]" required>  
                        </div>  
                        
                        <div class="admin-form-group">  
                            <label>Kategori Menu <span class="req">*</span></label>  
                            <input type="text" name="kategori" list="kat-list" class="admin-input" value="<?php echo $edit_mode ? htmlspecialchars($data_edit['kategori']) : ''; ?>" placeholder="Pilih atau ketik kategori baru..." required>  
                            <datalist id="kat-list">
                                <?php foreach($kategori_list as $kat): ?>  
                                    <option value="<?php echo htmlspecialchars($kat); ?>">  
                                <?php endforeach; ?>  
                            </datalist>
                        </div>  
                    </div>

                    <div class="admin-form-group">  
                        <label>Harga Jual (Rp) <span class="req">*</span> <small id="pricePreviewTag" style="font-weight:700; color:var(--admin-red); margin-left:8px;"></small></label>  
                        <input type="number" id="inputPrice" name="price" class="admin-input" value="<?php echo $edit_mode ? $data_edit['price'] : ''; ?>" placeholder="Contoh: 15000" oninput="updatePriceTag(this.value)" required>  
                    </div>  

                    <div class="admin-form-group">  
                        <label>Deskripsi Rasa / Komposisi Menu</label>  
                        <textarea name="description" class="admin-textarea" rows="3" placeholder="Contoh: Ayam krispi gurih berpadu dengan ulekan cabai rawit pedas mantap..."><?php echo $edit_mode ? htmlspecialchars($data_edit['description']) : ''; ?></textarea>  
                    </div>  
                </div>

                <!-- Kolom Kanan: Upload Foto dengan Live Preview -->
                <div>
                    <div class="admin-form-group">
                        <label>Foto Produk Makanan <?php echo $edit_mode ? '(Opsional)' : ''; ?></label>
                        <div class="img-preview-box <?php echo ($edit_mode && !empty($data_edit['image_url']) && $data_edit['image_url'] !== 'default.png') ? 'has-img' : ''; ?>" id="dropzonePreview" onclick="document.getElementById('imageFileInput').click()">
                            <img id="previewImg" src="<?php echo ($edit_mode && !empty($data_edit['image_url'])) ? '../assets/images/menu/' . $data_edit['image_url'] : ''; ?>" alt="Preview">
                            <div class="placeholder-ui text-center p-3">
                                <i class="fa-solid fa-cloud-arrow-up fs-2 text-danger mb-2"></i>
                                <div style="font-size: 0.88rem; font-weight: 700; color: var(--admin-dark);">Pilih Foto Menu</div>
                                <small style="color: var(--admin-text-muted); font-size: 0.75rem;">JPG, PNG, atau WebP (Disarankan 1:1)</small>
                            </div>
                        </div>
                        <input type="file" id="imageFileInput" name="image_file" accept="image/*" style="display: none;" onchange="previewSelectedImage(event)">
                        <small style="color: var(--admin-text-muted); font-size: 0.75rem; display: block; margin-top: 6px;">
                            <i class="fa-solid fa-info-circle"></i> Klik kotak di atas untuk memilih foto baru dari galeri/komputer Anda.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 12px; margin-top: 10px; padding-top: 20px; border-top: 1px solid var(--admin-border-subtle);">  
                <?php if($edit_mode): ?>
                    <button type="submit" name="edit_menu" class="admin-btn admin-btn-primary" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Menu
                    </button>  
                    <a href="manage_menu.php" class="admin-btn admin-btn-secondary">
                        <i class="fa-solid fa-xmark"></i> Batal Edit
                    </a>
                <?php else: ?>
                    <button type="submit" name="tambah_menu" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-plus"></i> Simpan & Tayangkan Menu
                    </button>  
                <?php endif; ?>
            </div>  
        </form>  
    </div>  
  
    <!-- DAFTAR SELURUH MENU (INTERACTIVE TABLE CARD) -->
    <div class="admin-table-card" data-aos="fade-up" data-aos-delay="200">  
        <div class="admin-table-card-header">
            <div>
                <h3 style="font-family: 'Playfair Display', serif; font-size: 1.35rem; font-weight: 800; margin: 0; color: var(--admin-dark);">
                    <i class="fa-solid fa-list-check text-danger me-2"></i>Daftar Katalog Menu
                </h3>
                <small style="color: var(--admin-text-muted); font-weight: 600;">
                    Menampilkan <span id="displayedCount" style="color:var(--admin-red); font-weight:800;"><?php echo count($menu_items); ?></span> dari <?php echo count($menu_items); ?> total menu.
                </small>
            </div>

            <!-- Live Search Bar -->
            <div class="admin-search-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="menuSearchInput" class="admin-search-input" placeholder="Cari nama menu, kategori, harga..." onkeyup="filterMenuTable()">
            </div>
        </div>

        <!-- Category Filter Tabs -->
        <div style="padding: 16px 24px 8px 24px; border-bottom: 1px solid var(--admin-border); background: #ffffff;">
            <div class="filter-tab-bar" id="categoryFilterBar">
                <button type="button" class="filter-tab-pill active" onclick="filterByCategory('all', this)">
                    Semua Kategori <span class="pill-count"><?php echo count($menu_items); ?></span>
                </button>
                <?php foreach($kategori_list as $kat): 
                    $count_k = $counts_by_kat[$kat] ?? 0;
                ?>
                    <button type="button" class="filter-tab-pill" onclick="filterByCategory('<?php echo htmlspecialchars($kat); ?>', this)">
                        <?php echo htmlspecialchars($kat); ?> <span class="pill-count"><?php echo $count_k; ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Table View -->
        <div style="overflow-x: auto;">
            <table class="table-modern" id="menuDataTable">  
                <thead>  
                    <tr>  
                        <th style="width: 80px; text-align: center;">Foto</th>  
                        <th>Nama Menu & Porsi</th>  
                        <th>Kategori</th>  
                        <th>Deskripsi Komposisi</th>  
                        <th style="width: 140px;">Harga Jual</th>  
                        <th style="width: 160px; text-align: center;">Tindakan</th>  
                    </tr>  
                </thead>  
                <tbody id="menuTableBody">  
                    <?php if (!empty($menu_items)): ?>
                        <?php foreach($menu_items as $row): 
                            $rawName = $row['name'];
                            $portionBadge = '';
                            if (stripos($rawName, '[Single]') !== false) {
                                $portionBadge = '<span class="badge-portion-tag portion-single-tag ms-1">Single</span>';
                            } elseif (stripos($rawName, '[Double]') !== false) {
                                $portionBadge = '<span class="badge-portion-tag portion-double-tag ms-1">Double</span>';
                            }

                            // Tentukan kelas warna kategori
                            $katClass = 'cat-pill-default';
                            $katName = $row['kategori'];
                            if (stripos($katName, 'geprek') !== false) $katClass = 'cat-pill-geprek';
                            elseif (stripos($katName, 'brongot') !== false) $katClass = 'cat-pill-brongot';
                            elseif (stripos($katName, 'dewata') !== false) $katClass = 'cat-pill-dewata';
                            elseif (stripos($katName, 'rongot') !== false) $katClass = 'cat-pill-rongot';
                            elseif (stripos($katName, 'frozen') !== false) $katClass = 'cat-pill-frozen';
                            elseif (stripos($katName, 'drink') !== false) $katClass = 'cat-pill-drink';

                            $imgSrc = '../assets/images/menu/' . (!empty($row['image_url']) ? $row['image_url'] : 'default.png');
                        ?>
                        <tr class="menu-row-item" data-category="<?php echo htmlspecialchars($row['kategori']); ?>">  
                            <td style="text-align: center;">  
                                <div class="menu-thumb-box">
                                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($rawName); ?>" onerror="this.src='../assets/images/bg-headingweb.png'">
                                </div>
                            </td>  
                            <td>
                                <strong style="color: var(--admin-dark); font-size: 0.95rem; display: inline-flex; align-items: center; gap: 4px;">
                                    <?php echo htmlspecialchars($rawName); ?>
                                    <?php echo $portionBadge; ?>
                                </strong>
                                <div style="font-size: 0.72rem; color: var(--admin-text-muted); margin-top: 2px;">
                                    ID: #MNU-<?php echo $row['id']; ?>
                                </div>
                            </td>  
                            <td>
                                <span class="cat-pill <?php echo $katClass; ?>">
                                    <i class="fa-solid fa-tag"></i> <?php echo htmlspecialchars($row['kategori'] ?: 'Lainnya'); ?>
                                </span>
                            </td>
                            <td>
                                <span style="color: var(--admin-text-muted); font-size: 0.85rem; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?php echo htmlspecialchars($row['description'] ?: 'Belum ada deskripsi'); ?>
                                </span>
                            </td>  
                            <td>
                                <div style="font-weight: 800; color: var(--admin-red); font-size: 1rem; font-family: 'Plus Jakarta Sans', sans-serif;">
                                    Rp <?php echo number_format($row['price'], 0, ',', '.'); ?>
                                </div>
                            </td>  
                            <td style="text-align: center;">  
                                <div style="display: inline-flex; gap: 6px;">
                                    <a href="?edit=<?php echo $row['id']; ?>#formMenuSection" class="btn-action-edit" title="Edit Menu Ini">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="?hapus=<?php echo $row['id']; ?>" class="btn-action-delete" onclick="return confirm('Yakin ingin menghapus menu \'<?php echo addslashes($row['name']); ?>\' secara permanen?');" title="Hapus Menu">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </a>  
                                </div>
                            </td>  
                        </tr>  
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr id="emptyRowGlobal">
                            <td colspan="6">
                                <div class="admin-empty-state">
                                    <i class="fa-solid fa-bowl-food"></i>
                                    <h4>Belum Ada Menu di Database</h4>
                                    <p>Gunakan formulir di atas untuk menambahkan hidangan pertama Anda ke restoran Numanke.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    
                    <!-- Empty State for Live Search -->
                    <tr id="noSearchResultRow" style="display: none;">
                        <td colspan="6">
                            <div class="admin-empty-state">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <h4>Menu Tidak Ditemukan</h4>
                                <p>Tidak ada menu yang sesuai dengan kata kunci pencarian atau kategori yang dipilih.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>  
            </table>  
        </div>
    </div>  

</div>  

<!-- JavaScript untuk Live Image Preview, Price Helper & Instant Search/Filter -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 700, once: true });

    let currentSelectedCategory = 'all';

    // Live preview gambar yang dipilih
    function previewSelectedImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImg = document.getElementById('previewImg');
            const dropzone = document.getElementById('dropzonePreview');
            previewImg.src = e.target.result;
            dropzone.classList.add('has-img');
        };
        reader.readAsDataURL(file);
    }

    // Format harga live tag
    function updatePriceTag(val) {
        const tag = document.getElementById('pricePreviewTag');
        const num = parseInt(val, 10);
        if (!isNaN(num) && num > 0) {
            tag.innerText = `(Rp ${num.toLocaleString('id-ID')})`;
        } else {
            tag.innerText = '';
        }
    }

    // Filter berdasarkan kategori tab
    function filterByCategory(kat, btnEl) {
        currentSelectedCategory = kat;

        // Update active class pada pill
        document.querySelectorAll('#categoryFilterBar .filter-tab-pill').forEach(btn => {
            btn.classList.remove('active');
        });
        if (btnEl) btnEl.classList.add('active');

        filterMenuTable();
    }

    // Instant filter tabel berdasarkan pencarian teks dan kategori aktif
    function filterMenuTable() {
        const query = (document.getElementById('menuSearchInput').value || '').toLowerCase().trim();
        const rows = document.querySelectorAll('#menuTableBody .menu-row-item');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowKat = (row.getAttribute('data-category') || '').trim();
            const rowText = row.innerText.toLowerCase();

            const matchCat = (currentSelectedCategory === 'all') || (rowKat.toLowerCase() === currentSelectedCategory.toLowerCase());
            const matchSearch = (query === '') || (rowText.includes(query));

            if (matchCat && matchSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const displayedCountEl = document.getElementById('displayedCount');
        if (displayedCountEl) displayedCountEl.innerText = visibleCount;

        const noResultRow = document.getElementById('noSearchResultRow');
        if (noResultRow) {
            noResultRow.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
        }
    }

    // Init price tag on load if editing
    document.addEventListener('DOMContentLoaded', () => {
        const curPrice = document.getElementById('inputPrice');
        if (curPrice && curPrice.value) {
            updatePriceTag(curPrice.value);
        }
    });
</script>
</body>  
</html>