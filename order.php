<?php 
require_once 'includes/header.php'; 

// =========================================================================
// DATA MENU NUMANKE
// =========================================================================

$menu_geprek = [
 ['nama' => 'Nasi Ayam Geprek Ori', 'single' => 'Rp. 13.000', 'double' => 'Rp. 18.000', 'img' => 'assets/images/menu/1794255715_NasiAyamGeprekKejuSingle.png', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Ayam Geprek Keju', 'single' => 'Rp. 15.000', 'double' => 'Rp. 20.000', 'img' => 'assets/images/menu/1794255367_NasiAyamGeprekKejuDouble.png', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Ayam Geprek Moza', 'single' => 'Rp. 17.000', 'double' => 'Rp. 22.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Jamur Geprek Ori', 'single' => 'Rp. 10.000', 'double' => 'Rp. 14.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Jamur Geprek Keju', 'single' => 'Rp. 12.000', 'double' => 'Rp. 16.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Jamur Geprek Moza', 'single' => 'Rp. 14.000', 'double' => 'Rp. 18.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Telur Geprek Ori', 'single' => 'Rp. 11.000', 'double' => 'Rp. 16.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Telur Geprek Keju', 'single' => 'Rp. 13.000', 'double' => 'Rp. 18.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Telur Geprek Moza', 'single' => 'Rp. 15.000', 'double' => 'Rp. 20.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Ayam+Jamur Geprek Ori', 'single' => 'Rp. 13.000', 'double' => 'Rp. 18.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Ayam+Jamur Geprek Keju', 'single' => 'Rp. 15.000', 'double' => 'Rp. 20.000', 'img' => '', 'icon' => 'fa-utensils'],
 ['nama' => 'Nasi Ayam+Jamur Geprek Moza', 'single' => 'Rp. 17.000', 'double' => 'Rp. 22.000', 'img' => '', 'icon' => 'fa-utensils'],
];

$menu_dewata = [
 ['nama' => 'Nasi Ayam Geprek Dewata Ori', 'single' => 'Rp. 15.000', 'double' => 'Rp. 19.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Ayam Geprek Dewata Keju', 'single' => 'Rp. 17.000', 'double' => 'Rp. 21.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Ayam Geprek Dewata Moza', 'single' => 'Rp. 19.000', 'double' => 'Rp. 23.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Jamur Geprek Dewata Ori', 'single' => 'Rp. 12.000', 'double' => 'Rp. 16.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Jamur Geprek Dewata Keju', 'single' => 'Rp. 14.000', 'double' => 'Rp. 18.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Jamur Geprek Dewata Moza', 'single' => 'Rp. 16.000', 'double' => 'Rp. 20.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Ayam Brongot Dewata Ori', 'single' => 'Rp. 17.000', 'double' => 'Rp. 23.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Ayam Brongot Dewata Keju', 'single' => 'Rp. 19.000', 'double' => 'Rp. 24.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Ayam Brongot Dewata Moza', 'single' => 'Rp. 21.000', 'double' => 'Rp. 26.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Jamur Brongot Dewata Ori', 'single' => 'Rp. 14.000', 'double' => 'Rp. 18.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Jamur Brongot Dewata Keju', 'single' => 'Rp. 16.000', 'double' => 'Rp. 20.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Jamur Brongot Dewata Moza', 'single' => 'Rp. 18.000', 'double' => 'Rp. 22.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Mix Geprek Dewata Ori', 'single' => 'Rp. 14.000', 'double' => 'Rp. 19.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Mix Geprek Dewata Keju', 'single' => 'Rp. 15.000', 'double' => 'Rp. 20.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Mix Geprek Dewata Moza', 'single' => 'Rp. 17.000', 'double' => 'Rp. 23.000', 'img' => '', 'icon' => 'fa-leaf'],
 ['nama' => 'Nasi Mix Brongot Dewata Ori', 'single' => 'Rp. 16.000', 'double' => 'Rp. 21.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Mix Brongot Dewata Keju', 'single' => 'Rp. 18.000', 'double' => 'Rp. 23.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Mix Brongot Dewata Moza', 'single' => 'Rp. 20.000', 'double' => 'Rp. 25.000', 'img' => '', 'icon' => 'fa-fire'],
];

$menu_brongot = [
 ['nama' => 'Nasi Ayam Brongot Ori', 'single' => 'Rp. 15.000', 'double' => 'Rp. 20.000', 'img' => 'assets/images/fotoslide1.png', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Ayam Brongot Keju', 'single' => 'Rp. 17.000', 'double' => 'Rp. 22.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Ayam Brongot Moza', 'single' => 'Rp. 19.000', 'double' => 'Rp. 24.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Jamur Brongot Ori', 'single' => 'Rp. 12.000', 'double' => 'Rp. 17.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Jamur Brongot Keju', 'single' => 'Rp. 14.000', 'double' => 'Rp. 19.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Jamur Brongot Moza', 'single' => 'Rp. 16.000', 'double' => 'Rp. 21.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Telur Brongot Ori', 'single' => 'Rp. 11.000', 'double' => 'Rp. 17.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Telur Brongot Keju', 'single' => 'Rp. 13.000', 'double' => 'Rp. 19.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Telur Brongot Moza', 'single' => 'Rp. 15.000', 'double' => 'Rp. 21.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Ayam+Jamur Brongot Ori', 'single' => 'Rp. 15.000', 'double' => 'Rp. 20.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Ayam+Jamur Brongot Keju', 'single' => 'Rp. 17.000', 'double' => 'Rp. 22.000', 'img' => '', 'icon' => 'fa-fire'],
 ['nama' => 'Nasi Ayam+Jamur Brongot Moza', 'single' => 'Rp. 19.000', 'double' => 'Rp. 24.000', 'img' => '', 'icon' => 'fa-fire'],
];

$menu_rongot = [
 ['nama' => 'Rongot Freeze Coklat', 'harga' => 'Rp. 11.000', 'img' => '', 'icon' => 'fa-ice-cream'],
 ['nama' => 'Rongot Freeze Keju', 'harga' => 'Rp. 12.000', 'img' => '', 'icon' => 'fa-ice-cream'],
 ['nama' => 'Rongot Freeze Coklat Keju', 'harga' => 'Rp. 14.000', 'img' => '', 'icon' => 'fa-ice-cream'],
 ['nama' => 'Rongot Freeze Coklat Keju Moza', 'harga' => 'Rp. 20.000', 'img' => '', 'icon' => 'fa-ice-cream'],
 ['nama' => 'Rongot Freeze Chocomalt', 'harga' => 'Rp. 13.000', 'img' => '', 'icon' => 'fa-ice-cream'],
 ['nama' => 'Rongot Freeze Chocomalt Keju', 'harga' => 'Rp. 16.000', 'img' => '', 'icon' => 'fa-ice-cream'],
 ['nama' => 'Rongot Freeze Chocomalt Moza', 'harga' => 'Rp. 18.000', 'img' => '', 'icon' => 'fa-ice-cream'],
 ['nama' => 'Rongot Freeze Chocomalt Keju Moza', 'harga' => 'Rp. 21.000', 'img' => '', 'icon' => 'fa-ice-cream'],
 ['nama' => 'Rongot Coklat', 'harga' => 'Rp. 8.000', 'img' => '', 'icon' => 'fa-bread-slice'],
 ['nama' => 'Rongot Keju', 'harga' => 'Rp. 9.000', 'img' => '', 'icon' => 'fa-bread-slice'],
 ['nama' => 'Rongot Coklat Keju', 'harga' => 'Rp. 11.000', 'img' => '', 'icon' => 'fa-bread-slice'],
 ['nama' => 'Rongot Coklat Keju Moza', 'harga' => 'Rp. 16.000', 'img' => '', 'icon' => 'fa-bread-slice'],
];

$menu_frozen = [
 ['nama' => 'Ayam Brongot Frozen', 'single' => 'Rp. 29.000', 'single_label' => '1/4 Kg', 'double' => 'Rp. 49.000', 'double_label' => '1/2 Kg', 'img' => '', 'icon' => 'fa-snowflake'],
 ['nama' => 'Jamur Brongot Frozen', 'single' => 'Rp. 24.000', 'single_label' => '1/4 Kg', 'double' => 'Rp. 42.000', 'double_label' => '1/2 Kg', 'img' => '', 'icon' => 'fa-snowflake'],
 ['nama' => 'Bakso Brongot Frozen', 'single' => 'Rp. 27.000', 'single_label' => '15 Pcs', 'double' => 'Rp. 37.000', 'double_label' => '25 Pcs', 'img' => '', 'icon' => 'fa-snowflake'],
 ['nama' => 'Sambal Numan (Bawang/Dewata)', 'harga' => 'Rp. 33.000', 'img' => '', 'icon' => 'fa-pepper-hot'],
];

$menu_drink = [
 ['nama' => 'Lyche Float', 'harga' => 'Rp. 12.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Strawberry Float', 'harga' => 'Rp. 12.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Mango Float', 'harga' => 'Rp. 12.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Lemon Float', 'harga' => 'Rp. 13.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Choco Float', 'harga' => 'Rp. 13.000', 'img' => '', 'icon' => 'fa-mug-hot'],
 ['nama' => 'Teh Tarik Float', 'harga' => 'Rp. 13.000', 'img' => '', 'icon' => 'fa-mug-hot'],
 ['nama' => 'Choco Malt Float', 'harga' => 'Rp. 13.000', 'img' => '', 'icon' => 'fa-mug-hot'],
 ['nama' => 'Cappucino Float', 'harga' => 'Rp. 14.000', 'img' => '', 'icon' => 'fa-mug-hot'],
 ['nama' => 'Lyche Squash', 'harga' => 'Rp. 9.000', 'img' => '', 'icon' => 'fa-martini-glass-citrus'],
 ['nama' => 'Strawberry Squash', 'harga' => 'Rp. 9.000', 'img' => '', 'icon' => 'fa-martini-glass-citrus'],
 ['nama' => 'Mango Squash', 'harga' => 'Rp. 9.000', 'img' => '', 'icon' => 'fa-martini-glass-citrus'],
 ['nama' => 'Lemon Squash', 'harga' => 'Rp. 9.000', 'img' => '', 'icon' => 'fa-martini-glass-citrus'],
 ['nama' => 'Es Teh', 'harga' => 'Rp. 4.000', 'img' => 'assets/images/fotoslide3.JPG', 'icon' => 'fa-glass-water'],
 ['nama' => 'Strawberry Tea', 'harga' => 'Rp. 7.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Lychee Tea', 'harga' => 'Rp. 7.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Lemon Tea', 'harga' => 'Rp. 7.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Mango Tea', 'harga' => 'Rp. 7.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Es Coklat', 'harga' => 'Rp. 7.000', 'img' => '', 'icon' => 'fa-mug-hot'],
 ['nama' => 'Es Teh Tarik', 'harga' => 'Rp. 7.000', 'img' => '', 'icon' => 'fa-mug-hot'],
 ['nama' => 'Es Choco Malt', 'harga' => 'Rp. 7.000', 'img' => '', 'icon' => 'fa-mug-hot'],
 ['nama' => 'Es Cappucino', 'harga' => 'Rp. 8.000', 'img' => '', 'icon' => 'fa-mug-hot'],
 ['nama' => 'Es Batu', 'harga' => 'Rp. 1.000', 'img' => '', 'icon' => 'fa-cubes'],
 ['nama' => 'Air Es / Biasa / Hangat', 'harga' => 'Rp. 2.000', 'img' => '', 'icon' => 'fa-droplet'],
 ['nama' => 'Air Mineral Botol', 'harga' => 'Rp. 5.000', 'img' => '', 'icon' => 'fa-bottle-water'],
 ['nama' => 'Es Mango', 'harga' => 'Rp. 5.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Es Lemon', 'harga' => 'Rp. 5.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Es Strawberry', 'harga' => 'Rp. 5.000', 'img' => '', 'icon' => 'fa-glass-water'],
 ['nama' => 'Es Lychee', 'harga' => 'Rp. 5.000', 'img' => '', 'icon' => 'fa-glass-water'],
];

// FUNGSI RENDER KARTU MENU – SIMPLE & ELEGANT
function renderMenuCard($item, $delay = 50) {
    $isSpicy = ($item['icon'] === 'fa-fire');
    $isGeprek = ($item['icon'] === 'fa-utensils');

    echo '<div class="col-6 col-md-4 col-lg-3 menu-item-card" data-aos="fade-up" data-aos-delay="'.$delay.'">';
    echo '<div class="card-menu-elegant">';
    
    // Image box with fallback icon
    echo '<div class="card-menu-img-box">';
    if (!empty($item['img'])) {
        echo '<img src="'.$item['img'].'" alt="'.$item['nama'].'" onerror="this.style.display=\'none\'">';
    }
    echo '<i class="fa-solid '.$item['icon'].' position-absolute" style="font-size:2.2rem; color:var(--color-dark); opacity:0.1; z-index:0;"></i>';
    echo '</div>';

    // Body content
    echo '<div class="card-menu-body p-3">';
    echo '<h4 class="card-menu-title mb-1" style="font-size: 0.95rem; line-height: 1.3; min-height: 2.5em;">'.$item['nama'].'</h4>';
    
    // Badge status
    if ($isSpicy) {
        echo '<div class="mb-2"><span class="spice-level-indicator">🌶️ Pedas</span></div>';
    } elseif ($isGeprek) {
        echo '<div class="mb-2"><span class="spice-level-indicator" style="background:#f0fdf4; color:#166534; border-color:rgba(22,101,52,0.2);">🍗 Geprek</span></div>';
    } else {
        echo '<div class="mb-2" style="height: 22px;"></div>';
    }

    echo '<div class="mt-auto d-flex flex-column gap-1">';
    
    $namaMenu = htmlspecialchars($item['nama'], ENT_QUOTES, 'UTF-8');

    if (isset($item['single'])) {
        $hargaS = (int)preg_replace('/[^0-9]/', '', $item['single']);
        $hargaD = (int)preg_replace('/[^0-9]/', '', $item['double']);
        $labelS = isset($item['single_label']) ? $item['single_label'] : 'Single';
        $labelD = isset($item['double_label']) ? $item['double_label'] : 'Double';

        echo '<div class="portion-row">';
        echo '<div><div class="portion-name">'.$labelS.'</div><div class="portion-cost">'.$item['single'].'</div></div>';
        echo '<button class="btn-add-item" onclick="tambahKeranjang(event, \''.$namaMenu.' ('.$labelS.')\', '.$hargaS.')"><i class="fa-solid fa-plus"></i></button>';
        echo '</div>';
        
        echo '<div class="portion-row">';
        echo '<div><div class="portion-name">'.$labelD.'</div><div class="portion-cost">'.$item['double'].'</div></div>';
        echo '<button class="btn-add-item" onclick="tambahKeranjang(event, \''.$namaMenu.' ('.$labelD.')\', '.$hargaD.')"><i class="fa-solid fa-plus"></i></button>';
        echo '</div>';
    } else {
        $hargaAngka = (int)preg_replace('/[^0-9]/', '', $item['harga']);
        echo '<div class="portion-row">';
        echo '<div><div class="portion-name">Harga Porsi</div><div class="portion-cost">'.$item['harga'].'</div></div>';
        echo '<button class="btn-add-item" onclick="tambahKeranjang(event, \''.$namaMenu.'\', '.$hargaAngka.')"><i class="fa-solid fa-plus"></i></button>';
        echo '</div>';
    }
    
    echo '</div></div></div></div>';
}
?>

<!-- ==================== ORDER HERO BANNER ==================== -->
<section class="py-5" style="background: linear-gradient(135deg, var(--color-red) 0%, var(--color-red-dark) 100%); color: var(--color-white); border-bottom: 3px solid var(--color-gold);">
    <div class="container py-3">
        <div class="row align-items-center g-4">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge mb-2" style="background: rgba(255,255,255,0.2); color: var(--color-white); font-weight: 700; padding: 6px 14px; border-radius: 20px;">
                    ✨ MENU & PEMESANAN ONLINE
                </span>
                <h1 class="font-display" style="font-size: clamp(2.4rem, 5vw, 3.8rem); font-weight: 800; line-height: 1.15; margin-bottom: 0.75rem;">
                    Daftar Menu Numanke<span style="color: var(--color-gold);">.</span>
                </h1>
                <p style="color: rgba(255,255,255,0.85); font-size: 1.05rem; line-height: 1.6; max-width: 520px; margin-bottom: 0;">
                    Pilih menu favorit Anda. Dibuat hangat dan segar saat pesanan diterima. Tersedia porsi Single & Double lauk.
                </p>
            </div>
            
            <div class="col-lg-5" data-aos="fade-left">
                <!-- Search Bar -->
                <div class="bg-white p-2 rounded-pill shadow d-flex align-items-center">
                    <i class="fa-solid fa-magnifying-glass ms-3 text-muted"></i>
                    <input type="text" id="searchInput" class="form-control border-0 bg-transparent shadow-none px-3" placeholder="Cari ayam, sambal, minuman..." onkeyup="cariMenu()" style="font-weight: 600; font-size: 0.95rem;">
                </div>
                <div id="searchResultText" class="mt-2 text-white-50 small ps-3" style="display: none;"></div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CATEGORY FILTER TABS ==================== -->
<section class="py-4 bg-white border-bottom sticky-top" style="top: 76px; z-index: 1020; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
    <div class="container">
        <div class="category-filter-bar nav flex-nowrap" id="menu-tab" role="tablist">
            <button class="category-pill-btn active" data-bs-toggle="pill" data-bs-target="#geprek" type="button" role="tab">
                <i class="fa-solid fa-utensils text-danger"></i> Geprek Spesial
            </button>
            <button class="category-pill-btn" data-bs-toggle="pill" data-bs-target="#brongot" type="button" role="tab">
                <i class="fa-solid fa-fire text-danger"></i> Ayam Brongot
            </button>
            <button class="category-pill-btn" data-bs-toggle="pill" data-bs-target="#dewata" type="button" role="tab">
                <i class="fa-solid fa-leaf text-success"></i> Dewata Series
            </button>
            <button class="category-pill-btn" data-bs-toggle="pill" data-bs-target="#rongot" type="button" role="tab">
                <i class="fa-solid fa-ice-cream text-warning"></i> Rongot Freeze
            </button>
            <button class="category-pill-btn" data-bs-toggle="pill" data-bs-target="#frozen" type="button" role="tab">
                <i class="fa-solid fa-snowflake text-info"></i> Frozen & Sambal
            </button>
            <button class="category-pill-btn" data-bs-toggle="pill" data-bs-target="#drink" type="button" role="tab">
                <i class="fa-solid fa-glass-water text-primary"></i> Minuman Segar
            </button>
        </div>
    </div>
</section>

<!-- ==================== MENU GRID ITEMS ==================== -->
<section class="section-wrapper-bg">
    <div class="container">
        <div class="section-framed-card">
            <div class="tab-content" id="menu-tabContent">
                <div class="tab-pane fade show active" id="geprek">
                    <div class="mb-4">
                        <h3 class="font-display fs-3 text-dark mb-1">Ayam & Jamur Geprek</h3>
                        <p class="text-muted small">Crispy gurih berpadu dengan ulekan cabai rawit pedas mantap.</p>
                    </div>
                    <div class="row g-3 g-md-4">
                        <?php $d=50; foreach($menu_geprek as $item) { renderMenuCard($item, $d); $d=($d>=200)?50:$d+50; } ?>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="brongot">
                    <div class="mb-4">
                        <h3 class="font-display fs-3 text-dark mb-1">Ayam Brongot Spesial</h3>
                        <p class="text-muted small">Dimarinasi 12 jam, dibakar arang dengan bumbu manis pedas gurih karamel.</p>
                    </div>
                    <div class="row g-3 g-md-4">
                        <?php $d=50; foreach($menu_brongot as $item) { renderMenuCard($item, $d); $d=($d>=200)?50:$d+50; } ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="dewata">
                    <div class="mb-4">
                        <h3 class="font-display fs-3 text-dark mb-1">Dewata Series</h3>
                        <p class="text-muted small">Khas rempah Bali wangi serai daun jeruk yang menggugah selera.</p>
                    </div>
                    <div class="row g-3 g-md-4">
                        <?php $d=50; foreach($menu_dewata as $item) { renderMenuCard($item, $d); $d=($d>=200)?50:$d+50; } ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="rongot">
                    <div class="mb-4">
                        <h3 class="font-display fs-3 text-dark mb-1">Rongot Freeze & Snack</h3>
                        <p class="text-muted small">Roti panggang aneka topping manis lumer, penyejuk nikmat sehabis pedas.</p>
                    </div>
                    <div class="row g-3 g-md-4">
                        <?php $d=50; foreach($menu_rongot as $item) { renderMenuCard($item, $d); $d=($d>=200)?50:$d+50; } ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="frozen">
                    <div class="mb-4">
                        <h3 class="font-display fs-3 text-dark mb-1">Frozen Food & Sambal Botol</h3>
                        <p class="text-muted small">Siap masak praktis di rumah kapan saja Anda mau.</p>
                    </div>
                    <div class="row g-3 g-md-4">
                        <?php $d=50; foreach($menu_frozen as $item) { renderMenuCard($item, $d); $d=($d>=200)?50:$d+50; } ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="drink">
                    <div class="mb-4">
                        <h3 class="font-display fs-3 text-dark mb-1">Minuman Segar & Float</h3>
                        <p class="text-muted small">Aneka teh, squash jeruk, coklat, dan es float dingin melegakan.</p>
                    </div>
                    <div class="row g-3 g-md-4">
                        <?php $d=50; foreach($menu_drink as $item) { renderMenuCard($item, $d); $d=($d>=200)?50:$d+50; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FLOATING CART PILL ==================== -->
<button class="floating-cart-pill d-none" data-bs-toggle="modal" data-bs-target="#checkoutModal" id="btnKeranjangFloating">
    <i class="fa-solid fa-bag-shopping fs-5"></i>
    <span>Keranjang Pesanan</span>
    <span class="floating-cart-counter" id="cartCountFloat">0</span>
</button>

<!-- ==================== MODAL CHECKOUT & CART ==================== -->
<div class="modal fade modal-numanke" id="checkoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <div>
                    <h5 class="modal-title font-display fs-4 text-dark mb-0">Keranjang & Checkout</h5>
                    <small class="text-muted">Periksa kembali pesanan Anda sebelum dikirim</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row g-4">
                    
                    <!-- Left: Item List -->
                    <div class="col-md-6 border-end">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="fa-solid fa-receipt text-danger"></i>
                            <h6 class="fw-bold text-dark mb-0">Rincian Menu</h6>
                        </div>
                        <div id="keranjangList" class="mb-3"></div>
                        <div id="ringkasanTotal"></div>
                    </div>

                    <!-- Right: Customer Info Form -->
                    <div class="col-md-6">
                        <form id="formCheckoutWa" action="proses_wa.php" method="POST">
                            <input type="hidden" name="cart_data" id="cartDataInput">
                            <input type="hidden" name="jarak" id="jarakInput" value="0">
                            <input type="hidden" name="link_gps" id="linkGpsInput" value="">

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="fa-solid fa-user-pen text-danger"></i>
                                <h6 class="fw-bold text-dark mb-0">Data Pemesan</h6>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                                <input type="text" class="input-elegant" name="nama" id="nama" placeholder="Contoh: Budi Santoso" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Nomor WhatsApp</label>
                                <input type="tel" class="input-elegant" name="nomorWa" id="nomorWa" placeholder="0812xxxxxx" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted d-block">Tipe Pesanan</label>
                                <div class="d-flex gap-2">
                                    <div class="flex-grow-1">
                                        <input type="radio" class="btn-check" name="tipePesanan" id="dineIn" value="Makan di Tempat" checked onchange="toggleAlamat()">
                                        <label class="btn btn-outline-danger w-100 py-2 small fw-bold rounded-3" for="dineIn">Dine In</label>
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="radio" class="btn-check" name="tipePesanan" id="takeaway" value="Ambil Sendiri" onchange="toggleAlamat()">
                                        <label class="btn btn-outline-danger w-100 py-2 small fw-bold rounded-3" for="takeaway">Ambil Sendiri</label>
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="radio" class="btn-check" name="tipePesanan" id="delivery" value="Diantar" onchange="toggleAlamat()">
                                        <label class="btn btn-outline-danger w-100 py-2 small fw-bold rounded-3" for="delivery">Diantar</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat Box (Delivery only) -->
                            <div class="p-3 bg-light rounded-4 border mb-3" id="boxAlamat" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small fw-bold text-dark">Alamat Pengiriman:</span>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="pilihGPS()" id="btnGPS">
                                        <i class="fa-solid fa-location-crosshairs"></i> Gunakan GPS
                                    </button>
                                </div>
                                <textarea class="input-elegant" name="alamat" id="alamat" rows="2" placeholder="Tuliskan patokan / alamat lengkap..."></textarea>
                                
                                <div id="infoOngkir" class="alert alert-info py-2 px-3 small mt-2 mb-2" style="display: none;"></div>

                                <div class="d-flex gap-2 mt-2">
                                    <button type="button" class="btn btn-danger btn-sm w-100 py-2 fw-bold rounded-3" onclick="setujuiLokasi()" id="btnSetuju">
                                        <i class="fa-solid fa-check"></i> Cek & Setujui Lokasi
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm w-100 py-2 fw-bold rounded-3" onclick="resetLokasi()" id="btnReset" style="display: none;">
                                        <i class="fa-solid fa-rotate-left"></i> Ganti Alamat
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted d-block">Metode Pembayaran</label>
                                <div class="d-flex gap-2">
                                    <div class="flex-grow-1">
                                        <input type="radio" class="btn-check" name="metodeBayar" id="cash" value="Cash" checked>
                                        <label class="btn btn-outline-secondary w-100 py-2 small fw-bold rounded-3" for="cash">Tunai (Cash)</label>
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="radio" class="btn-check" name="metodeBayar" id="qris" value="QRIS">
                                        <label class="btn btn-outline-secondary w-100 py-2 small fw-bold rounded-3" for="qris">QRIS</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn-numanke-primary" onclick="kirimKeWa()" id="btnBayarModal">
                    <i class="fa-brands fa-whatsapp fs-5"></i> Kirim Pesanan Sekarang
                </button>
            </div>

        </div>
    </div>
</div>

<!-- ==================== LOGIKA KERANJANG, GPS & WA ==================== -->
<script>
let keranjang = JSON.parse(localStorage.getItem('numanke_cart')) || [];
const RESTO_LAT = -7.05051; 
const RESTO_LNG = 110.39523;
let ongkirFinal = 0; let ongkirTemp = 0; let jarakPelanggan = 0;
let linkGps = ""; let isLokasiSetuju = false; let isGpsUsed = false;

document.addEventListener("DOMContentLoaded", () => {
    updateCartBadge();
    document.getElementById('checkoutModal').addEventListener('show.bs.modal', renderModalCart);
});

function cariMenu() {
    let input = document.getElementById('searchInput').value.toLowerCase();
    let cards = document.getElementsByClassName('menu-item-card');
    let navPills = document.getElementById('menu-tab');
    let tabContents = document.getElementsByClassName('tab-pane');
    let resultText = document.getElementById('searchResultText');
    let foundCount = 0;

    if (input === "") {
        navPills.style.display = 'flex'; resultText.style.display = 'none';
        for (let i=0; i<tabContents.length; i++) tabContents[i].querySelectorAll('.menu-item-card').forEach(el => el.style.display='block');
        return; 
    }

    navPills.style.display = 'none';
    for (let i=0; i<tabContents.length; i++) tabContents[i].classList.add('show', 'active');

    for (let i=0; i<cards.length; i++) {
        let title = cards[i].querySelector('.card-menu-title').innerText.toLowerCase();
        if (title.includes(input)) { cards[i].style.display = "block"; foundCount++; } 
        else { cards[i].style.display = "none"; }
    }
    resultText.style.display = 'block';
    resultText.innerHTML = foundCount > 0 ? `Menemukan <b>${foundCount}</b> menu` : `Menu tidak ditemukan.`;
}

// Micro-animation: Flying particle to floating cart
function animateFlyToCart(e) {
    const btn = e.currentTarget;
    const cartBtn = document.getElementById('btnKeranjangFloating');
    if(!cartBtn || cartBtn.classList.contains('d-none')) return;

    if(navigator.vibrate) navigator.vibrate(25);

    const rect = btn.getBoundingClientRect();
    const cartRect = cartBtn.getBoundingClientRect();
    
    const dot = document.createElement('div');
    dot.className = 'flying-particle';
    dot.style.left = (rect.left + rect.width/2 - 8) + 'px';
    dot.style.top = (rect.top + rect.height/2 - 8) + 'px';
    document.body.appendChild(dot);
    
    const targetX = cartRect.left + (cartRect.width/2) - 8;
    const targetY = cartRect.top + (cartRect.height/2) - 8;
    
    dot.animate([
        { transform: 'translate(0,0) scale(1)', opacity: 1 },
        { transform: `translate(${(targetX - rect.left)/2}px, -45px) scale(1.3)`, opacity: 0.9 }, 
        { transform: `translate(${targetX - rect.left}px, ${targetY - rect.top}px) scale(0.3)`, opacity: 0.4 }
    ], { duration: 500, easing: 'cubic-bezier(0.16, 1, 0.3, 1)' }).onfinish = () => {
        dot.remove();
        cartBtn.animate([
            { transform: 'scale(1)' }, { transform: 'scale(1.12) translateY(-3px)' }, { transform: 'scale(1)' }
        ], { duration: 250 });
    };
}

function tambahKeranjang(e, nama, harga) {
    let index = keranjang.findIndex(item => item.nama === nama);
    if (index !== -1) { keranjang[index].qty += 1; } 
    else { keranjang.push({ nama: nama, harga: harga, qty: 1 }); }
    
    localStorage.setItem('numanke_cart', JSON.stringify(keranjang));
    updateCartBadge(); renderModalCart();
    animateFlyToCart(e); 
}

function kurangiItem(index) {
    keranjang[index].qty -= 1;
    if(keranjang[index].qty <= 0) { keranjang.splice(index, 1); }
    localStorage.setItem('numanke_cart', JSON.stringify(keranjang));
    updateCartBadge(); renderModalCart();
}

function updateCartBadge() {
    let btnFloat = document.getElementById('btnKeranjangFloating');
    let countFloat = document.getElementById('cartCountFloat');
    let totalQty = keranjang.reduce((sum, item) => sum + item.qty, 0);
    
    if(totalQty > 0) {
        if(btnFloat) { btnFloat.classList.remove('d-none'); countFloat.innerText = totalQty; }
    } else {
        if(btnFloat) { btnFloat.classList.add('d-none'); }
    }
}

function renderModalCart() {
    let list = document.getElementById('keranjangList');
    let ringkasan = document.getElementById('ringkasanTotal');
    let btnBayar = document.getElementById('btnBayarModal');
    let isDiantar = document.getElementById('delivery').checked;
 
    if (keranjang.length === 0) {
        list.innerHTML = '<p class="text-center py-4 text-muted small fst-italic">Keranjang belanja Anda masih kosong.</p>';
        ringkasan.innerHTML = ''; btnBayar.disabled = true; return;
    }

    btnBayar.disabled = false;
    let html = ''; let subtotal = 0;

    keranjang.forEach((item, index) => {
        let totalItem = item.harga * item.qty; subtotal += totalItem;
        html += `<div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded-3">
        <div class="flex-grow-1 pe-2">
            <div class="fw-bold text-dark" style="font-size: 0.88rem; line-height: 1.2;">${item.nama}</div>
            <small class="text-muted">${item.qty} x Rp ${item.harga.toLocaleString('id-ID')}</small>
        </div>
        <div class="text-end d-flex align-items-center gap-2">
            <div class="fw-bold text-dark" style="font-size: 0.88rem;">Rp ${totalItem.toLocaleString('id-ID')}</div>
            <button class="btn btn-sm btn-outline-danger rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:24px; height:24px;" onclick="kurangiItem(${index})"><i class="fa-solid fa-minus" style="font-size:0.65rem;"></i></button>
        </div>
        </div>`;
    });
    list.innerHTML = html;

    let htmlTotal = `<div class="d-flex justify-content-between mb-2 small"><span class="text-muted">Subtotal</span><span class="fw-bold text-dark">Rp ${subtotal.toLocaleString('id-ID')}</span></div>`;
    
    if(isDiantar) {
        if(isLokasiSetuju) { htmlTotal += `<div class="d-flex justify-content-between mb-3 small"><span class="text-muted">Ongkir (${jarakPelanggan.toFixed(1)} km)</span><span class="fw-bold text-danger">Rp ${ongkirFinal.toLocaleString('id-ID')}</span></div>`; } 
        else { htmlTotal += `<div class="d-flex justify-content-between mb-3 small"><span class="text-muted">Ongkir</span><span class="fw-bold text-danger fst-italic">Pilih Lokasi</span></div>`; }
    }

    let totalSemua = subtotal + (isDiantar && isLokasiSetuju ? ongkirFinal : 0);
    htmlTotal += `<div class="d-flex justify-content-between align-items-center p-3 rounded-4 mt-2" style="background: var(--color-red-light); border: 1px solid rgba(201,42,42,0.2);">
    <span class="fw-bold text-dark fs-6">Total Bayar</span><span class="fw-bold fs-5 text-danger">Rp ${totalSemua.toLocaleString('id-ID')}</span>
    </div>`;
    ringkasan.innerHTML = htmlTotal;
}

function toggleAlamat() {
    const isDelivery = document.getElementById('delivery').checked;
    const boxAlamat = document.getElementById('boxAlamat');
    if(isDelivery) { boxAlamat.style.display = 'block'; } else { boxAlamat.style.display = 'none'; resetLokasi(); }
}

function hitungJarakGarisLurus(lat1, lon1, lat2, lon2) {
    const R = 6371; const dLat = (lat2 - lat1) * Math.PI / 180; const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon/2) * Math.sin(dLon/2);
    return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))); 
}

async function hitungJarak(lat1, lon1, lat2, lon2) {
    try {
        const res = await fetch(`https://router.project-osrm.org/route/v1/driving/${lon1},${lat1};${lon2},${lat2}?overview=false`);
        const data = await res.json();
        if (data.code === 'Ok' && data.routes.length > 0) return data.routes[0].distance / 1000;
        throw new Error("Rute tidak ditemukan");
    } catch (e) { return hitungJarakGarisLurus(lat1, lon1, lat2, lon2); }
}

function kalkulasiOngkir(jarak) { return jarak <= 5 ? 5000 : 5000 + (Math.ceil((jarak - 5) / 0.2) * 500); }

document.getElementById('alamat').addEventListener('input', function() {
    isGpsUsed = false; document.getElementById('btnGPS').innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> Gunakan GPS';
});

function pilihGPS() {
    const btn = document.getElementById('btnGPS'); btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Melacak...';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(async function(pos) {
            const uLat = pos.coords.latitude, uLng = pos.coords.longitude; linkGps = `https://www.google.com/maps?q=${uLat},${uLng}`;
            jarakPelanggan = await hitungJarak(RESTO_LAT, RESTO_LNG, uLat, uLng); ongkirTemp = kalkulasiOngkir(jarakPelanggan); isGpsUsed = true;
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${uLat}&lon=${uLng}`).then(r => r.json()).then(d => { if(d.display_name) document.getElementById('alamat').value = d.display_name; });
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Terlacak'; alert("GPS terlacak! Klik 'Cek & Setujui Lokasi' untuk hitung ongkir.");
        }, () => { alert('Gagal melacak. Pastikan GPS aktif.'); btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> Gunakan GPS'; });
    } else { alert('Browser tidak mendukung GPS.'); }
}

function finalizeSetuju() {
    isLokasiSetuju = true; document.getElementById('btnGPS').disabled = true; document.getElementById('alamat').readOnly = true;
    document.getElementById('btnSetuju').style.display = 'none'; document.getElementById('btnReset').style.display = 'block';
    document.getElementById('btnSetuju').disabled = false; renderModalCart();
}

function setujuiLokasi() {
    let alamat = document.getElementById('alamat').value.trim();
    if(!alamat) { alert("Harap isi alamat Anda!"); return; }
    let btnSetuju = document.getElementById('btnSetuju'); let info = document.getElementById('infoOngkir');

    if (isGpsUsed) {
        ongkirFinal = ongkirTemp; info.innerHTML = `📍 Jarak: <b>${jarakPelanggan.toFixed(2)} km</b><br>Ongkos Kirim: <b>Rp ${ongkirFinal.toLocaleString('id-ID')}</b>`;
        info.style.display = 'block'; finalizeSetuju(); return;
    }

    btnSetuju.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menghitung...'; btnSetuju.disabled = true;
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(alamat)}&limit=1`).then(r => r.json()).then(async d => {
        if(d && d.length > 0) {
            let lat = parseFloat(d[0].lat), lon = parseFloat(d[0].lon);
            jarakPelanggan = await hitungJarak(RESTO_LAT, RESTO_LNG, lat, lon); ongkirFinal = kalkulasiOngkir(jarakPelanggan); linkGps = `https://www.google.com/maps?q=${lat},${lon}`;
            info.innerHTML = `📍 Jarak: <b>${jarakPelanggan.toFixed(2)} km</b><br>Ongkos Kirim: <b>Rp ${ongkirFinal.toLocaleString('id-ID')}</b>`; info.style.display = 'block'; finalizeSetuju();
        } else {
            let ipt = prompt("Satelit kesulitan menemukan rute jalan. Mohon masukkan PERKIRAAN JARAK (Kilometer):\n(Contoh: 2.5 atau 3)", "2");
            if (ipt && !isNaN(ipt)) {
                jarakPelanggan = parseFloat(ipt); ongkirFinal = kalkulasiOngkir(jarakPelanggan); linkGps = "";
                info.innerHTML = `📍 Jarak Perkiraan: <b>${jarakPelanggan.toFixed(2)} km</b><br>Ongkos Kirim: <b>Rp ${ongkirFinal.toLocaleString('id-ID')}</b>`;
                info.style.display = 'block'; finalizeSetuju();
            } else { btnSetuju.innerHTML = '<i class="fa-solid fa-check"></i> Cek & Setujui Lokasi'; btnSetuju.disabled = false; alert("Gagal memproses."); }
        }
    }).catch(() => { btnSetuju.innerHTML = '<i class="fa-solid fa-check"></i> Cek & Setujui Lokasi'; btnSetuju.disabled = false; alert("Error jaringan."); });
}

function resetLokasi() {
    isLokasiSetuju = false; ongkirFinal = 0; ongkirTemp = 0; linkGps = ""; jarakPelanggan = 0; isGpsUsed = false;
    document.getElementById('btnGPS').disabled = false; document.getElementById('btnGPS').innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> Gunakan GPS';
    document.getElementById('alamat').readOnly = false; document.getElementById('infoOngkir').style.display = 'none';
    let btnSetuju = document.getElementById('btnSetuju'); btnSetuju.style.display = 'block'; btnSetuju.innerHTML = '<i class="fa-solid fa-check"></i> Cek & Setujui Lokasi';
    document.getElementById('btnReset').style.display = 'none'; renderModalCart();
}

function kirimKeWa() {
    if(keranjang.length === 0) return;
    let nama = document.getElementById('nama').value, nomor = document.getElementById('nomorWa').value, isDiantar = document.getElementById('delivery').checked;
    if(!nama || !nomor) { alert('Lengkapi Nama dan Nomor WhatsApp terlebih dahulu!'); return; }
    if(isDiantar && !isLokasiSetuju) { alert('Silakan Cek & Setujui Lokasi terlebih dahulu!'); return; }

    document.getElementById('cartDataInput').value = JSON.stringify(keranjang); document.getElementById('jarakInput').value = isDiantar ? jarakPelanggan : 0;
    document.getElementById('linkGpsInput').value = isDiantar ? linkGps : ""; document.getElementById('formCheckoutWa').submit();
}
</script>

<?php require_once 'includes/footer.php'; ?>
