<?php 
require_once 'includes/header.php'; 
require_once 'includes/menu_manager.php'; 

// =========================================================================
// DATA MENU NUMANKE (SINKRON LANGSUNG DENGAN DATABASE ADMIN)
// =========================================================================
$menu_catalog = get_menu_catalog();

// Konfigurasi metadata kategori (Ikon, label, subjudul)
$category_meta = [
    'Geprek Series' => ['slug' => 'geprek', 'icon' => 'fa-utensils text-danger', 'label' => 'Geprek Spesial', 'title' => 'Ayam & Jamur Geprek', 'sub' => 'Crispy gurih berpadu dengan ulekan cabai rawit pedas mantap.'],
    'Brongot Series' => ['slug' => 'brongot', 'icon' => 'fa-fire text-danger', 'label' => 'Ayam Brongot', 'title' => 'Ayam Brongot Spesial', 'sub' => 'Dimarinasi 12 jam, dibakar arang dengan bumbu manis pedas gurih karamel.'],
    'Dewata Series' => ['slug' => 'dewata', 'icon' => 'fa-leaf text-success', 'label' => 'Dewata Series', 'title' => 'Dewata Series', 'sub' => 'Khas rempah Bali wangi serai daun jeruk yang menggugah selera.'],
    'Rongot Series' => ['slug' => 'rongot', 'icon' => 'fa-ice-cream text-warning', 'label' => 'Rongot Freeze', 'title' => 'Rongot Freeze & Snack', 'sub' => 'Roti panggang aneka topping manis lumer, penyejuk nikmat sehabis pedas.'],
    'Frozen Series' => ['slug' => 'frozen', 'icon' => 'fa-snowflake text-info', 'label' => 'Frozen & Sambal', 'title' => 'Frozen Food & Sambal Botol', 'sub' => 'Siap masak praktis di rumah kapan saja Anda mau.'],
    'Drink' => ['slug' => 'drink', 'icon' => 'fa-glass-water text-primary', 'label' => 'Minuman Segar', 'title' => 'Minuman Segar & Float', 'sub' => 'Aneka teh, squash jeruk, coklat, dan es float dingin melegakan.'],
];

// FUNGSI RENDER KARTU MENU – INTERAKTIF & CLICKABLE KE POP-UP
function renderMenuCard($item, $delay = 50) {
    $itemJson = htmlspecialchars(json_encode($item, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');
    $isSpicy = !empty($item['has_spicy']);
    $namaMenu = htmlspecialchars($item['nama'], ENT_QUOTES, 'UTF-8');

    echo '<div class="col-6 col-md-4 col-lg-3 menu-item-card" data-aos="fade-up" data-aos-delay="'.$delay.'">';
    echo '<div class="card-menu-elegant clickable-product-card" onclick="openProductModalFromCard(this)" data-product=\''.$itemJson.'\' title="Klik untuk pilih porsi, level pedas & pesan">';
    
    // Image box with fallback icon
    echo '<div class="card-menu-img-box">';
    if (!empty($item['img'])) {
        echo '<img src="'.$item['img'].'" alt="'.$namaMenu.'" onerror="this.src=\'assets/images/bg-headingweb.png\'">';
    }
    echo '<i class="fa-solid '.$item['icon'].' position-absolute" style="font-size:2.2rem; color:var(--color-dark); opacity:0.08; z-index:0;"></i>';
    echo '<span class="card-menu-click-hint"><i class="fa-solid fa-arrow-pointer"></i> Klik Detail</span>';
    echo '</div>';

    // Body content
    echo '<div class="card-menu-body">';
    echo '<h4 class="card-menu-title mb-1">'.$namaMenu.'</h4>';
    
    // Badge status
    if ($isSpicy) {
        echo '<div class="mb-2"><span class="spice-level-indicator">🌶️ Level 1-5</span></div>';
    } else {
        echo '<div class="mb-2"><span class="spice-level-indicator" style="background:#f0fdf4; color:#166534; border-color:rgba(22,101,52,0.2);">✨ Segar / Manis</span></div>';
    }

    echo '<div class="mt-auto d-flex flex-column gap-1">';
    
    if (!empty($item['has_portions'])) {
        $lblS = $item['single_label'] ?? 'Single';
        $lblD = $item['double_label'] ?? 'Double';

        echo '<div class="portion-row">';
        echo '<div><div class="portion-name">'.$lblS.'</div><div class="portion-cost">'.$item['single'].'</div></div>';
        echo '<button type="button" class="btn-add-item" onclick="event.stopPropagation(); openProductModalFromPortion(this, \'Single\')" title="Pilih Single & Level Pedas"><i class="fa-solid fa-plus"></i></button>';
        echo '</div>';
        
        echo '<div class="portion-row">';
        echo '<div><div class="portion-name">'.$lblD.'</div><div class="portion-cost">'.$item['double'].'</div></div>';
        echo '<button type="button" class="btn-add-item" onclick="event.stopPropagation(); openProductModalFromPortion(this, \'Double\')" title="Pilih Double & Level Pedas"><i class="fa-solid fa-plus"></i></button>';
        echo '</div>';
    } else {
        echo '<div class="portion-row">';
        echo '<div><div class="portion-name">Harga Porsi</div><div class="portion-cost">'.$item['harga'].'</div></div>';
        echo '<button type="button" class="btn-add-item" onclick="event.stopPropagation(); openProductModalFromCard(this.closest(\'.card-menu-elegant\'))" title="Detail & Pesan"><i class="fa-solid fa-plus"></i></button>';
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
                    Pilih menu favorit Anda. Dibuat hangat dan segar saat pesanan diterima. Klik menu untuk memilih level pedas (1-5) dan porsi Single/Double.
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

<!-- ==================== CATEGORY FILTER TABS (DYNAMIC DARI DATABASE) ==================== -->
<section class="py-4 bg-white border-bottom sticky-top" style="top: 76px; z-index: 1020; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
    <div class="container">
        <div class="category-filter-bar nav flex-nowrap" id="menu-tab" role="tablist">
            <?php 
            $tab_idx = 0;
            foreach ($menu_catalog as $kat_name => $items_in_kat): 
                if (empty($items_in_kat)) continue;
                $slug = $category_meta[$kat_name]['slug'] ?? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $kat_name));
                $icon = $category_meta[$kat_name]['icon'] ?? 'fa-bowl-food text-danger';
                $label = $category_meta[$kat_name]['label'] ?? $kat_name;
                $active_class = ($tab_idx === 0) ? 'active' : '';
            ?>
                <button class="category-pill-btn <?php echo $active_class; ?>" data-bs-toggle="pill" data-bs-target="#<?php echo $slug; ?>" type="button" role="tab">
                    <i class="fa-solid <?php echo $icon; ?>"></i> <?php echo htmlspecialchars($label); ?>
                </button>
            <?php 
                $tab_idx++;
            endforeach; 
            ?>
        </div>
    </div>
</section>

<!-- ==================== MENU GRID ITEMS (DYNAMIC DARI DATABASE) ==================== -->
<section class="section-wrapper-bg">
    <div class="container">
        <div class="section-framed-card">
            <div class="tab-content" id="menu-tabContent">
                <?php 
                $pane_idx = 0;
                foreach ($menu_catalog as $kat_name => $items_in_kat): 
                    if (empty($items_in_kat)) continue;
                    $slug = $category_meta[$kat_name]['slug'] ?? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $kat_name));
                    $title = $category_meta[$kat_name]['title'] ?? $kat_name;
                    $sub = $category_meta[$kat_name]['sub'] ?? 'Koleksi menu lezat dari dapur kami.';
                    $show_active = ($pane_idx === 0) ? 'show active' : '';
                ?>
                    <div class="tab-pane fade <?php echo $show_active; ?>" id="<?php echo $slug; ?>">
                        <div class="mb-4">
                            <h3 class="font-display fs-3 text-dark mb-1"><?php echo htmlspecialchars($title); ?></h3>
                            <p class="text-muted small"><?php echo htmlspecialchars($sub); ?></p>
                        </div>
                        <div class="row g-3 g-md-4">
                            <?php 
                            $d = 50; 
                            foreach($items_in_kat as $item) { 
                                renderMenuCard($item, $d); 
                                $d = ($d >= 200) ? 50 : $d + 50; 
                            } 
                            ?>
                        </div>
                    </div>
                <?php 
                    $pane_idx++;
                endforeach; 
                ?>
            </div>
        </div>
    </div>
</section>

<!-- ==================== POP-UP MODAL DETAIL PRODUK (SMOOTH & INTERAKTIF) ==================== -->
<div class="modal fade modal-product-detail" id="productDetailModal" tabindex="-1" aria-labelledby="modalProductTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content product-modal-content">
            
            <!-- Header Gambar & Tombol Tutup Glass -->
            <div class="product-modal-image-wrap">
                <img id="modalProductImg" src="assets/images/bg-headingweb.png" alt="Detail Produk">
                <button type="button" class="btn-close-modal-glass" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="product-modal-badges">
                    <span class="badge-cat-pill" id="modalProductCategory">Geprek Series</span>
                    <span class="badge-spicy-pill" id="modalProductSpiceBadge"><i class="fa-solid fa-pepper-hot"></i> Level 1 - 5</span>
                </div>
            </div>

            <!-- Body Modal -->
            <div class="modal-body p-4">
                
                <!-- Judul & Tampilan Harga -->
                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                    <h3 class="product-modal-title" id="modalProductTitle">Nama Menu</h3>
                    <div class="product-modal-price" id="modalProductDisplayPrice">Rp 0</div>
                </div>

                <!-- Deskripsi Produk -->
                <p class="product-modal-desc mb-3" id="modalProductDesc">
                    Deskripsi kelezatan menu makanan akan tampil di sini.
                </p>

                <!-- 1. Pilihan Porsi (Single / Double / Porsi) -->
                <div class="product-option-section mb-3" id="modalPortionSection">
                    <label class="product-option-label">
                        <i class="fa-solid fa-bowl-rice text-danger"></i>
                        <span>Pilih Porsi / Varian:</span>
                    </label>
                    <div class="portion-selector-grid" id="modalPortionGrid">
                        <!-- Disuntikkan secara dinamis melalui JavaScript -->
                    </div>
                </div>

                <!-- 2. Pilihan Level Pedas (Level 1 - 5) -->
                <div class="product-option-section mb-3" id="modalSpiceSection">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="product-option-label mb-0">
                            <i class="fa-solid fa-pepper-hot text-danger"></i>
                            <span>Pilih Level Pedas (1 - 5):</span>
                        </label>
                        <span class="badge-selected-level" id="modalLevelLabelText">Level 1 (Sedang)</span>
                    </div>
                    <div class="spice-levels-row">
                        <button type="button" class="btn-level-pill active" data-level="1" onclick="selectSpicyLevel(1)">
                            <span class="level-num">1</span>
                            <span class="level-title">Sedang</span>
                            <span class="level-chili">🌶️</span>
                        </button>
                        <button type="button" class="btn-level-pill" data-level="2" onclick="selectSpicyLevel(2)">
                            <span class="level-num">2</span>
                            <span class="level-title">Mantap</span>
                            <span class="level-chili">🌶️🌶️</span>
                        </button>
                        <button type="button" class="btn-level-pill" data-level="3" onclick="selectSpicyLevel(3)">
                            <span class="level-num">3</span>
                            <span class="level-title">Pedas</span>
                            <span class="level-chili">🌶️🌶️🌶️</span>
                        </button>
                        <button type="button" class="btn-level-pill" data-level="4" onclick="selectSpicyLevel(4)">
                            <span class="level-num">4</span>
                            <span class="level-title">Ekstra</span>
                            <span class="level-chili">🌶️🌶️🌶️🌶️</span>
                        </button>
                        <button type="button" class="btn-level-pill" data-level="5" onclick="selectSpicyLevel(5)">
                            <span class="level-num">5</span>
                            <span class="level-title">Gahar</span>
                            <span class="level-chili">🔥</span>
                        </button>
                    </div>
                </div>

                <!-- 3. Catatan Khusus -->
                <div class="product-option-section mb-3">
                    <label class="product-option-label">
                        <i class="fa-regular fa-comment-dots text-danger"></i>
                        <span>Catatan Khusus (Opsional):</span>
                    </label>
                    <input type="text" id="modalProductNote" class="form-control product-note-input" placeholder="Contoh: sambal dipisah, tidak pakai lalapan, es sedikit...">
                </div>

                <!-- 4. Jumlah Pesanan (Quantity) & Subtotal -->
                <div class="d-flex justify-content-between align-items-center py-2 px-3 bg-light rounded-4 mb-3 border">
                    <span class="fw-bold text-dark small">Jumlah Pesanan:</span>
                    <div class="d-flex align-items-center gap-3">
                        <button type="button" class="btn-qty-round" onclick="changeModalQty(-1)"><i class="fa-solid fa-minus"></i></button>
                        <span class="fw-bold fs-5 text-dark" id="modalProductQty" style="min-width: 24px; text-align: center;">1</span>
                        <button type="button" class="btn-qty-round" onclick="changeModalQty(1)"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>

                <!-- Tombol Tambah ke Keranjang -->
                <button type="button" class="btn-numanke-primary w-100 py-3 rounded-pill fw-bold shadow-lg" onclick="tambahKeKeranjangDariModal(event)" id="modalBtnAddToCart">
                    <i class="fa-solid fa-cart-plus me-2 fs-5"></i>
                    <span>Tambah ke Keranjang • <b id="modalBtnSubtotal">Rp 0</b></span>
                </button>

            </div>

        </div>
    </div>
</div>

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

<!-- ==================== LOGIKA KERANJANG, MODAL PRODUK, GPS & WA ==================== -->
<script>
let keranjang = JSON.parse(localStorage.getItem('numanke_cart')) || [];
const RESTO_LAT = -7.05051; 
const RESTO_LNG = 110.39523;
let ongkirFinal = 0; let ongkirTemp = 0; let jarakPelanggan = 0;
let linkGps = ""; let isLokasiSetuju = false; let isGpsUsed = false;

// State untuk Modal Produk Detail
let currentProduct = null;
let selectedPortion = 'Single';
let selectedPrice = 0;
let selectedLevel = 1;
let modalQty = 1;
let bsProductModal = null;

const SPICY_TITLES = {
    1: 'Level 1 (Sedang 🌶️)',
    2: 'Level 2 (Mantap 🌶️🌶️)',
    3: 'Level 3 (Pedas 🌶️🌶️🌶️)',
    4: 'Level 4 (Ekstra 🌶️🌶️🌶️🌶️)',
    5: 'Level 5 (Gahar 🔥)'
};

document.addEventListener("DOMContentLoaded", () => {
    updateCartBadge();
    const checkoutEl = document.getElementById('checkoutModal');
    if (checkoutEl) {
        checkoutEl.addEventListener('show.bs.modal', renderModalCart);
    }
    const prodModalEl = document.getElementById('productDetailModal');
    if (prodModalEl) {
        bsProductModal = new bootstrap.Modal(prodModalEl);
    }
});

// ==================== BUKA POP-UP DETAIL PRODUK ====================
function openProductModalFromCard(cardEl) {
    if (!cardEl) return;
    try {
        const prodData = JSON.parse(cardEl.getAttribute('data-product'));
        populateAndShowProductModal(prodData, 'Single');
    } catch(err) {
        console.error("Gagal membaca data produk", err);
    }
}

function openProductModalFromPortion(btnEl, portionType) {
    const cardEl = btnEl.closest('.card-menu-elegant');
    if (!cardEl) return;
    try {
        const prodData = JSON.parse(cardEl.getAttribute('data-product'));
        populateAndShowProductModal(prodData, portionType);
    } catch(err) {
        console.error("Gagal membaca data produk", err);
    }
}

function populateAndShowProductModal(prod, preferredPortion) {
    currentProduct = prod;
    modalQty = 1;
    document.getElementById('modalProductQty').innerText = '1';
    document.getElementById('modalProductNote').value = '';

    // Isi Info Dasar
    document.getElementById('modalProductTitle').innerText = prod.nama;
    document.getElementById('modalProductCategory').innerText = prod.kategori;
    document.getElementById('modalProductDesc').innerText = prod.desc || 'Disajikan hangat dan lezat khas Dapur Numanke.';
    
    const imgEl = document.getElementById('modalProductImg');
    imgEl.src = prod.img || 'assets/images/bg-headingweb.png';
    imgEl.onerror = function() { this.src = 'assets/images/bg-headingweb.png'; };

    // Format Pilihan Porsi
    const portionGrid = document.getElementById('modalPortionGrid');
    const portionSection = document.getElementById('modalPortionSection');
    portionGrid.innerHTML = '';

    if (prod.has_portions) {
        portionSection.style.display = 'block';
        selectedPortion = (preferredPortion === 'Double') ? 'Double' : 'Single';
        selectedPrice = (selectedPortion === 'Double') ? prod.double_price : prod.single_price;

        const lblS = prod.single_label || 'Single';
        const lblD = prod.double_label || 'Double';

        const cardSingle = document.createElement('div');
        cardSingle.className = 'portion-choice-card ' + (selectedPortion === 'Single' ? 'active' : '');
        cardSingle.onclick = () => selectPortion('Single', prod.single_price);
        cardSingle.innerHTML = `
            <span class="portion-choice-name">${lblS}</span>
            <span class="portion-choice-price">Rp ${prod.single_price.toLocaleString('id-ID')}</span>
        `;

        const cardDouble = document.createElement('div');
        cardDouble.className = 'portion-choice-card ' + (selectedPortion === 'Double' ? 'active' : '');
        cardDouble.onclick = () => selectPortion('Double', prod.double_price);
        cardDouble.innerHTML = `
            <span class="portion-choice-name">${lblD}</span>
            <span class="portion-choice-price">Rp ${prod.double_price.toLocaleString('id-ID')}</span>
        `;

        portionGrid.appendChild(cardSingle);
        portionGrid.appendChild(cardDouble);
    } else {
        selectedPortion = 'Normal';
        selectedPrice = prod.price || 10000;
        portionSection.style.display = 'block';

        const cardNormal = document.createElement('div');
        cardNormal.className = 'portion-choice-card active';
        cardNormal.style.gridColumn = '1 / -1';
        cardNormal.innerHTML = `
            <span class="portion-choice-name">Porsi Reguler</span>
            <span class="portion-choice-price">Rp ${selectedPrice.toLocaleString('id-ID')}</span>
        `;
        portionGrid.appendChild(cardNormal);
    }

    // Format Level Kepedasan
    const spiceSection = document.getElementById('modalSpiceSection');
    const spiceBadge = document.getElementById('modalProductSpiceBadge');
    if (prod.has_spicy) {
        spiceSection.style.display = 'block';
        spiceBadge.style.display = 'inline-block';
        selectSpicyLevel(1);
    } else {
        spiceSection.style.display = 'none';
        spiceBadge.style.display = 'none';
        selectedLevel = 0;
    }

    updateModalSubtotal();

    if (!bsProductModal) {
        bsProductModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
    }
    bsProductModal.show();
}

function selectPortion(portionType, price) {
    selectedPortion = portionType;
    selectedPrice = price;

    const cards = document.querySelectorAll('#modalPortionGrid .portion-choice-card');
    cards.forEach((c, idx) => {
        if ((portionType === 'Single' && idx === 0) || (portionType === 'Double' && idx === 1) || portionType === 'Normal') {
            c.classList.add('active');
        } else {
            c.classList.remove('active');
        }
    });

    updateModalSubtotal();
}

function selectSpicyLevel(level) {
    selectedLevel = level;
    document.querySelectorAll('.btn-level-pill').forEach(btn => {
        const lvl = parseInt(btn.getAttribute('data-level'));
        if (lvl === level) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
    const labelEl = document.getElementById('modalLevelLabelText');
    if (labelEl) {
        labelEl.innerText = SPICY_TITLES[level] || `Level ${level}`;
    }
}

function changeModalQty(delta) {
    modalQty = Math.max(1, modalQty + delta);
    document.getElementById('modalProductQty').innerText = modalQty;
    updateModalSubtotal();
}

function updateModalSubtotal() {
    const total = selectedPrice * modalQty;
    document.getElementById('modalProductDisplayPrice').innerText = `Rp ${selectedPrice.toLocaleString('id-ID')}`;
    document.getElementById('modalBtnSubtotal').innerText = `Rp ${total.toLocaleString('id-ID')}`;
}

// ==================== TAMBAH KE KERANJANG DARI MODAL ====================
function tambahKeKeranjangDariModal(e) {
    if (!currentProduct) return;

    let porsiLabel = '';
    if (currentProduct.has_portions) {
        porsiLabel = selectedPortion === 'Single' ? (currentProduct.single_label || 'Single') : (currentProduct.double_label || 'Double');
    }

    const noteVal = document.getElementById('modalProductNote').value.trim();

    // Bentuk nama item yang jelas untuk tampilan keranjang & WA
    let namaItemKeranjang = currentProduct.nama;
    if (porsiLabel) {
        namaItemKeranjang += ` (${porsiLabel})`;
    }
    if (currentProduct.has_spicy && selectedLevel > 0) {
        namaItemKeranjang += ` [Level ${selectedLevel}]`;
    }

    // Cek apakah item serupa persis sudah ada di keranjang
    let index = keranjang.findIndex(item => 
        item.nama === namaItemKeranjang && 
        (item.catatan || '') === noteVal
    );

    if (index !== -1) {
        keranjang[index].qty += modalQty;
    } else {
        keranjang.push({
            nama: namaItemKeranjang,
            base_nama: currentProduct.nama,
            porsi: porsiLabel || 'Reguler',
            level: currentProduct.has_spicy ? selectedLevel : 0,
            catatan: noteVal,
            harga: selectedPrice,
            qty: modalQty
        });
    }

    localStorage.setItem('numanke_cart', JSON.stringify(keranjang));
    updateCartBadge();
    renderModalCart();

    // Animasi partikel terbang ke floating cart
    animateFlyToCart(e);

    // Tutup modal pop-up secara halus
    if (bsProductModal) {
        bsProductModal.hide();
    }
}

// Micro-animation: Flying particle to floating cart
function animateFlyToCart(e) {
    const cartBtn = document.getElementById('btnKeranjangFloating');
    if(!cartBtn || cartBtn.classList.contains('d-none')) return;

    if(navigator.vibrate) navigator.vibrate(25);

    const btn = e ? (e.currentTarget || e.target) : null;
    let startX = window.innerWidth / 2;
    let startY = window.innerHeight / 2;

    if (btn && btn.getBoundingClientRect) {
        const rect = btn.getBoundingClientRect();
        startX = rect.left + rect.width / 2 - 8;
        startY = rect.top + rect.height / 2 - 8;
    }

    const cartRect = cartBtn.getBoundingClientRect();
    
    const dot = document.createElement('div');
    dot.className = 'flying-particle';
    dot.style.left = startX + 'px';
    dot.style.top = startY + 'px';
    document.body.appendChild(dot);
    
    const targetX = cartRect.left + (cartRect.width/2) - 8;
    const targetY = cartRect.top + (cartRect.height/2) - 8;
    
    dot.animate([
        { transform: 'translate(0,0) scale(1)', opacity: 1 },
        { transform: `translate(${(targetX - startX)/2}px, -45px) scale(1.3)`, opacity: 0.9 }, 
        { transform: `translate(${targetX - startX}px, ${targetY - startY}px) scale(0.3)`, opacity: 0.4 }
    ], { duration: 500, easing: 'cubic-bezier(0.16, 1, 0.3, 1)' }).onfinish = () => {
        dot.remove();
        cartBtn.animate([
            { transform: 'scale(1)' }, { transform: 'scale(1.12) translateY(-3px)' }, { transform: 'scale(1)' }
        ], { duration: 250 });
    };
}

function tambahItem(index) {
    if (keranjang[index]) {
        keranjang[index].qty += 1;
        localStorage.setItem('numanke_cart', JSON.stringify(keranjang));
        updateCartBadge();
        renderModalCart();
    }
}

function kurangiItem(index) {
    if (keranjang[index]) {
        keranjang[index].qty -= 1;
        if(keranjang[index].qty <= 0) { 
            keranjang.splice(index, 1); 
        }
        localStorage.setItem('numanke_cart', JSON.stringify(keranjang));
        updateCartBadge(); 
        renderModalCart();
    }
}

function updateCartBadge() {
    let btnFloat = document.getElementById('btnKeranjangFloating');
    let countFloat = document.getElementById('cartCountFloat');
    let totalQty = keranjang.reduce((sum, item) => sum + item.qty, 0);
    
    if(totalQty > 0) {
        if(btnFloat) { 
            btnFloat.classList.remove('d-none'); 
            countFloat.innerText = totalQty; 
        }
    } else {
        if(btnFloat) { 
            btnFloat.classList.add('d-none'); 
        }
    }
}

function renderModalCart() {
    let list = document.getElementById('keranjangList');
    let ringkasan = document.getElementById('ringkasanTotal');
    let btnBayar = document.getElementById('btnBayarModal');
    let isDiantar = document.getElementById('delivery') ? document.getElementById('delivery').checked : false;
 
    if (keranjang.length === 0) {
        list.innerHTML = '<p class="text-center py-4 text-muted small fst-italic">Keranjang belanja Anda masih kosong.<br><a href="order.php" class="btn btn-sm btn-outline-danger mt-2 rounded-pill px-3">Pilih Menu Lezat</a></p>';
        ringkasan.innerHTML = ''; 
        if (btnBayar) btnBayar.disabled = true; 
        return;
    }

    if (btnBayar) btnBayar.disabled = false;
    let html = ''; 
    let subtotal = 0;

    keranjang.forEach((item, index) => {
        let totalItem = item.harga * item.qty; 
        subtotal += totalItem;
        
        let levelBadge = '';
        if (item.level && item.level > 0) {
            levelBadge = `<span class="badge rounded-pill ms-1" style="background:#fee2e2; color:#b91c1c; font-size:0.7rem;">🌶️ Level ${item.level}</span>`;
        }

        let catatanText = '';
        if (item.catatan) {
            catatanText = `<div class="text-muted fst-italic mt-1" style="font-size:0.75rem;"><i class="fa-regular fa-comment-dots me-1"></i>"${item.catatan}"</div>`;
        }

        html += `<div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded-3 border">
        <div class="flex-grow-1 pe-2">
            <div class="fw-bold text-dark d-flex align-items-center flex-wrap" style="font-size: 0.88rem; line-height: 1.2;">
                <span>${item.nama}</span>
                ${levelBadge}
            </div>
            ${catatanText}
            <small class="text-muted">${item.qty} x Rp ${item.harga.toLocaleString('id-ID')}</small>
        </div>
        <div class="text-end d-flex align-items-center gap-2">
            <div class="fw-bold text-dark" style="font-size: 0.88rem;">Rp ${totalItem.toLocaleString('id-ID')}</div>
            <div class="d-flex align-items-center gap-1">
                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:24px; height:24px;" onclick="kurangiItem(${index})" title="Kurang"><i class="fa-solid fa-minus" style="font-size:0.65rem;"></i></button>
                <button type="button" class="btn btn-sm btn-outline-success rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:24px; height:24px;" onclick="tambahItem(${index})" title="Tambah"><i class="fa-solid fa-plus" style="font-size:0.65rem;"></i></button>
            </div>
        </div>
        </div>`;
    });
    list.innerHTML = html;

    let htmlTotal = `<div class="d-flex justify-content-between mb-2 small"><span class="text-muted">Subtotal</span><span class="fw-bold text-dark">Rp ${subtotal.toLocaleString('id-ID')}</span></div>`;
    
    if(isDiantar) {
        if(isLokasiSetuju) { 
            htmlTotal += `<div class="d-flex justify-content-between mb-3 small"><span class="text-muted">Ongkir (${jarakPelanggan.toFixed(1)} km)</span><span class="fw-bold text-danger">Rp ${ongkirFinal.toLocaleString('id-ID')}</span></div>`; 
        } else { 
            htmlTotal += `<div class="d-flex justify-content-between mb-3 small"><span class="text-muted">Ongkir</span><span class="fw-bold text-danger fst-italic">Pilih Lokasi Terlebih Dahulu</span></div>`; 
        }
    }

    let totalSemua = subtotal + (isDiantar && isLokasiSetuju ? ongkirFinal : 0);
    htmlTotal += `<div class="d-flex justify-content-between align-items-center p-3 rounded-4 mt-2" style="background: var(--color-red-light); border: 1px solid rgba(201,42,42,0.2);">
    <span class="fw-bold text-dark fs-6">Total Bayar</span><span class="fw-bold fs-5 text-danger">Rp ${totalSemua.toLocaleString('id-ID')}</span>
    </div>`;
    ringkasan.innerHTML = htmlTotal;
}

function cariMenu() {
    let input = document.getElementById('searchInput').value.toLowerCase();
    let cards = document.getElementsByClassName('menu-item-card');
    let navPills = document.getElementById('menu-tab');
    let tabContents = document.getElementsByClassName('tab-pane');
    let resultText = document.getElementById('searchResultText');
    let foundCount = 0;

    if (input === "") {
        navPills.style.display = 'flex'; 
        resultText.style.display = 'none';
        for (let i=0; i<tabContents.length; i++) {
            tabContents[i].querySelectorAll('.menu-item-card').forEach(el => el.style.display='block');
        }
        return; 
    }

    navPills.style.display = 'none';
    for (let i=0; i<tabContents.length; i++) {
        tabContents[i].classList.add('show', 'active');
    }

    for (let i=0; i<cards.length; i++) {
        let title = cards[i].querySelector('.card-menu-title').innerText.toLowerCase();
        if (title.includes(input)) { 
            cards[i].style.display = "block"; 
            foundCount++; 
        } else { 
            cards[i].style.display = "none"; 
        }
    }
    resultText.style.display = 'block';
    resultText.innerHTML = foundCount > 0 ? `Menemukan <b>${foundCount}</b> menu` : `Menu tidak ditemukan.`;
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

document.getElementById('alamat')?.addEventListener('input', function() {
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
