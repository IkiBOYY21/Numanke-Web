<!-- order.php -->
<?php 
require_once 'includes/header.php'; 

// =========================================================================
// DATA MENU NUMANKE
// =========================================================================

$menu_geprek = [
    ['nama' => 'Nasi Ayam Geprek Ori', 'single' => '13 K', 'double' => '18 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Ayam Geprek Keju', 'single' => '15 K', 'double' => '20 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Ayam Geprek Moza', 'single' => '17 K', 'double' => '22 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Jamur Geprek Ori', 'single' => '10 K', 'double' => '14 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Jamur Geprek Keju', 'single' => '12 K', 'double' => '16 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Jamur Geprek Moza', 'single' => '14 K', 'double' => '18 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Telur Geprek Ori', 'single' => '11 K', 'double' => '16 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Telur Geprek Keju', 'single' => '13 K', 'double' => '18 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Telur Geprek Moza', 'single' => '15 K', 'double' => '20 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Ayam+Jamur Geprek Ori', 'single' => '13 K', 'double' => '18 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Ayam+Jamur Geprek Keju', 'single' => '15 K', 'double' => '20 K', 'img' => '', 'icon' => 'fa-utensils'],
    ['nama' => 'Nasi Ayam+Jamur Geprek Moza', 'single' => '17 K', 'double' => '22 K', 'img' => '', 'icon' => 'fa-utensils'],
];

$menu_dewata = [
    ['nama' => 'Nasi Ayam Geprek Dewata Ori', 'single' => '15 K', 'double' => '19 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Ayam Geprek Dewata Keju', 'single' => '17 K', 'double' => '21 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Ayam Geprek Dewata Moza', 'single' => '19 K', 'double' => '23 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Jamur Geprek Dewata Ori', 'single' => '12 K', 'double' => '16 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Jamur Geprek Dewata Keju', 'single' => '14 K', 'double' => '18 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Jamur Geprek Dewata Moza', 'single' => '16 K', 'double' => '20 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Ayam Brongot Dewata Ori', 'single' => '17 K', 'double' => '23 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Ayam Brongot Dewata Keju', 'single' => '19 K', 'double' => '24 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Ayam Brongot Dewata Moza', 'single' => '21 K', 'double' => '26 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Jamur Brongot Dewata Ori', 'single' => '14 K', 'double' => '18 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Jamur Brongot Dewata Keju', 'single' => '16 K', 'double' => '20 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Jamur Brongot Dewata Moza', 'single' => '18 K', 'double' => '22 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Mix Geprek Dewata Ori', 'single' => '14 K', 'double' => '19 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Mix Geprek Dewata Keju', 'single' => '15 K', 'double' => '20 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Mix Geprek Dewata Moza', 'single' => '17 K', 'double' => '23 K', 'img' => '', 'icon' => 'fa-leaf'],
    ['nama' => 'Nasi Mix Brongot Dewata Ori', 'single' => '16 K', 'double' => '21 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Mix Brongot Dewata Keju', 'single' => '18 K', 'double' => '23 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Mix Brongot Dewata Moza', 'single' => '20 K', 'double' => '25 K', 'img' => '', 'icon' => 'fa-fire'],
];

$menu_brongot = [
    ['nama' => 'Nasi Ayam Brongot Ori', 'single' => '15 K', 'double' => '20 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Ayam Brongot Keju', 'single' => '17 K', 'double' => '22 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Ayam Brongot Moza', 'single' => '19 K', 'double' => '24 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Jamur Brongot Ori', 'single' => '12 K', 'double' => '17 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Jamur Brongot Keju', 'single' => '14 K', 'double' => '19 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Jamur Brongot Moza', 'single' => '16 K', 'double' => '21 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Telur Brongot Ori', 'single' => '11 K', 'double' => '17 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Telur Brongot Keju', 'single' => '13 K', 'double' => '19 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Telur Brongot Moza', 'single' => '15 K', 'double' => '21 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Ayam+Jamur Brongot Ori', 'single' => '15 K', 'double' => '20 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Ayam+Jamur Brongot Keju', 'single' => '17 K', 'double' => '22 K', 'img' => '', 'icon' => 'fa-fire'],
    ['nama' => 'Nasi Ayam+Jamur Brongot Moza', 'single' => '19 K', 'double' => '24 K', 'img' => '', 'icon' => 'fa-fire'],
];

$menu_rongot = [
    ['nama' => 'Rongot Freeze Coklat', 'harga' => '11 K', 'img' => '', 'icon' => 'fa-ice-cream'],
    ['nama' => 'Rongot Freeze Keju', 'harga' => '12 K', 'img' => '', 'icon' => 'fa-ice-cream'],
    ['nama' => 'Rongot Freeze Coklat Keju', 'harga' => '14 K', 'img' => '', 'icon' => 'fa-ice-cream'],
    ['nama' => 'Rongot Freeze Coklat Keju Moza', 'harga' => '20 K', 'img' => '', 'icon' => 'fa-ice-cream'],
    ['nama' => 'Rongot Freeze Chocomalt', 'harga' => '13 K', 'img' => '', 'icon' => 'fa-ice-cream'],
    ['nama' => 'Rongot Freeze Chocomalt Keju', 'harga' => '16 K', 'img' => '', 'icon' => 'fa-ice-cream'],
    ['nama' => 'Rongot Freeze Chocomalt Moza', 'harga' => '18 K', 'img' => '', 'icon' => 'fa-ice-cream'],
    ['nama' => 'Rongot Freeze Chocomalt Keju Moza', 'harga' => '21 K', 'img' => '', 'icon' => 'fa-ice-cream'],
    ['nama' => 'Rongot Coklat', 'harga' => '8 K', 'img' => '', 'icon' => 'fa-bread-slice'],
    ['nama' => 'Rongot Keju', 'harga' => '9 K', 'img' => '', 'icon' => 'fa-bread-slice'],
    ['nama' => 'Rongot Coklat Keju', 'harga' => '11 K', 'img' => '', 'icon' => 'fa-bread-slice'],
    ['nama' => 'Rongot Coklat Keju Moza', 'harga' => '16 K', 'img' => '', 'icon' => 'fa-bread-slice'],
];

$menu_frozen = [
    ['nama' => 'Ayam Brongot Frozen', 'single' => '29 K', 'single_label' => '1/4 Kg', 'double' => '49 K', 'double_label' => '1/2 Kg', 'img' => '', 'icon' => 'fa-snowflake'],
    ['nama' => 'Jamur Brongot Frozen', 'single' => '24 K', 'single_label' => '1/4 Kg', 'double' => '42 K', 'double_label' => '1/2 Kg', 'img' => '', 'icon' => 'fa-snowflake'],
    ['nama' => 'Bakso Brongot Frozen', 'single' => '27 K', 'single_label' => '15 Pcs', 'double' => '37 K', 'double_label' => '25 Pcs', 'img' => '', 'icon' => 'fa-snowflake'],
    ['nama' => 'Sambal Numan (Bawang/Dewata)', 'harga' => '33 K', 'img' => '', 'icon' => 'fa-pepper-hot'],
];

$menu_drink = [
    ['nama' => 'Lyche Float', 'harga' => '12 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Strawberry Float', 'harga' => '12 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Mango Float', 'harga' => '12 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Lemon Float', 'harga' => '13 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Choco Float', 'harga' => '13 K', 'img' => '', 'icon' => 'fa-mug-hot'],
    ['nama' => 'Teh Tarik Float', 'harga' => '13 K', 'img' => '', 'icon' => 'fa-mug-hot'],
    ['nama' => 'Choco Malt Float', 'harga' => '13 K', 'img' => '', 'icon' => 'fa-mug-hot'],
    ['nama' => 'Cappucino Float', 'harga' => '14 K', 'img' => '', 'icon' => 'fa-mug-hot'],
    ['nama' => 'Lyche Squash', 'harga' => '9 K', 'img' => '', 'icon' => 'fa-martini-glass-citrus'],
    ['nama' => 'Strawberry Squash', 'harga' => '9 K', 'img' => '', 'icon' => 'fa-martini-glass-citrus'],
    ['nama' => 'Mango Squash', 'harga' => '9 K', 'img' => '', 'icon' => 'fa-martini-glass-citrus'],
    ['nama' => 'Lemon Squash', 'harga' => '9 K', 'img' => '', 'icon' => 'fa-martini-glass-citrus'],
    ['nama' => 'Es Teh', 'harga' => '4 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Strawberry Tea', 'harga' => '7 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Lychee Tea', 'harga' => '7 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Lemon Tea', 'harga' => '7 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Mango Tea', 'harga' => '7 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Es Coklat', 'harga' => '7 K', 'img' => '', 'icon' => 'fa-mug-hot'],
    ['nama' => 'Es Teh Tarik', 'harga' => '7 K', 'img' => '', 'icon' => 'fa-mug-hot'],
    ['nama' => 'Es Choco Malt', 'harga' => '7 K', 'img' => '', 'icon' => 'fa-mug-hot'],
    ['nama' => 'Es Cappucino', 'harga' => '8 K', 'img' => '', 'icon' => 'fa-mug-hot'],
    ['nama' => 'Es Batu', 'harga' => '1 K', 'img' => '', 'icon' => 'fa-cubes'],
    ['nama' => 'Air Es / Biasa / Hangat', 'harga' => '2 K', 'img' => '', 'icon' => 'fa-droplet'],
    ['nama' => 'Air Mineral Botol', 'harga' => '5 K', 'img' => '', 'icon' => 'fa-bottle-water'],
    ['nama' => 'Es Mango', 'harga' => '5 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Es Lemon', 'harga' => '5 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Es Strawberry', 'harga' => '5 K', 'img' => '', 'icon' => 'fa-glass-water'],
    ['nama' => 'Es Lychee', 'harga' => '5 K', 'img' => '', 'icon' => 'fa-glass-water'],
];

// FUNGSI UNTUK MERENDER HTML CARD
function renderMenuCard($item) {
    echo '<div class="col-md-6 col-lg-4" data-aos="fade-up">';
    echo '<div class="card h-100 menu-card rounded-4 overflow-hidden text-white">';
    
    echo '<div class="menu-img-wrapper position-relative">';
    if (!empty($item['img'])) {
        echo '<img src="'.$item['img'].'" class="w-100 h-100" style="object-fit: cover;" alt="'.$item['nama'].'">';
    } else {
        echo '<i class="fa-solid '.$item['icon'].' fs-1 text-white-50"></i>';
        echo '<span class="position-absolute bottom-0 text-white-50 small mb-2 text-center w-100 px-2">[Foto: '.$item['nama'].']</span>';
    }
    echo '</div>';

    echo '<div class="card-body d-flex flex-column p-4">';
    echo '<h5 class="fw-bold text-warning mb-3">'.$item['nama'].'</h5>';
    echo '<div class="mt-auto d-flex flex-column gap-2 mb-3">';
    
    $namaMenu = addslashes($item['nama']);

    if (isset($item['single'])) {
        $hargaS = (int)preg_replace('/[^0-9]/', '', $item['single']) * 1000;
        $hargaD = (int)preg_replace('/[^0-9]/', '', $item['double']) * 1000;
        $labelS = isset($item['single_label']) ? $item['single_label'] : 'Single (1 Lauk)';
        $labelD = isset($item['double_label']) ? $item['double_label'] : 'Double (2 Lauk)';

        echo '<div class="d-flex justify-content-between align-items-center border-bottom border-secondary pb-2">';
        echo '<span class="text-light opacity-75">'.$labelS.' <br><strong class="text-white">'.$item['single'].'</strong></span>';
        echo '<button class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="tambahKeranjang(\''.$namaMenu.' ('.$labelS.')\', '.$hargaS.')"><i class="fa-solid fa-plus"></i> Tambah</button>';
        echo '</div>';
        
        echo '<div class="d-flex justify-content-between align-items-center pt-1">';
        echo '<span class="text-light opacity-75">'.$labelD.' <br><strong class="text-white">'.$item['double'].'</strong></span>';
        echo '<button class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="tambahKeranjang(\''.$namaMenu.' ('.$labelD.')\', '.$hargaD.')"><i class="fa-solid fa-plus"></i> Tambah</button>';
        echo '</div>';
    } else {
        $hargaAngka = (int)preg_replace('/[^0-9]/', '', $item['harga']) * 1000;
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<span class="text-light opacity-75">Harga <br><strong class="text-white">'.$item['harga'].'</strong></span>';
        echo '<button class="btn btn-sm btn-warning rounded-pill fw-bold text-dark px-3" onclick="tambahKeranjang(\''.$namaMenu.'\', '.$hargaAngka.')"><i class="fa-solid fa-plus"></i> Tambah</button>';
        echo '</div>';
    }
    
    echo '</div></div></div></div>';
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    body {
        background-image: linear-gradient(rgba(15, 15, 15, 0.92), rgba(15, 15, 15, 0.92)), url('assets/images/image_68b9f7.jpg');
        background-size: cover; background-attachment: fixed; background-position: center;
        color: #ffffff; font-family: 'Poppins', sans-serif;
    }
    .menu-card {
        background: rgba(30, 30, 30, 0.6) !important; backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 215, 0, 0.2) !important; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease, border-color 0.3s ease;
    }
    .menu-card:hover { transform: translateY(-5px); border-color: #FFD700 !important; }

    .nav-pills .nav-link {
        color: #ffffff; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50px; padding: 10px 24px; margin: 5px; font-weight: 600; transition: all 0.3s ease;
    }
    .nav-pills .nav-link.active, .nav-pills .nav-link:hover {
        background-color: #990000; color: #FFD700; border-color: #FFD700; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
    }
    .menu-img-wrapper {
        height: 200px; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .modal-content.glass-modal {
        background: rgba(20, 20, 20, 0.95) !important; backdrop-filter: blur(15px); border: 1px solid #FFD700; color: white;
    }
    .form-floating .form-control { background-color: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; }
    .form-floating .form-control:focus { background-color: rgba(255, 255, 255, 0.1); border-color: #FFD700; color: #fff; }
    .form-floating label { color: rgba(255, 255, 255, 0.6); }
    .btn-check:checked + .btn-outline-warning { background-color: #FFD700; color: #990000; border-color: #FFD700; font-weight: bold; }
    .btn-outline-warning { border-color: rgba(255, 215, 0, 0.5); color: #FFD700; }
    .btn-outline-warning:hover { background-color: rgba(255, 215, 0, 0.1); }
</style>

<section class="py-5 mt-4">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="display-4 fw-bold" style="color: #FFD700; text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Menu Numanke</h1>
            <p class="lead text-light opacity-75">Jelajahi berbagai pilihan menu spesial dari dapur kami.</p>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5" id="menu-tab" role="tablist">
            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#geprek" type="button">Geprek Series</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#dewata" type="button">Dewata Series</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#brongot" type="button">Brongot Series</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#rongot" type="button">Rongot Series</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#frozen" type="button">Frozen Series</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#drink" type="button">Drink</button></li>
        </ul>

        <div class="tab-content" id="menu-tabContent">
            <div class="tab-pane fade show active" id="geprek"><div class="row g-4"><?php foreach($menu_geprek as $item) { renderMenuCard($item); } ?></div></div>
            <div class="tab-pane fade" id="dewata"><div class="row g-4"><?php foreach($menu_dewata as $item) { renderMenuCard($item); } ?></div></div>
            <div class="tab-pane fade" id="brongot"><div class="row g-4"><?php foreach($menu_brongot as $item) { renderMenuCard($item); } ?></div></div>
            <div class="tab-pane fade" id="rongot"><div class="row g-4"><?php foreach($menu_rongot as $item) { renderMenuCard($item); } ?></div></div>
            <div class="tab-pane fade" id="frozen"><div class="row g-4"><?php foreach($menu_frozen as $item) { renderMenuCard($item); } ?></div></div>
            <div class="tab-pane fade" id="drink"><div class="row g-4"><?php foreach($menu_drink as $item) { renderMenuCard($item); } ?></div></div>
        </div> 
    </div>
</section>

<!-- MODAL POP-UP CHECKOUT -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content glass-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-warning fw-bold"><i class="fa-solid fa-receipt me-2"></i> Keranjang Pesanan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
            <!-- Daftar Pesanan (Kiri) -->
            <div class="col-md-6 border-end border-secondary">
                <h6 class="text-white opacity-75 mb-3">Rincian Item:</h6>
                <div id="keranjangList" class="mb-3"></div>
                <div id="ringkasanTotal"></div> 
            </div>
            
            <!-- Form Data Diri (Kanan) -->
            <div class="col-md-6">
                <h6 class="text-white opacity-75 mb-3">Informasi Pelanggan:</h6>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control rounded-3" id="nama" placeholder="Nama Lengkap" required>
                    <label for="nama">Nama Lengkap</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="tel" class="form-control rounded-3" id="nomorWa" placeholder="0812xxxxxx" required>
                    <label for="nomorWa">Nomor WhatsApp</label>
                </div>

                <h6 class="text-white opacity-75 mb-2">Tipe Pesanan:</h6>
                <div class="row g-2 mb-3">
                    <div class="col-12"><input type="radio" class="btn-check" name="tipePesanan" id="dineIn" value="Makan di Tempat" checked onchange="toggleAlamat()"><label class="btn btn-outline-warning w-100 rounded-3 text-start" for="dineIn"><i class="fa-solid fa-store me-2"></i> Makan Ditempat</label></div>
                    <div class="col-12"><input type="radio" class="btn-check" name="tipePesanan" id="takeaway" value="Ambil Sendiri" onchange="toggleAlamat()"><label class="btn btn-outline-warning w-100 rounded-3 text-start" for="takeaway"><i class="fa-solid fa-bag-shopping me-2"></i> Bungkus (Ambil)</label></div>
                    <div class="col-12"><input type="radio" class="btn-check" name="tipePesanan" id="delivery" value="Diantar" onchange="toggleAlamat()"><label class="btn btn-outline-warning w-100 rounded-3 text-start" for="delivery"><i class="fa-solid fa-motorcycle me-2"></i> Bungkus (Diantar)</label></div>
                </div>

                <!-- Bagian Pengisian Alamat Canggih -->
                <div class="alamat-box p-3 border border-secondary rounded-3 mb-4" id="boxAlamat" style="display: none; background: rgba(0,0,0,0.3);">
                    <div class="mb-3 pb-2 border-bottom border-secondary">
                        <small class="text-white-50"><i class="fa-solid fa-shop me-1"></i> Dikirim dari:<br>Jl. Pete Sel. No.18, Sekaran, Kec. Gn. Pati, Kota Semarang, Jawa Tengah 50229</small>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="text-warning small mb-0">Metode Alamat Pengiriman:</h6>
                        <button type="button" class="btn btn-sm btn-info fw-bold px-3" onclick="pilihGPS()" id="btnGPS"><i class="fa-solid fa-location-crosshairs"></i> Gunakan GPS</button>
                    </div>

                    <!-- Input Alamat Teks / Manual -->
                    <div class="form-floating mb-2">
                        <textarea class="form-control rounded-3" id="alamat" placeholder="Ketik alamat atau gunakan GPS..." style="height: 90px"></textarea>
                        <label for="alamat">Ketik Detail Alamat / Patokan</label>
                    </div>

                    <!-- Kotak Notifikasi Ongkir / Jarak -->
                    <div id="infoOngkir" class="text-info small mb-3 text-center p-2 rounded bg-dark border border-info" style="display:none;"></div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="button" class="btn btn-success w-100 fw-bold" onclick="setujuiLokasi()" id="btnSetuju"><i class="fa-solid fa-check"></i> Cek Jarak & Setujui</button>
                        <button type="button" class="btn btn-danger w-100 fw-bold" onclick="resetLokasi()" id="btnReset" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Ganti Alamat (Reset)</button>
                    </div>
                </div>

                <h6 class="text-white opacity-75 mb-2">Metode Pembayaran:</h6>
                <div class="row g-2">
                    <div class="col-6"><input type="radio" class="btn-check" name="metodeBayar" id="cash" value="Cash" checked><label class="btn btn-outline-warning w-100 rounded-3" for="cash">Tunai (Cash)</label></div>
                    <div class="col-6"><input type="radio" class="btn-check" name="metodeBayar" id="qris" value="QRIS"><label class="btn btn-outline-warning w-100 rounded-3" for="qris">QRIS</label></div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer border-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-warning fw-bold text-danger" onclick="kirimKeWa()" id="btnBayarModal">Kirim ke WhatsApp <i class="fa-brands fa-whatsapp ms-1"></i></button>
      </div>
    </div>
  </div>
</div>

<button class="btn position-fixed bottom-0 end-0 m-4 p-3 rounded-pill shadow-lg" data-bs-toggle="modal" data-bs-target="#checkoutModal" style="z-index: 1000; display: none; background-color: #990000; border: 2px solid #FFD700; transition: all 0.3s ease;" id="btnKeranjangFloating">
    <i class="fa-solid fa-basket-shopping text-warning me-2 fs-5"></i> 
    <span class="fw-bold text-white fs-6">Pesanan (<span id="cartCountFloat" class="text-warning">0</span>)</span>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let keranjang = JSON.parse(localStorage.getItem('numanke_cart')) || [];
    
    // Titik Pusat Restoran Numanke
    const RESTO_LAT = -7.05051; 
    const RESTO_LNG = 110.39523;
    
    let ongkirFinal = 0;
    let ongkirTemp = 0;
    let jarakPelanggan = 0;
    let linkGps = "";
    let isLokasiSetuju = false;
    let isGpsUsed = false;

    // --- KERANJANG BELANJA ---
    function tambahKeranjang(nama, harga) {
        let index = keranjang.findIndex(item => item.nama === nama);
        if (index !== -1) { keranjang[index].qty += 1; } 
        else { keranjang.push({ nama: nama, harga: harga, qty: 1 }); }
        localStorage.setItem('numanke_cart', JSON.stringify(keranjang));
        updateCartBadge(); renderModalCart();
        alert("✅ " + nama + " ditambahkan ke pesanan!");
    }

    function kurangiItem(index) {
        keranjang[index].qty -= 1;
        if(keranjang[index].qty <= 0) { keranjang.splice(index, 1); }
        localStorage.setItem('numanke_cart', JSON.stringify(keranjang));
        updateCartBadge(); renderModalCart();
    }

    function updateCartBadge() {
        let countDesktop = document.getElementById('navCartCountDesktop');
        let countMobile = document.getElementById('navCartCountMobile');
        let btnFloat = document.getElementById('btnKeranjangFloating');
        let countFloat = document.getElementById('cartCountFloat');
        let totalQty = keranjang.reduce((sum, item) => sum + item.qty, 0);
        
        if(totalQty > 0) {
            if(countDesktop) { countDesktop.style.display = 'inline-block'; countDesktop.innerText = totalQty; }
            if(countMobile) { countMobile.style.display = 'inline-block'; countMobile.innerText = totalQty; }
            if(btnFloat) { btnFloat.style.display = 'block'; countFloat.innerText = totalQty; }
        } else {
            if(countDesktop) countDesktop.style.display = 'none';
            if(countMobile) countMobile.style.display = 'none';
            if(btnFloat) btnFloat.style.display = 'none';
        }
    }

    function renderModalCart() {
        let list = document.getElementById('keranjangList');
        let ringkasan = document.getElementById('ringkasanTotal');
        let btnBayar = document.getElementById('btnBayarModal');
        let isDiantar = document.getElementById('delivery').checked;
        
        if (keranjang.length === 0) {
            list.innerHTML = '<p class="text-white-50 fst-italic">Keranjang kosong. Yuk tambah menu!</p>';
            ringkasan.innerHTML = '';
            btnBayar.disabled = true;
            return;
        }

        btnBayar.disabled = false;
        let html = '';
        let subtotal = 0;

        keranjang.forEach((item, index) => {
            let totalItem = item.harga * item.qty;
            subtotal += totalItem;
            html += `<div class="d-flex justify-content-between mb-3 align-items-center">
                        <div><h6 class="mb-1 text-white" style="font-size: 0.9rem;">${item.nama}</h6>
                        <span class="badge bg-secondary text-light" style="cursor: pointer;" onclick="kurangiItem(${index})"><i class="fa-solid fa-minus"></i> Kurangi</span>
                        <small class="text-white-50 ms-2">${item.qty} x ${item.harga/1000}K</small></div>
                        <span class="text-warning fw-semibold">Rp ${totalItem.toLocaleString('id-ID')}</span>
                     </div>`;
        });
        list.innerHTML = html;

        let htmlTotal = `<div class="d-flex justify-content-between mb-2"><span class="text-white-50">Subtotal</span><span class="text-white">Rp ${subtotal.toLocaleString('id-ID')}</span></div>`;
        
        if(isDiantar) {
            if(isLokasiSetuju) {
                htmlTotal += `<div class="d-flex justify-content-between mb-3"><span class="text-white-50">Ongkos Kirim (${jarakPelanggan.toFixed(1)} km)</span><span class="text-warning">Rp ${ongkirFinal.toLocaleString('id-ID')}</span></div>`;
            } else {
                htmlTotal += `<div class="d-flex justify-content-between mb-3"><span class="text-white-50">Ongkos Kirim</span><span class="text-warning fst-italic">Pilih Lokasi Dulu</span></div>`;
            }
        }

        let totalSemua = subtotal + (isDiantar && isLokasiSetuju ? ongkirFinal : 0);
        htmlTotal += `<div class="d-flex justify-content-between align-items-center bg-danger bg-opacity-25 p-3 rounded-3 border border-danger mt-3">
                        <span class="fw-bold text-white fs-6">Total Bayar</span><span class="fw-bold text-warning fs-5">Rp ${totalSemua.toLocaleString('id-ID')}</span>
                      </div>`;
        ringkasan.innerHTML = htmlTotal;
    }

    // --- FUNGSI LOKASI & ONGKIR ---
    function toggleAlamat() {
        const isDelivery = document.getElementById('delivery').checked;
        const boxAlamat = document.getElementById('boxAlamat');
        if(isDelivery) { boxAlamat.style.display = 'block'; } 
        else { boxAlamat.style.display = 'none'; resetLokasi(); }
    }

    function hitungJarak(lat1, lon1, lat2, lon2) {
        const R = 6371; 
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon/2) * Math.sin(dLon/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c; 
    }

    function kalkulasiOngkir(jarak) {
        if (jarak <= 5) return 5000;
        let lebihKm = jarak - 5;
        let tambahOngkir = Math.ceil(lebihKm / 0.2) * 500;
        return 5000 + tambahOngkir;
    }

    // Reset status GPS jika pengguna mengetik di kolom alamat
    document.getElementById('alamat').addEventListener('input', function() {
        isGpsUsed = false;
        document.getElementById('btnGPS').innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> Gunakan GPS';
    });

    function pilihGPS() {
        const btn = document.getElementById('btnGPS');
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mencari...';

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                linkGps = `https://www.google.com/maps?q=${userLat},${userLng}`;
                jarakPelanggan = hitungJarak(RESTO_LAT, RESTO_LNG, userLat, userLng);
                ongkirTemp = kalkulasiOngkir(jarakPelanggan);
                isGpsUsed = true;
                
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${userLat}&lon=${userLng}`)
                .then(res => res.json())
                .then(data => { if(data.display_name) document.getElementById('alamat').value = data.display_name; })
                .catch(e => console.log("Gagal reverse geocoding"));

                btn.innerHTML = '<i class="fa-solid fa-check text-success"></i> Lokasi Tersimpan';
                alert("Koordinat GPS berhasil dilacak! Klik tombol hijau 'Cek Jarak & Setujui' di bawah untuk menghitung ongkir.");
            }, function(error) {
                alert('Gagal melacak. Pastikan GPS aktif atau izinkan akses lokasi.');
                btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> Gunakan GPS';
            });
        } else { alert('Browser tidak mendukung GPS.'); }
    }

    function finalizeSetuju() {
        isLokasiSetuju = true;
        document.getElementById('btnGPS').disabled = true;
        document.getElementById('alamat').readOnly = true;
        
        document.getElementById('btnSetuju').style.display = 'none';
        document.getElementById('btnReset').style.display = 'block';
        document.getElementById('btnSetuju').disabled = false;
        
        renderModalCart();
    }

    function setujuiLokasi() {
        let alamatTeks = document.getElementById('alamat').value.trim();
        if(alamatTeks === "") { alert("Harap isi alamat Anda terlebih dahulu!"); return; }

        let btnSetuju = document.getElementById('btnSetuju');
        let info = document.getElementById('infoOngkir');

        // Jika user menggunakan klik tombol GPS
        if (isGpsUsed) {
            ongkirFinal = ongkirTemp;
            info.innerHTML = `📍 Jarak ke Resto: <b>${jarakPelanggan.toFixed(2)} km</b><br>Ongkos Kirim: <b>Rp ${ongkirFinal.toLocaleString('id-ID')}</b>`;
            info.style.display = 'block';
            info.classList.replace('border-warning', 'border-info');
            info.classList.replace('text-warning', 'text-info');
            finalizeSetuju();
            return;
        }

        // Jika user mengetik manual (Cari lewat satelit)
        btnSetuju.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menghitung Jarak...';
        btnSetuju.disabled = true;

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(alamatTeks)}&limit=1`)
        .then(res => res.json())
        .then(data => {
            if(data && data.length > 0) {
                let lat = parseFloat(data[0].lat);
                let lon = parseFloat(data[0].lon);
                jarakPelanggan = hitungJarak(RESTO_LAT, RESTO_LNG, lat, lon);
                ongkirFinal = kalkulasiOngkir(jarakPelanggan);
                linkGps = `https://www.google.com/maps?q=${lat},${lon}`;
                
                info.innerHTML = `📍 Jarak ke Resto: <b>${jarakPelanggan.toFixed(2)} km</b><br>Ongkos Kirim: <b>Rp ${ongkirFinal.toLocaleString('id-ID')}</b>`;
                info.style.display = 'block';
                info.classList.replace('border-warning', 'border-info');
                info.classList.replace('text-warning', 'text-info');
                finalizeSetuju();
            } else {
                // Fallback Cerdas (Jika alamat gagal ditemukan di peta)
                let inputJarak = prompt("Satelit kesulitan menemukan rute jalan ke alamat ini. Mohon masukkan PERKIRAAN JARAK (dalam Kilometer) dari lokasi Numanke ke lokasi Anda:\n\n(Ketik angka saja, contoh: 2.5 atau 3)", "2");
                
                if (inputJarak !== null && inputJarak.trim() !== "" && !isNaN(inputJarak)) {
                    jarakPelanggan = parseFloat(inputJarak);
                    ongkirFinal = kalkulasiOngkir(jarakPelanggan);
                    linkGps = "";
                    info.innerHTML = `📍 Jarak Perkiraan: <b>${jarakPelanggan.toFixed(2)} km</b><br>Ongkos Kirim: <b>Rp ${ongkirFinal.toLocaleString('id-ID')}</b>`;
                    info.style.display = 'block';
                    info.classList.replace('border-info', 'border-warning');
                    info.classList.replace('text-info', 'text-warning');
                    finalizeSetuju();
                } else {
                    btnSetuju.innerHTML = '<i class="fa-solid fa-check"></i> Cek Jarak & Setujui';
                    btnSetuju.disabled = false;
                    alert("Gagal memproses perhitungan. Mohon ulangi kembali.");
                }
            }
        })
        .catch(err => {
            btnSetuju.innerHTML = '<i class="fa-solid fa-check"></i> Cek Jarak & Setujui';
            btnSetuju.disabled = false;
            alert("Terjadi kesalahan jaringan saat mengecek lokasi.");
        });
    }

    function resetLokasi() {
        isLokasiSetuju = false; ongkirFinal = 0; ongkirTemp = 0; linkGps = ""; jarakPelanggan = 0; isGpsUsed = false;
        
        document.getElementById('btnGPS').disabled = false;
        document.getElementById('btnGPS').innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> Gunakan GPS';
        document.getElementById('alamat').readOnly = false;
        
        document.getElementById('infoOngkir').style.display = 'none';
        
        let btnSetuju = document.getElementById('btnSetuju');
        btnSetuju.style.display = 'block';
        btnSetuju.innerHTML = '<i class="fa-solid fa-check"></i> Cek Jarak & Setujui';
        document.getElementById('btnReset').style.display = 'none';
        
        renderModalCart();
    }

    // --- FUNGSI KIRIM KE WA ---
    function kirimKeWa() {
        if(keranjang.length === 0) return;

        let nama = document.getElementById('nama').value;
        let nomor = document.getElementById('nomorWa').value;
        let isDiantar = document.getElementById('delivery').checked;
        
        if(!nama || !nomor) { alert('Lengkapi Nama dan Nomor WhatsApp terlebih dahulu!'); return; }

        let tipe = document.querySelector('input[name="tipePesanan"]:checked').value;
        let bayar = document.querySelector('input[name="metodeBayar"]:checked').value;
        let alamat = document.getElementById('alamat').value;

        if(isDiantar && !isLokasiSetuju) {
            alert('Silakan Cek Jarak/Alamat dan klik tombol hijau "Setujui" terlebih dahulu untuk memunculkan ongkir!');
            return;
        }

        let textWa = `Halo Admin Numanke! 🍗🔥%0A%0ASaya ingin memesan dengan rincian berikut:%0A%0A`;
        textWa += `*DATA PEMESAN:*%0A- Nama: ${nama}%0A- No. WA: ${nomor}%0A- Tipe: ${tipe}%0A`;
        
        if(isDiantar) {
            textWa += `- Alamat: ${alamat}%0A`;
            if(linkGps !== "") textWa += `- Link GPS: ${linkGps}%0A`;
            if(jarakPelanggan > 0) textWa += `- Jarak: ${jarakPelanggan.toFixed(1)} km%0A`;
        }
        textWa += `- Pembayaran: ${bayar}%0A%0A*RINCIAN PESANAN:*%0A`;
        
        let subtotal = 0;
        keranjang.forEach(item => {
            let totalItem = item.harga * item.qty;
            subtotal += totalItem;
            textWa += `- ${item.qty}x ${item.nama} (Rp ${totalItem.toLocaleString('id-ID')})%0A`;
        });
        
        if(isDiantar && isLokasiSetuju) {
            textWa += `- Ongkos Kirim: Rp ${ongkirFinal.toLocaleString('id-ID')}%0A`;
        } 

        let totalSemua = subtotal + (isDiantar && isLokasiSetuju ? ongkirFinal : 0);
        textWa += `%0A*TOTAL BAYAR: Rp ${totalSemua.toLocaleString('id-ID')}*%0A%0AMohon diproses ya min!`;

        let nomorAdmin = "6281234567890"; // GANTI DENGAN NOMOR WA NUMANKE
        
        localStorage.removeItem('numanke_cart');
        window.open(`https://wa.me/${nomorAdmin}?text=${textWa}`, '_blank');
        location.reload(); 
    }

    document.addEventListener("DOMContentLoaded", () => {
        updateCartBadge();
        const checkoutModal = document.getElementById('checkoutModal')
        checkoutModal.addEventListener('show.bs.modal', event => { renderModalCart(); });
    });
</script>

<?php require_once 'includes/footer.php'; ?>